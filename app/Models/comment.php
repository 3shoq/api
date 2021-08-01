<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class comment extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [

        
        'content' , 'datetime', 'author_id' , 'post_id' ,'name_id'
        

        

    ];

    public function post()
    {
        return $this->belongsTo(post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,);
    }

}
