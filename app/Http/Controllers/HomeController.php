<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $applications = Application::paginate(9);
        return view('home', ['applications' => $applications])->with('page', 'Home');
    }
}
