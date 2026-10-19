<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrganizationStructure extends Model { protected $fillable=['unit_id','member_id','position_title','period','sort_order']; public function unit(){return $this->belongsTo(Unit::class);} public function member(){return $this->belongsTo(Member::class);} }
