<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmActor extends Model
{
    use HasFactory;

    protected $table = 'film_actor';
    public $incrementing = false; 
    protected $primaryKey = ['film_id', 'actor_id']; // Define composite keys
    public $timestamps = false;

    protected $fillable = [
        'film_id',
        'actor_id',
        'last_update'
    ];

    // This is needed for composite keys
    public function getRouteKeyName()
    {
        return 'film_id'; // Choose one of the keys for route binding
    }
    
    // Custom method to find by composite key
    public static function findByCompositeKey($filmId, $actorId)
    {
        return static::where('film_id', $filmId)
                     ->where('actor_id', $actorId)
                     ->first();
    }

    // Relationships remain the same
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'film_id');
    }

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actor_id', 'actor_id');
    }
}
