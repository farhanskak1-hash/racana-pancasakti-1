<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Member; use App\Models\Unit; use Illuminate\Http\Request; use Illuminate\Support\Facades\Storage;
class MemberController extends Controller {
 public function index(){ $members=Member::with('unit')->orderBy('name')->paginate(15); return view('admin.members.index',compact('members')); }
 public function create(){ $member=new Member; $units=Unit::all(); return view('admin.members.form',compact('member','units')); }
 public function store(Request $r){$data=$this->validated($r); if($r->hasFile('photo'))$data['photo_path']=$r->file('photo')->store('members','public'); $data['is_public']=$r->boolean('is_public'); Member::create($data); return redirect()->route('admin.anggota.index')->with('success','Data anggota ditambahkan.');}
 public function edit(Member $member){$units=Unit::all(); return view('admin.members.form',compact('member','units'));}
 public function update(Request $r, Member $member){$data=$this->validated($r); if($r->hasFile('photo')){$data['photo_path']=$r->file('photo')->store('members','public');} $data['is_public']=$r->boolean('is_public'); $member->update($data); return redirect()->route('admin.anggota.index')->with('success','Data anggota diperbarui.');}
 public function destroy(Member $member){$member->delete();return back()->with('success','Data anggota dihapus.');}
 private function validated(Request $r):array{return $r->validate(['unit_id'=>'required|exists:units,id','student_number'=>'nullable|string|max:40','name'=>'required|string|max:150','study_program'=>'nullable|string|max:120','generation'=>'nullable|string|max:40','position'=>'nullable|string|max:120','photo'=>'nullable|image|max:3072']);}
}
