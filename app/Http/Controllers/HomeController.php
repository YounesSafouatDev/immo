<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Article;

class HomeController extends Controller
{
    public function dashboard(){
        $annonces = Annonce::take(4)->get();
        $utilisateurs = User::take(4)->get();
        $articles = Article::take(4)->get();
        return view('admin.dashboard',compact('annonces','utilisateurs','articles'));
    }
}
