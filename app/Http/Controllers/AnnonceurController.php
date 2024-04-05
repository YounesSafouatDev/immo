<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Category;
use App\Models\AnnonceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ModifierAnnonce;
use App\Http\Requests\AnnoneValidation;

class AnnonceurController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','annonceur']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces = Annonce::where('user_id',auth()->id())->get();
        return view('annonceur.annonces.annonces',compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('annonceur.annonces.ajouterAnnonces',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnoneValidation $request)
    {
        $annonce = new Annonce();
        $annonce->title = $request->title;
        $annonce->description = $request->description;
        $annonce->city = $request->city;
        $annonce->address = $request->address;
        $annonce->map = $request->map;
        $annonce->type = $request->type;
        $annonce->category_id = $request->category;
        $annonce->status = $request->status;
        $annonce->user_id = auth()->id();
        $annonce->surface = $request->surface;
        $annonce->price = $request->price;
        $annonce->bedroom = $request->bedroom;
        $annonce->bathroom = $request->bathroom;
        $annonce->is_valid = $request->is_valid;
        $annonce->is_premium = $request->is_premium;
        $annonce->save();
        $imageAnnonce = $request->file('images');
        foreach ($imageAnnonce as $image) {
            $extension = '.' . $image->getClientOriginalExtension();
            $filename = uniqid() . '-'. time() .  $extension;
            $image->storeAs('public/annonces', $filename);
            AnnonceImage::create([
                'path' => $filename,
                'annonce_id' => $annonce->id
            ]);
        }
        return to_route('annonceur.index')->with(['message' => 'L\'annonce a été Ajouté']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $annonce = Annonce::findOrFail($id)->where('user_id',auth()->id())->first();
        return view('annonceur.annonces.annonce',compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $annonce = Annonce::findOrFail($id)->where('user_id',auth()->id())->first();
        $categories = Category::all();
        return view('annonceur.annonces.editAnnonce',compact('annonce','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModifierAnnonce $request, string $id)
    {
        $annonce = Annonce::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();;
        $annonce->title = $request->title;
        $annonce->description = $request->description;
        $annonce->city = $request->city;
        $annonce->address = $request->address;
        $annonce->map = $request->map;
        $annonce->type = $request->type;
        $annonce->category_id = $request->category;
        $annonce->status = $request->status;
        $annonce->surface = $request->surface;
        $annonce->price = $request->price;
        $annonce->bedroom = $request->bedroom;
        $annonce->bathroom = $request->bathroom;
        $annonce->is_valid = $request->is_valid;
        $annonce->is_premium = $request->is_premium;
        $annonce->save();
        
        $images = $request->file('images');
        if (!empty($images)) {
            foreach ($annonce->images as $image) {
                AnnonceImage::destroy($image->id);
                $imagePath = public_path('storage/annonces/' . $image->path);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            foreach ($images as $image) {
                $extension = '.' . $image->getClientOriginalExtension();
                $filename = uniqid() . '-'. time() .  $extension;
                $image->storeAs('public/annonces', $filename);
                AnnonceImage::create([
                    'path' => $filename,
                    'annonce_id' => $annonce->id
                ]);
            }
        }
            
        return to_route('annonceur.index')->with(['message' => 'L\'annonce a été Modifié']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annonce = Annonce::findOrFail($id)->where('user_id',auth()->id());
        $annonce->delete();
        return to_route('annonceur.index')->with(['message'=>'L\'annonce a été Supprimé']);
    }
    public function premium(){
        $annonces = Annonce::where('is_premium',1)->where('user_id',auth()->id())->get();
        return view('annonceur.annonces.premium',compact('annonces'));
    }
     // Delete All Articles 
     public function deleteAll(){
        Annonce::query()->delete();
        return to_route('annonceur.index')->with(['message','Tous les annonces sont supprimés']);
    }

    // Trashed Article
    public function trash(){
        $trashed = Annonce::onlyTrashed()->where('user_id',auth()->id())->get();
        return view('annonceur.annonces.trash', compact('trashed'));   
    }


    // restore article
    public function do_restore(Request $request){
        $annonce = Annonce::withTrashed()->find($request->id)->where('user_id',auth()->id())->first();
        $annonce->restore();
        return redirect('annonceur/annonces/')->with(['message'=>'L\'annonce a été Restauré']);
    }

    // force Delete annonce
    public function forceDelete(Request $request){
        $annonce = Annonce::withTrashed()->find($request->id);
        foreach ($annonce->images as $image) {
            $imagePath = public_path('storage/annonces/' . $image->path);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $annonce->forceDelete();
        return to_route('annonceur.index')->with(['message'=>'L\'annonce a été Supprimé']);
    }
    public function profile(string $id){
        $utilisateur = User::findOrFail($id);
        return view('annonceur.profile',compact($utilisateur));
    }
    public function editerProfile(Request $request, string $id)
    {
        $utilisateur = User::findOrFail($id);
        $request->validate([
            'fname'=>['required','string'],
            'lname'=>['required','string'],
            'email'=>['required','email','string','unique:users,email,'.$id],
            'phone'=>['phone'=>'required','string','unique:users,phone,'.$id,'min:10'],
        ],[
            'fname.required' => 'Le champ prénom est requis.',
            'lname.required' => 'Le champ nom de famille est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.required' => 'Le champ téléphone est requis.',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins :min chiffres.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
        ]);
        if($utilisateur->email != $request->email){
            $utilisateur->fname = $request->fname;
            $utilisateur->lname = $request->lname;
            $utilisateur->email = $request->email;
            $utilisateur->phone = $request->phone;
            $utilisateur->email_verified_at = null;
            $utilisateur->save();
            $link = route('verify', $id);
            send($utilisateur->email,$link,$utilisateur->fname);
            return redirect('annonceur/annonces')->with(['message'=>'La modification a été effectuée avec succès. Le lien a été envoyé. Veuillez vérifier votre boîte mail.']);
        }
        $utilisateur->fname = $request->fname;
        $utilisateur->lname = $request->lname;
        $utilisateur->email = $request->email;
        $utilisateur->phone = $request->phone;
        $utilisateur->save();
        return redirect('annonceur/annonces')->with(['message'=>'La modification a été effectuée avec succès.']);  
    }
    public function changerMDP(Request $request, string $id){
        $utilisateur = User::findOrFail($id);
        $request->validate([
            'ancien'=>['required','min:6'],
            'password'=>['required','min:6','confirmed'],
        ],[
            'ancien.required' => 'Le champ ancien mot de passe est requis.',
            'ancien.min' => 'L\'ancien mot de passe doit comporter au moins :min caractères.',
            'password.required' => 'Le champ nouveau mot de passe est requis.',
            'password.min' => 'Le nouveau mot de passe doit comporter au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.'
        ]);
    
        if (!Hash::check($request->ancien, $utilisateur->password)) {
            return redirect()->route('annonceur.profile', ['utilisateur' => $utilisateur])->withErrors(['ancien' => 'L\'ancien mot de passe est incorrect.']);
        }
        $utilisateur->password = bcrypt($request->password);
        $utilisateur->save();
        return redirect('annonceur/annonces')->with("message","Le mot de passe a été changé");
    }  

    /**
     * Update the password.
     */

     public function reseau(Request $request, string $id){
        $utilisateur = User::findOrFail($id);
        $request->validate([
            'whatsapp'=>'min:10|max:10'
        ]);
        $utilisateur->whatsapp = $request->whatsapp;
        $utilisateur->facebook = $request->facebook;
        $utilisateur->instagram = $request->instagram;
        $utilisateur->save();
        return redirect('annonceur/annonces')->with("message","Les réseaux sociaux sont ajouté");
    }  
}
