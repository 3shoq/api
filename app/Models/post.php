<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class post extends Model
{
    use HasFactory,HasApiTokens;
    
    protected $fillable = [

        'title' , 'content' , 'data_written',
        'post_imge' , 'votes_up' , 'votes_down',
        'user_id', 'category_id', 'voters_up',
        'voters_down',
    ];


    /**
     * Get all of the comments for the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the user that owns the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, );
    }

    /**
     * Get the category that owns the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(category::class,);
    }
}
