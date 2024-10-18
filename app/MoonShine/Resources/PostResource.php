<?php
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;
    protected string $title = 'Posts';

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->required(),
            TinyMce::make('Content')->required(),
            Hidden::make('Published At')->default(now()),
        ];
    }

    protected function beforeCreating(Model $item): Model
    {
        $item->user_id = auth()->id();
        $item->published_at = now();
        return $item;
    }


    public function rules(Model $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
