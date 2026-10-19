<?php
namespace App\Http\Controllers;
use App\Models\Post; use App\Models\Unit; use App\Models\Member; use App\Models\OrganizationStructure; use Illuminate\Http\Request;
class PublicController extends Controller {
 public function home(){ $posts=Post::published()->with('unit')->latest('published_at')->latest()->take(6)->get(); $units=Unit::withCount('members')->get(); return view('public.home',compact('posts','units')); }
 public function posts(Request $request){ $q=Post::published()->with('unit')->latest('published_at'); if($request->filled('type') && in_array($request->type,['berita','jurnal','pengumuman'])) $q->where('type',$request->type); if($request->filled('q')) $q->where(fn($x)=>$x->where('title','like','%'.$request->q.'%')->orWhere('excerpt','like','%'.$request->q.'%')); $posts=$q->paginate(9)->withQueryString(); return view('public.posts',compact('posts')); }
 public function showPost(Post $post){ abort_unless($post->status==='published' && (!$post->published_at || $post->published_at->isPast()),404); return view('public.post',compact('post')); }
 public function about(){ $units=Unit::all(); $structures=OrganizationStructure::with(['unit','member'])->orderBy('sort_order')->get()->groupBy('unit_id'); $members=Member::where('is_public',true)->with('unit')->orderBy('name')->get(); return view('public.about',compact('units','structures','members')); }
 public function unit(Unit $unit){ $members=$unit->members()->where('is_public',true)->orderBy('name')->get(); $structures=$unit->structures()->with('member')->orderBy('sort_order')->get(); $posts=$unit->posts()->published()->latest()->take(4)->get(); return view('public.unit',compact('unit','members','structures','posts')); }
 public function contact(){ return view('public.contact'); }
}
