<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function landing2(): View
    {
        $projects = Project::query()
            ->published()
            ->orderByDesc('id')
            ->take(12)
            ->get();

        return view('landing2', compact('projects'));
    }
}
