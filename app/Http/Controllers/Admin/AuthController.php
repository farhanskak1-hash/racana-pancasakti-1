<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Http\Request; use Illuminate\Support\Facades\Hash; use App\Models\AdminUser;
class AuthController extends Controller {
 public function showLogin(){if(session('racana_admin_id')) return redirect()->route('admin.dashboard'); return view('auth.admin-login');}
 public function login(Request $request){$data=$request->validate(['email'=>'required|email','password'=>'required|string']); $admin=AdminUser::where('email',$data['email'])->first(); if(!$admin || !Hash::check($data['password'],$admin->password)){return back()->withErrors(['email'=>'Email atau password tidak sesuai.'])->onlyInput('email');} $request->session()->regenerate(); $request->session()->put('racana_admin_id',$admin->id); $request->session()->put('racana_admin_name',$admin->name); return redirect()->route('admin.dashboard');}
 public function logout(Request $request){$request->session()->forget(['racana_admin_id','racana_admin_name']); $request->session()->regenerateToken(); return redirect()->route('home');}
}
