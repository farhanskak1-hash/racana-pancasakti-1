<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\OrganizationStructure; use App\Models\Unit; use App\Models\Member; use Illuminate\Http\Request;
class StructureController extends Controller {
 public function index(){ $structures=OrganizationStructure::with(['unit','member'])->orderBy('unit_id')->orderBy('sort_order')->paginate(15); return view('admin.structures.index',compact('structures')); }
 public function create(){ $structure=new OrganizationStructure; $units=Unit::all(); $members=Member::orderBy('name')->get(); return view('admin.structures.form',compact('structure','units','members')); }
 public function store(Request $r){OrganizationStructure::create($this->validated($r));return redirect()->route('admin.struktur.index')->with('success','Struktur ditambahkan.');}
 public function edit(OrganizationStructure $structure){$units=Unit::all();$members=Member::orderBy('name')->get();return view('admin.structures.form',compact('structure','units','members'));}
 public function update(Request $r, OrganizationStructure $structure){$structure->update($this->validated($r));return redirect()->route('admin.struktur.index')->with('success','Struktur diperbarui.');}
 public function destroy(OrganizationStructure $structure){$structure->delete();return back()->with('success','Jabatan dihapus.');}
 private function validated(Request $r):array{return $r->validate(['unit_id'=>'required|exists:units,id','member_id'=>'nullable|exists:members,id','position_title'=>'required|string|max:150','period'=>'nullable|string|max:60','sort_order'=>'required|integer|min:0|max:999']);}
}
