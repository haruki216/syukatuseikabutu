<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
     public function getByLimit(int $limit_count=10){
        return $this->with('user')->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
     protected $attributes = [
        
        'user_id'=>1,
       'image'=>0,
       
    ];
    
    protected $fillable = [
     'user_id',
    'content',
    'image'
];


public function test_store(): void
{
    Storage::fake('s3');
    $file = UploadedFile::fake()->image('test.jpg');
    // login_userが認証を通過しているとする
    $this->assertAuthenticatedAs($this->login_user);
    $response = $this->actingAs($this->login_user)->post(route('post.store'), [
        'title' => 'Test Title',
        'body' => 'Test Body',
        'image' => $file,
    ]);
    $response->assertStatus(302);
    Storage::disk('s3')->assertExists('images/' . $file->hashName());
    $response->assertRedirect(route('post.index'));
 }
    public function user()
{
    return $this->belongsTo(User::class);
}
}