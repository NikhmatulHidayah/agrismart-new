<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class farmerController extends Controller
{
    public function dashboard(){
        $articles = DB::table('articles')
            ->join('users', 'articles.id_ahli_tani', '=', 'users.id')
            ->select('articles.id', 'articles.title', 'articles.picture', 'articles.date', 'articles.content', 'users.name as author_name')
            ->get();

        //dd($articles);

        return view('dashboard', compact('articles'));
    }

    public function show($id)
    {
        $article = DB::table('articles')
            ->join('users', 'articles.id_ahli_tani', '=', 'users.id')
            ->select('articles.id', 'articles.title', 'articles.picture', 'articles.date', 'articles.content', 'users.name as author_name')
            ->where('articles.id', $id)
            ->first();

        if (!$article) {
            return abort(404, 'Article not found');
        }

        if (!$article) {
            return abort(404, 'Article not found');
        }

        return view('article.show', compact('article'));
    }
}
