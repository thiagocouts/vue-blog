<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Artigo;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaBread = json_encode([
            ['title'=> "Admin", 'url'=> ""]
        ]);

        $users = User::all()->count();
        $autores = User::where('author', 'S')->count();
        $admins = User::where('adm', 'S')->count();
        $artigos = Artigo::all()->count();

        return view('home', compact('listaBread', 'users', 'artigos', 'autores', 'admins'));
    }
}
