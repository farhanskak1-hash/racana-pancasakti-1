<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void {
 Schema::create('admin_users',function(Blueprint $t){$t->id();$t->string('name');$t->string('email')->unique();$t->string('password');$t->timestamps();});
 Schema::create('units',function(Blueprint $t){$t->id();$t->string('name');$t->string('slug')->unique();$t->text('description')->nullable();$t->timestamps();});
 Schema::create('posts',function(Blueprint $t){$t->id();$t->foreignId('unit_id')->nullable()->constrained()->nullOnDelete();$t->string('title');$t->string('slug')->unique();$t->enum('type',['berita','jurnal','pengumuman']);$t->string('excerpt',500)->nullable();$t->longText('body');$t->string('cover_image')->nullable();$t->string('document_path')->nullable();$t->enum('status',['draft','published'])->default('draft');$t->timestamp('published_at')->nullable();$t->timestamps();$t->index(['status','type','published_at']);});
 Schema::create('members',function(Blueprint $t){$t->id();$t->foreignId('unit_id')->constrained()->cascadeOnDelete();$t->string('student_number')->nullable();$t->string('name');$t->string('study_program')->nullable();$t->string('generation')->nullable();$t->string('position')->nullable();$t->string('photo_path')->nullable();$t->boolean('is_public')->default(false);$t->timestamps();});
 Schema::create('organization_structures',function(Blueprint $t){$t->id();$t->foreignId('unit_id')->constrained()->cascadeOnDelete();$t->foreignId('member_id')->nullable()->constrained('members')->nullOnDelete();$t->string('position_title');$t->string('period')->nullable();$t->unsignedSmallInteger('sort_order')->default(0);$t->timestamps();});
 Schema::create('contact_messages',function(Blueprint $t){$t->id();$t->string('name');$t->string('email');$t->string('subject');$t->text('message');$t->boolean('is_read')->default(false);$t->timestamps();});
 Schema::create('site_settings',function(Blueprint $t){$t->id();$t->string('key')->unique();$t->text('value')->nullable();$t->timestamps();});
 }
 public function down(): void {Schema::dropIfExists('site_settings');Schema::dropIfExists('contact_messages');Schema::dropIfExists('organization_structures');Schema::dropIfExists('members');Schema::dropIfExists('posts');Schema::dropIfExists('units');Schema::dropIfExists('admin_users');}
};
