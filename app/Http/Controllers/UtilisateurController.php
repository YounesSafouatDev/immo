<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterValidation;

class UtilisateurController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilisateurs = User::get();
        return view('admin.utilisateurs.utilisateurs',compact('utilisateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.utilisateurs.ajouterUtilisateur');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterValidation $request)
    {
        $utilisateur = register($request);
        $link = route('verify', $utilisateur->id);
        send($utilisateur->email,$link,$utilisateur->fname);
        return redirect('admin/utilisateurs/')->with('message','Veuillez vérifier l\'adresse e-mail pour la confirmation');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $utilisateur = User::findOrFail($id);
        return view('admin.utilisateurs.utilisateur',compact('utilisateur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $utilisateur = User::findOrFail($id);
        return view('admin.utilisateurs.editerUtilisateur',compact('utilisateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $utilisateur = User::findOrFail($id);
        $request->validate([
            'fname'=>['required','string'],
            'lname'=>['required','string'],
            'email'=>['required','email','string','unique:users,email,'.$id],
            'phone'=>['phone'=>'required','string','unique:users,phone,'.$id,'min:10'],
            'role'=>['required','integer'],
        ],[
            'fname.required' => 'Le champ prénom est requis.',
            'lname.required' => 'Le champ nom de famille est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.required' => 'Le champ téléphone est requis.',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins :min chiffres.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'role.required' => 'Le champ rôle est requis.',
            'role.integer' => 'Le rôle doit être un entier.',
        ]);
        if($utilisateur->email != $request->email){
            $utilisateur->fname = $request->fname;
            $utilisateur->lname = $request->lname;
            $utilisateur->email = $request->email;
            $utilisateur->phone = $request->phone;
            $utilisateur->role_id = $request->role;
            $utilisateur->email_verified_at = null;
            $utilisateur->save();
            $link = route('verify', $id);
            send($utilisateur->email,$link,$utilisateur->fname);
            return redirect('admin/utilisateurs')->with(['message'=>'La modification a été effectuée avec succès. Le lien a été envoyé. Veuillez vérifier votre boîte mail.']);
        }
        $utilisateur->fname = $request->fname;
        $utilisateur->lname = $request->lname;
        $utilisateur->email = $request->email;
        $utilisateur->phone = $request->phone;
        $utilisateur->role_id = $request->role;
        $utilisateur->save();
        return redirect('admin/utilisateurs')->with(['message'=>'La modification a été effectuée avec succès.']);
        
    }

    /**
     * Update the password.
     */

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
            return redirect()->route('utilisateurs.edit', ['utilisateur' => $utilisateur])->withErrors(['ancien' => 'L\'ancien mot de passe est incorrect.']);
        }
        $utilisateur->password = bcrypt($request->password);
        $utilisateur->save();
        return redirect('admin/utilisateurs')->with("message","Le mot de passe a été changé");
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
        return redirect('admin/utilisateurs')->with("message","Les réseaux sociaux sont ajouté");
    }  
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();
        return redirect()->back()->with(['message'=>'L\'utilisateur a été Supprimé']);
    }

    public function deleteAll(){
        User::query()->delete();
        return redirect('admin/utilisateurs')->with(['message','Tous les utilisateurs sont supprimés']);
    }

    // Trashed Utilisateur
    public function trash(){
        $trashed = User::onlyTrashed()->get();
        return view('admin.utilisateurs.trash', compact('trashed'));   
    }

    // restore article
    public function do_restore(Request $request){
        $article = User::withTrashed()->find($request->id);
        $article->restore();
        return redirect('admin/utilisateurs/trash')->with(['message'=>'L\'article a été Restauré']);
    }

    // force Delete article
    public function forceDelete(Request $request){
        $utilisateur = User::withTrashed()->find($request->id);
        $utilisateur->forceDelete();
        return redirect('admin/utilisateurs/trash')->with(['message'=>'L\'article a été Supprimé']);
    }
    public function validateUser(Request $request, $id)
{
    $utilisateur = User::findOrFail($id);
    
    // Check if the admin has checked the validation checkbox
    if ($request->has('validated')) {
        $utilisateur->email_verified_at = now(); 
    } else {
        $utilisateur->email_verified_at = null; 
    }

    $utilisateur->save();

    return redirect()->back()->with('success', 'Utilisateur validé avec succès');
}

}
