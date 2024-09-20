<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;
     protected $attributes = [
        
        'user_id'=>1,
        'weight'=>75.3,
        'date'=>0401,
    ];

    protected $fillable = [
        'user_id',
        'weight',
        'date',
        
        
];
    
    
     public function user()
{
    return $this->belongsTo(User::class);
}
    
}