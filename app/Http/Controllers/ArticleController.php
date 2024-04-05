<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleValidation;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->middleware(['auth','admin']);
    }
    public function index()
    {
        $articles = Article::get();
        return view('admin.articles.articles',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.articles.ajouterArticle',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleValidation $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->category_id = $request->category;
        $article->slug = $request->slug;
        $article->save();
        $images = $request->file('images');
        foreach ($images as $image) {
            $extension = '.' . $image->getClientOriginalExtension();
            $filename = uniqid() . '-'. time() .  $extension;
            $image->storeAs('public/articles', $filename);
            ArticleImage::create([
                'path' => $filename,
                'article_id' => $article->id
            ]);
        }
        return redirect('admin/articles')->with(['message' => 'L\'article a été Ajouté']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.article',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::get();
        return view('admin.articles.editArticle',compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleValidation $request, string $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->category_id = $request->category;
        $article->slug = $request->slug;
        $article->save();
        foreach ($article->images as $image) {
            ArticleImage::destroy($image->id);
            $imagePath = public_path('storage/articles/' . $image->path);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $images = $request->file('images');
        foreach ($images as $image) {
            $extension = '.' . $image->getClientOriginalExtension();
            $filename = uniqid() . '-'. time() .  $extension;
            $image->storeAs('public/articles', $filename);
            ArticleImage::create([
                'path' => $filename,
                'article_id' => $article->id
            ]);
        }
        return to_route('articles.show',$article->id)->with(['message' => 'L\'article a été Modifié']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('admin/articles')->with(['message'=>'L\'article a été Supprimé']);
    }

    // Delete All Articles 
    public function deleteAll(){
        Article::query()->delete();
        return redirect('admin/articles')->with(['message','Tous les articles sont supprimés']);
    }

    // Trashed Article
    public function trash(){
        $trashed = Article::onlyTrashed()->get();
        return view('admin.articles.trash', compact('trashed'));   
    }


    // restore article
    public function do_restore(Request $request){
        $article = Article::withTrashed()->find($request->id);
        $article->restore();
        return redirect('admin/articles/')->with(['message'=>'L\'article a été Restauré']);
    }

    // force Delete article
    public function forceDelete(Request $request){
        $article = Article::withTrashed()->find($request->id);
        foreach ($article->images as $image) {
            $imagePath = public_path('storage/articles/' . $image->path);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $article->forceDelete();
        return redirect('admin/articles')->with(['message'=>'L\'article a été Supprimé']);
    }
}
