<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $attributes = [
       
        'user_id'=>1,
        'weight'=>70,
        'date'=>0401,
    ];

    protected $fillable = [
        'memo',
        
        'user_id',
        'weight',
        'date',
        'category'
        
];
     public function user()
{
    
    return $this->belongsTo(User::class);
}


}