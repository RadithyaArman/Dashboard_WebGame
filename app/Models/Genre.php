<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = ['name'];
 
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_game');
    }
}
