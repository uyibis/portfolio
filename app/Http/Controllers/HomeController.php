<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

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
        $projects = Project::query()->orderByDesc('id')->paginate(20);

        $stats = [
            'total' => Project::query()->count(),
            'published' => Project::query()->where('publish', true)->count(),
            'drafts' => Project::query()->where('publish', false)->count(),
        ];

        return view('home', compact('projects', 'stats'));
    }
}
