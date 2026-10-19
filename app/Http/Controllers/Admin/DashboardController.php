<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Post; use App\Models\Member; use App\Models\ContactMessage; use App\Models\Unit;
class DashboardController extends Controller { public function index(){ $stats=['posts'=>Post::count(),'published'=>Post::where('status','published')->count(),'members'=>Member::count(),'messages'=>ContactMessage::count()]; $posts=Post::with('unit')->latest()->take(6)->get(); $units=Unit::withCount('members')->get(); return view('admin.dashboard',compact('stats','posts','units')); } }
