<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Unit extends Model { protected $fillable = ['name','slug','description']; public function members(){ return $this->hasMany(Member::class); } public function posts(){ return $this->hasMany(Post::class); } public function structures(){ return $this->hasMany(OrganizationStructure::class); } }
