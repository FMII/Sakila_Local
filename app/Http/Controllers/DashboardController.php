<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Film;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $actorsCount = Actor::count();
        $filmsCount = Film::count();
        $categoriesCount = Category::count();

        // Datos para la gráfica de distribución de películas por categoría
        $categories = Category::withCount('films')->get();
        $categoryNames = $categories->pluck('name');
        $filmsPerCategory = $categories->pluck('films_count');

        // Datos para la gráfica de películas por año
        $filmsPerYear = Film::select(DB::raw('YEAR(release_year) as year'), DB::raw('count(*) as count'))
            ->groupBy(DB::raw('YEAR(release_year)'))
            ->orderBy(DB::raw('YEAR(release_year)'))
            ->get();
        $years = $filmsPerYear->pluck('year');
        $filmsPerYear = $filmsPerYear->pluck('count');

        return view('dashboard', compact('actorsCount', 'filmsCount', 'categoriesCount', 'categoryNames', 'filmsPerCategory', 'years', 'filmsPerYear'));
    }
}