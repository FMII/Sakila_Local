<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::paginate(15);
        return view('languages.index', compact('languages'));
    }

    public function create()
    {
        return view('languages.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20|unique:language,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Language::create($request->all());

        return redirect()->route('languages.index')
            ->with('success', 'Idioma creado exitosamente.');
    }

    public function show(Language $language)
    {
        $language->load('films');
        return view('languages.show', compact('language'));
    }

    public function edit(Language $language)
    {
        return view('languages.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20|unique:language,name,' . $language->language_id . ',language_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $language->update($request->all());

        return redirect()->route('languages.index')
            ->with('success', 'Idioma actualizado exitosamente');
    }

    // public function destroy(Language $language)
    // {
    //     try {
    //         $language->delete();
    //         return redirect()->route('languages.index')
    //             ->with('success', 'Idioma eliminado exitosamente');
    //     } catch (\Exception $e) {
    //         return redirect()->route('languages.index')
    //             ->with('error', 'No se puede eliminar el idioma porque tiene películas asociadas');
    //     }
    // }
}