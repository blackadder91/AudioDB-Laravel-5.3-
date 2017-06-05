<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGenreRequest;
use App\AlbumType;
use App\Genre;
use App\Recording;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $genres = Genre::orderBy('title', 'ASC')
             ->get();

         return view('genres.index')
             ->withGenres($genres);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::orderBy('title', 'ASC')->get();
        return view('genres.create')
            ->withGenres($genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenreRequest $request)
    {
        $title = trim($request->input('title'));
        $slug = str_slug($request->input('title'));
        $parent_id = $request->genre;

        if (Genre::where('slug', $slug)->get()->count() > 0)
            return redirect()
                ->back()
                ->withErrors(array('Genre already exists'))
                ->withInput();

        $genre = new Genre;
        $genre->title = $title;
        $genre->slug = str_slug($request->input('title'));
        $genre->parent_id = $parent_id;
        $genre->save();

        return redirect()->action('GenreController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $albumTypes = AlbumType::all();
        $genre = Genre::find($id);
        $genres = Genre::where('parent_id', '=', $id)->pluck('id')->toArray();
        $genres[] = (int)$id;
        $recordings = Recording::whereIn('genre_id', $genres)->orderBy('title')->get();

        return view('genres.show')
            ->withGenre($genre)
            ->withRecordings($recordings)
            ->with('albumTypes', $albumTypes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::find($id);
        $genres = Genre::orderBy('title', 'ASC')->get();
        return view('genres.edit')
            ->withGenres($genres)
            ->withGenre($genre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGenreRequest $request, $id)
    {
        $title = trim($request->input('title'));
        $slug = str_slug($request->input('title'));
        $parent_id = $request->genre;

        $genre = Genre::find($id);
        $genre->title = $title;
        $genre->slug = str_slug($request->input('title'));
        $genre->parent_id = $parent_id;
        $genre->save();

        return redirect()->action('GenreController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Genre::destroy($id);
    }
}
