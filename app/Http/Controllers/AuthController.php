<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Models\Category;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except(['logout']);
    }
    public function show_register(){
        $categories = Category::all();
        return view('auth.register',compact('categories'));
    }

    public function show_login(){
        $categories = Category::all();
        return view('auth.login',compact('categories'));
    }

    public function register(RegisterValidation $request){
        $user = register($request);
        $link = route('verify', $user->id);
        $nomComplet = $user->fname.' '.$user->lname;
        send($user->email,$link,$nomComplet);
        return redirect('/seconnecter')->with('message','Veuillez vérifier votre adresse e-mail pour la confirmation');
    }

    public function login(LoginValidation $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->remember;
        if (Auth::attempt($credentials)) {
            $user = User::where('email',$credentials['email'])->first();
            if ($user->email_verified_at != null) {
                $request->session()->regenerate();
                if(asset($remember) && !empty($remember)){
                    setcookie('email',$user->email);
                }
                if($user->role_id == 1){
                    return view('admin.dashboard');
                }else if($user->role_id == 3){
                    return view('annonceur.dashboard');
                }
                else {
                    return redirect()->intended();
                }
                
            } else {
                setcookie('email',"");
                setcookie('password',"");
                return back()->onlyInput('email')->with('error', 'Vérifiez votre adresse e-mail');
            }
        } else {
            return back()->onlyInput('email')->with('error', 'Le mot de passe est incorrect.');
        }
    }


    public function emailVerify($id){

        $user = User::findOrFail($id);
        $user->email_verified_at = now();
        $user->save();
        return redirect('/seconnecter')->with('message','Votre adresse e-mail est vérifiée.');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/seconnecter');
    }

    public function forget(){
        $categories = Category::all();
        return view('auth.forgetpassword',compact('categories'));
    }

    public function recovery(Request $request){
        $request->validate(
            ['email'=>'required|email|exists:users,email'],
            [
                'email.required' => 'Le champ email est requis.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'email.exists' => "L'email n'existe pas "
            ]
        );
        $user = User::where('email',$request->email)->first();
        $password = Str::random(10); 
        $user->password = Hash::make($password);
        $nomComplet = $user->fname.' '.$user->lname;
        $user->save();
        recovery($user->email,$password,$nomComplet);
        return redirect('/seconnecter')->with('message', 'Le Mot De Passe est dans votre Boite E-mail');
    }
   
}
