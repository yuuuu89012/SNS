<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function favorites(){
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }
    public function favorite($postId){
        $exist=$this->is_favorite($postId);
        if($exist){
            return false;
        }
        else{
            $this->favorites()->attach($postId);
            return true;
        }
    }

    public function unfavorite($postId){
        $exist=$this->is_favorite($postId);
        if($exist){
            $this->favorites()->detach($postId);
            return true;
        }
        else{
            return false;
        }
    }
    public  function is_favorite($postId){
        return $this->favorites()->where('post_id',$postId)->exists();
    }

    public function followers(){
        return  $this->belongsToMany(User::class, 'followers','followed_id','following_id');
    }
    public function follows(){
        return  $this->belongsToMany(User::class, 'followers','following_id','followed_id');
    }
    public function follow($userId){
        return  $this->follows()->attach($userId);
    }
    public function unfollow($userId){
        return  $this->follows()->detach($userId);
    }
    public function isFollowing($userId){
        return (boolean) $this->follows()->where('followed_id',$userId)->first(['id']);
    }
    public function isFollowed($userId){
        return (boolean) $this->followers()->where('following_id',$userId)->first(['id']);
    }
}

