<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class CatalogController extends Controller
{
    public function getIndex()
    {
        return view('catalog.index',
            array(
                'arrayPeliculas' => Movie::all()
            )
        );
    }

    public function getShow($id)
    {
        $pelicula = Movie::findOrFail($id);
        return view('catalog.show', array(
            'pelicula' => $pelicula
        ));
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function getEdit($id)
    {
        $pelicula = Movie::findOrFail($id);
        return view('catalog.edit', array(
            'pelicula' => $pelicula
        ));
    }

    public function postCreate (Request $request){
        $pelicula = new Movie;
        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year') ;
        $pelicula->director = $request->input('director') ;
        $pelicula->poster = $request->input('poster') ;
        $pelicula->synopsis = $request->input('synopsis') ;
        $pelicula->save();
        return redirect(action('CatalogController@getIndex', 'catalog'));
    }
    public function putEdit (Request $request){
        $id = $request->input('id');
        $pelicula = Movie::findOrFail($id);
        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year') ;
        $pelicula->director = $request->input('director') ;
        $pelicula->poster = $request->input('poster') ;
        $pelicula->synopsis = $request->input('synopsis') ;
        $pelicula->save();
        return redirect(action('CatalogController@getShow', $id));
    }
}
