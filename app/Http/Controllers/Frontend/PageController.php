<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Project;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Blog;

class PageController extends Controller
{
    public function home() {
        $projects = Project::latest()->take(3)->get();
        return view('home', compact('projects'));
    }

    public function about() {
        $abouts = About::all(); // Trae todos los perfiles
        return view('about', compact('abouts'));
    }

    public function projects() {
        $projects = Project::latest()->get();
        return view('projects', compact('projects'));
    }

    public function projectShow($id) {
        $project = Project::findOrFail($id);
        return view('project-show', compact('project'));
    }

    public function education() {
        $educations = Education::all();
        return view('education', compact('educations'));
    }

    public function experience() {
        $experiences = Experience::all();
        return view('experience', compact('experiences'));
    }

    public function skills() {
        $skills = Skill::all();
        return view('skills', compact('skills'));
    }

    public function blog() {
        $blogs = Blog::latest()->get();
        return view('blog', compact('blogs'));
    }

    public function blogShow($id) {
        $blog = Blog::findOrFail($id);
        return view('blog-show', compact('blog'));
    }

    public function contact() {
        return view('contact');
    }
}
