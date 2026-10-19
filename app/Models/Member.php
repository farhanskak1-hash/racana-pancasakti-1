<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Member extends Model { protected $fillable=['unit_id','student_number','name','study_program','generation','position','photo_path','is_public']; protected $casts=['is_public'=>'boolean']; public function unit(){return $this->belongsTo(Unit::class);} }
