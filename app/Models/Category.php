<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected array $translatable =[
        'title',
        'description',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
