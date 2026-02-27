<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
    // public function posts(): HasMany{
    //     return $this->hasMany(Post::class);
    // }


    public function orders(): HasMany{
        return $this->hasMany(Order::class, 'customer_id');
    }


    /**
     * HAS ONE OF MANY 
     * 
     * you want to define a convenient way 
     * to interact with the most recent order 
     * the user has placed.
     */
    public function lastestOrder(){
        return $this->hasOne(Order::class)->lastestOfMany();
    }


    public function oldestOrder(){
        return $this->hasOne(Order::class)->oldestOfMany();
    }


    public function largestOrder(){
        return $this->orders()->one()->ofMany('price', 'max');
    }


    // Scoped Relationships

    // Gets all posts of the user
    public function posts(): HasMany{
        return $this->hasMany(Post::class)->latest();
    }


    /**
     * Gets only FEATURED posts of the user
     * public function featuredPosts(): HasMany {
     *    return $this->posts()->where('featured', true);
     * }
     */


    // Gets only FEATURED posts of the user
    // Auto Sets the "featured" attribute to true when creating a new post through this relationship
    public function featuredPosts(): HasMany {
        return $this->posts()->withAttributes(['featured' => true]);
    }
    /**
     * Use cases:
     * $user->posts;
     * $user->featuredPosts()->create([....]);
     */



}
