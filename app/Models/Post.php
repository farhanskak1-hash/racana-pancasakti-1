<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Post extends Model {
 protected $fillable=['unit_id','title','slug','type','excerpt','body','cover_image','document_path','status','published_at'];
 protected $casts=['published_at'=>'datetime'];
 public function unit(){return $this->belongsTo(Unit::class);}
 protected static function booted(): void { static::creating(function($post){ if(blank($post->slug)) $post->slug=Str::slug($post->title).'-'.Str::lower(Str::random(5)); }); }
 public function scopePublished($query){return $query->where('status','published')->where(function($q){$q->whereNull('published_at')->orWhere('published_at','<=',now());});}
}
