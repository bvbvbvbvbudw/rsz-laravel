<?php
namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        return Cache::remember("posts_shareholders", now()->addHours(1), function  () {
            return Post::with(['user:id,name'])->get();
        });
    }
}
