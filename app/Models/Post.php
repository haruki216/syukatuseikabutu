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



    public function user()
{
    return $this->belongsTo(User::class);
}
}