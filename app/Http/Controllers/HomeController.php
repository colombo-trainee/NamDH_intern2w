<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Food;
use App\Models\Menu;
use App\Models\BookTable;

class HomeController extends Controller
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
        $users = User::all()->count('id');
        $book_tables = BookTable::all()->count('id');
        $foods = Food::all()->count('id');
        $menus = Menu::all()->count('id');
        return view('home',compact('users','book_tables','foods','menus'));
    }
}
