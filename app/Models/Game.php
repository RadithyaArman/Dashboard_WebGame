<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nette\Utils\Image;

class Game extends Model
{
    protected $fillable = ['title', 'cover', 'rating', 'developer', 'publisher', 'description'];

    public function images(): HasMany {
        return $this->hasMany(GameImage::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_game');
    }
}
