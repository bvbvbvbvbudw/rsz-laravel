<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'published_at', 'user_id'];

    public function user()
    {
        return $this->belongsTo(MoonshineUser::class, 'user_id');
    }

}
