<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Post extends Model
{
    //

    /**
     * Get the comments for the blog post.
     */
    public function comments(): HasMany{
        return $this->hasMany(Comment::class)->chaperone();
    }


    /**
     * Get the author of the post
     */
    public function user(): BelongsTo{
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Unknown Author',
        ]);
    }

    /**
     * 
     * Real world example:
     * A Country has many Users, and a User has many Posts.
     *  So a Country has many Posts through Users.
     * Country -> Users -> Posts
     */
    public function posts(): HasManyThrough{
        return $this->hasManyThrough(Post::class, User::class);
    }

    // Use cases: 
    // $posts = $country->posts;


    // Mechanic -> Car -> Owner
    /**
     * public function carOwner(): HasOneThrough{
     *     return $this->hasOneThrough(Owner::class, Car::class);
     * }
     */

}   
