<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'language';
    protected $primaryKey = 'language_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function films()
    {
        return $this->hasMany(Film::class, 'language_id');
    }

    public function originalLanguageFilms()
    {
        return $this->hasMany(Film::class, 'original_language_id');
    }
}
