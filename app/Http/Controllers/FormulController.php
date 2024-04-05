<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FormulController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','annonceur'])->except('store');
    }
    public function dashboard(){
        $messages = Message::take(4)->get();
        $annonces = Annonce::take(4)->get();
        $nbannonces = Annonce::count();
        $nbmessages = Message::count();
        return view('annonceur.dashboard',compact('messages','annonces','nbannonces','nbmessages'));
    }

    // All Message 
    public function index(){
        $messages = Message::all();
        return view('annonceur.messages.messages',compact('messages'));
    }
    // Store Message
    public function store(Request $request){
        $request->validate([
            'nom' => ['required', 'string'],
            'prenom' => ['required', 'string'],
            'email' => ['required', 'email'],
            'telephone' => ['required', 'string', 'min:10'],
            'adresse' => ['required', 'string']
        ], [
            'nom.required' => 'Le champ nom est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'telephone.required' => 'Le champ téléphone est requis.',
            'telephone.min' => 'Le champ téléphone doit avoir au moins :min chiffres.',
            'adresse.required' => 'Le champ adresse est requis.'
        ]);
        $message = new Message();
        $message->nom = $request->nom;
        $message->prenom = $request->prenom;
        $message->email = $request->email;
        $message->telephone = $request->telephone;
        $message->adresse = $request->adresse;
        $message->annonce_id = $request->annonce;
        $message->save();
        return redirect()->back()->with(['message'=>'Le message a été envoyé à l\'annonceur. ']);     
    }
    // Delete Message
    public function destroy(String $id){
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect('annonceur/messages')->with(['messages'=>'le message a été Supprimé']);
    }
    // Delete All Messages
    public function deleteAll(){
        Message::query()->delete();
        return redirect('annonceur/messages')->with(['messages'=>'Tous les messages sont Supprimés']);
    }
    // Deleted Message
    public function trash(){
        $trashed = Message::onlyTrashed()->get();
        return view('annonceur.messages.trash',compact('trashed'));
    }
    // Restore Message
    public function do_restore(Request $request){
        $message = Message::withTrashed()->find($request->id);
        $message->restore();
        return redirect('annonceur/messages')->with(['messages'=>'le message a été Restauré']);
    }
    //Force Delete Message
    public function forceDelete(Request $request){
        $message = Message::withTrashed()->find($request->id);
        $message->forceDelete();
        return redirect('annonceur/messages')->with(['messages'=>'le message a été Supprimé']);
    }

    public function edit(string $id)
    {
        $annonceur = User::findOrFail($id);
        return view('annonceur.profile',compact('annonceur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $annonceur = User::findOrFail($id);
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
        if($annonceur->email != $request->email){
            $annonceur->fname = $request->fname;
            $annonceur->lname = $request->lname;
            $annonceur->email = $request->email;
            $annonceur->phone = $request->phone;
            $annonceur->email_verified_at = null;
            $annonceur->save();
            $link = route('verify', $id);
            send($annonceur->email,$link,$annonceur->fname);
            return redirect('annonceur/dashboard')->with(['message'=>'La modification a été effectuée avec succès. Le lien a été envoyé. Veuillez vérifier votre boîte mail.']);
        }
        $annonceur->fname = $request->fname;
        $annonceur->lname = $request->lname;
        $annonceur->email = $request->email;
        $annonceur->phone = $request->phone;
        $annonceur->save();
        return redirect('annonceur/dashboard')->with(['message'=>'La modification a été effectuée avec succès.']);
        
    }

    /**
     * Update the password.
     */

    public function changerMDP(Request $request, string $id){
        $annonceur = User::findOrFail($id);
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
    
        if (!Hash::check($request->ancien, $annonceur->password)) {
            return redirect()->route('annonceur.profile', ['utilisateur' => $annonceur])->withErrors(['ancien' => 'L\'ancien mot de passe est incorrect.']);
        }
        $annonceur->password = bcrypt($request->password);
        $annonceur->save();
        return redirect('annonnceur/dashboard')->with("message","Le mot de passe a été changé");
    }  

    /**
     * Update the password.
     */

    public function reseau(Request $request, string $id){
        $annonceur = User::findOrFail($id);
        $request->validate([
            'whatsapp'=>'min:10|max:10'
        ]);
        $annonceur->whatsapp = $request->whatsapp;
        $annonceur->facebook = $request->facebook;
        $annonceur->instagram = $request->instagram;
        $annonceur->save();
        return redirect('annonceur/dashboard')->with("message","Les réseaux sociaux sont ajouté");
    }  
}
