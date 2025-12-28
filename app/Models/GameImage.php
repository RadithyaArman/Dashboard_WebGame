<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameImage extends Model
{
    protected $fillable = ['game_id', 'url',];

    public function game(): BelongsTo {
        return $this->belongsTo(Game::class);
    }
}
