<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmCategory extends Model
{
    use HasFactory;

    protected $table = 'film_category';
    public $incrementing = false; // Indica que no hay una clave primaria autoincremental
    protected $primaryKey = null; // Indica que no hay una clave primaria única
    public $timestamps = false;

    protected $fillable = [
        'film_id',
        'category_id',
    ];

    // Relación con el modelo Film
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'film_id');
    }

    // Relación con el modelo Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}