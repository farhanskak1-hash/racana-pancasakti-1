<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\SiteSetting; use Illuminate\Http\Request;
class SettingController extends Controller { public function edit(){ $settings=SiteSetting::pluck('value','key'); return view('admin.settings',compact('settings')); } public function update(Request $r){$data=$r->validate(['site_name'=>'required|string|max:150','tagline'=>'nullable|string|max:250','vision'=>'nullable|string|max:5000','mission'=>'nullable|string|max:5000','address'=>'nullable|string|max:500','email'=>'nullable|email|max:190','instagram'=>'nullable|url|max:255']); foreach($data as $key=>$value) SiteSetting::updateOrCreate(['key'=>$key],['value'=>$value]); return back()->with('success','Pengaturan website disimpan.');} }
