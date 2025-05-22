<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ArticlesController extends Controller
{
    public function index(){
        $userId = Session::get('user_id');
        $user = DB::table('users')->where('id', $userId)->first();
    
        if (!$user || $user->role != 'expert') {
            Session::flush();
            return redirect('/login')->withErrors(['unauthorized' => 'Anda tidak memiliki izin untuk membuat artikel.']);
        }
        $articles = DB::table('articles')->limit(6)->get();
        return view('expert.articles-main', compact('articles'));
    }
    public function create(){
        $userId = Session::get('user_id');
        $user = DB::table('users')->where('id', $userId)->first();
    
        if (!$user || $user->role != 'expert') {
            Session::flush();
            return redirect('/login')->withErrors(['unauthorized' => 'Anda tidak memiliki izin untuk membuat artikel.']);
        }
        return view('expert.articles-create');
    }
    public function postCreateArticle(Request $request)
    {
        $userId = Session::get('user_id');
        $user = DB::table('users')->where('id', $userId)->first();
    
        if (!$user || $user->role != 'expert') {
            Session::flush();
            return redirect('/login')->withErrors(['unauthorized' => 'Anda tidak memiliki izin untuk membuat artikel.']);
        }
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
        }
    
        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('article'),
            'picture' => $imagePath,
            'date' => now(),
            'id_ahli_tani' => Session::get('user_id'),
        ];
        
        DB::table('articles')->insert($data);
    
        return redirect('/expert/articles')->with('success', 'Artikel berhasil dibuat!');
    }

    public function show($id){
        $article = DB::table('articles')->where('id', $id)->first();

        if (!$article) {
            abort(404);
        }

        return view('expert.articles-show', compact('article'));
    }
}
