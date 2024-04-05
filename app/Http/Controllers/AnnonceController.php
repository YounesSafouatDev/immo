<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Category;
use App\Models\AnnonceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ModifierAnnonce;
use App\Http\Requests\AnnoneValidation;

class AnnonceController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $annonces = Annonce::all();
        return view('admin.annonces.annonces',compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $utilisateurs = User::all()->where('role_id',3);
        return view('admin.annonces.ajouterAnnonces',compact('categories','utilisateurs'));
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
        $annonce->user_id = $request->annonceur;
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
        return redirect()->route('annonces.index')->with(['message' => 'L\'annonce a été Ajouté']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $annonce = Annonce::findOrFail($id);
        return view('admin.annonces.annonce',compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $annonce = Annonce::findOrFail($id);
        $categories = Category::all();
        $utilisateurs = User::all()->where('role_id',3);
        return view('admin.annonces.editAnnonce',compact('annonce','categories','utilisateurs')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModifierAnnonce $request, string $id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->title = $request->title;
        $annonce->description = $request->description;
        $annonce->city = $request->city;
        $annonce->address = $request->address;
        $annonce->map = $request->map;
        $annonce->type = $request->type;
        $annonce->category_id = $request->category;
        $annonce->status = $request->status;
        $annonce->user_id = $request->annonceur;
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
        return redirect()->route('annonces.index')->with('message','L\'annonce a été Modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();
        return redirect()->route('annonces.index')->with(['message'=>'L\'annonce a été Supprimé']);
    }
    public function premium(){
        $annonces = Annonce::all()->where('is_premium',1);
        return view('admin.annonces.premium',compact('annonces'));
    }
     // Delete All Articles 
    public function deleteAll(){
        Annonce::query()->delete();
        $annonces = Annonce::all();
        return redirect()->route('annonces.index')->with(['message','Tous les annonces sont supprimés']);
    }

    // Trashed Annonce
    public function trash(){
        $trashed = Annonce::onlyTrashed()->get();
        return view('admin.annonces.trash', compact('trashed')); 
    }


    // restore article
    public function do_restore(Request $request){
        $annonce = Annonce::withTrashed()->find($request->id);
        $annonce->restore();
        return redirect()->route('annonces.index')->with(['message'=>'L\'annonce a été Restauré']);
    }

    // force Delete article
    public function forceDelete(Request $request){

        $annonce = Annonce::withTrashed()->find($request->id);
        $images = $annonce->images;
        foreach ($images as $image) {
            $imagePath = public_path('storage/annonces/' . $image->path);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $annonce->forceDelete();
        return redirect()->route('annonces.index')->with(['message'=>'L\'annonce a été Supprimé']);        
    }
}
