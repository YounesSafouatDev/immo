<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function welcome (){
        $articles = Article::take(3)->get();
        $annonceurs = User::where('role_id', 3)
        ->where(function ($query) {
            $query->whereNotNull('email_verified_at')
                ->orWhereNull('email_verified_at');
        })
        ->orderBy('id')
        ->limit(3)
        ->get();
        $categories = Category::all();
        $annonces = Annonce::where('is_valid',true)->take(3)->get();
        return view('welcome',compact('articles','annonceurs','categories','annonces'));
    }
    public function biens(String $id = null){
        $ids = Category::pluck('id')->toArray();
        if (in_array($id, $ids)) {
            $categories = Category::all();
            $annonces = Annonce::where('category_id','=',$id)->where('is_valid', true)->orderBy('is_premium', 'DESC')->paginate(9, ['*'], 'annonces');
            return view('biens',compact('annonces','categories'));
        } else {
            $categories = Category::all();
            $annonces = Annonce::where('is_valid', true)->orderBy('is_premium', 'DESC')->paginate(9, ['*'], 'annonces');
            return view('biens',compact('annonces','categories'));
        }
        
    }
    public function bien(String $id){
        $annonce = Annonce::findOrFail($id);
        $categories = Category::all();
        $annonces = Annonce::where('is_valid',true)->orderBy('is_premium','DESC')->latest()->take(6)->get();
        return view('bien',compact('annonce','annonces','categories'));
    }
    public function articles() {
        $articles = Article::latest()->paginate( $perPage = 9, $columns = ['*'], $pageName = 'articles');
        $categories = Category::all();
        return view('articles',compact('articles','categories'));
    }
    public function article(String $id){
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $articles = Article::latest()->take(6)->get(['id','title']);
        $annonces = Annonce::where('is_valid',true)->orderBy('is_premium','DESC')->latest()->take(6)->get();

        return view('article',compact('article','categories','articles','annonces'));
    }

    public function contact(){
        $categories = Category::all();
        return view('contact',compact('categories'));
    }
    public function about(){
        $categories = Category::all();
        return view('about',compact('categories'));
    }
    public function deposer() {
        $categories = Category::all();
        return redirect('/seconnecter')->with('categories', $categories);
    }
    

    public function search(Request $request){
        $annonces = Annonce::query();
        if ($request->ville) {
            $annonces->where('city', $request->ville);
        }

        if ($request->type != 0) {
            $annonces->where('type', $request->type);
        }

        if ($request->bien) {
            $annonces->where('category_id', $request->bien);
        }

        if ($request->min) {
            $annonces->where('price', '>=', $request->min);
        }

        if ($request->chambre) {
            $annonces->where('bedroom', '>=', $request->chambre);
        }

        if ($request->sdb) {
            $annonces->where('bathroom', '>=',$request->sdb);
        }
        $categories = Category::all();
        $annonces = $annonces->where('is_valid',true)->orderBy('is_premium','DESC')->paginate( $perPage = 9, $columns = ['*'], $pageName = 'annonces');
        return redirect()->route('biens')->with(['annonces' => $annonces, 'categories' => $categories]);

    }
    public function contactezNous(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            'subject' => 'required',
            'message' => 'required'
        ],[
            'name.required' => 'Le champ nom est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'phone.required' => 'Le champ téléphone est requis.',
            'phone.digits' => 'Le téléphone doit avoir :digits chiffres.',
            'phone.numeric' => 'Le téléphone doit être un numéro valide.',
            'subject.required' => 'Le champ sujet est requis.',
            'message.required' => 'Le champ message est requis.'
        ]);
        Contact::create($request->all());
    
        return redirect()->back()
                         ->with(['success' => 'Merci de nous contacter. Nous vous répondrons sous peu.']);
    }
    
}
