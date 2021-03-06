<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\User;
use App\Models\Comment;
use App\Models\Repost;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['theme','message', 'likes' => 'array'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function reposts(){
        return $this->hasMany(Repost::class);
    }
}
