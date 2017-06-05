<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreArtistRequest;
use App\Artist;
use App\AlbumType;
use App\Image;
use App\ImageType;
use App\Recording;
use App\Helpers\ImageHelper;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::orderBy('title')->paginate(250);

        $artistsGrouped = array();
        $letter = '';

        foreach ($artists as $artist) {
            if ($letter != $artist->title[0]) {
                $letter = $artist->title[0];
                $artistsGrouped[$letter] = array();
            }
            array_push($artistsGrouped[$letter], $artist);
        }

        return view('artists.index')
            ->withArtists($artistsGrouped)
            ->withArtistsRaw($artists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtistRequest $request)
    {

        $title = trim($request->input('title'));

        if (Artist::where('title', $title)->get()->count() >0 )
            return redirect()
                ->back()
                ->withErrors(array('Artist already exists'))
                ->withInput();

        $isBand = $request->input('is_band') ? true : false;
        $description = trim($request->input('description'));

        $entity = new Artist;
        $entity->title = $title;
        $entity->is_band = $isBand;
        $entity->slug = $title;

        if (!$isBand) {
            $dob = trim($request->input('dob'));
            $entity->dob = $dob;
        }

        $entity->description = $description;
        $entity->save();

        // Upload artist photo
        if ($request->hasFile('image')) {
            if (! ImageHelper::upload($request->file('image'), 'App\\Artist', 'artist_main', $request->input('title'), $entity) )
                return redirect()
                    ->back()
                    ->withErrors(array('Failed to upload image'))
                    ->withInput();
        }

        return view('artists.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Artist::find($id);
        $albumTypes = AlbumType::all();
        $recordings = Recording::where('artist_id', $artist->id)->orderBy('release_date', 'asc')->get();
        return view('artists.show')
            ->withArtist($artist)
            ->with('albumTypes', $albumTypes)
            ->withRecordings($recordings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = Artist::find($id);
        return view('artists.edit')->withEntity($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArtistRequest $request, $id)
    {
        $entity = Artist::find($id);
        $entity->title = trim($request->input('title'));
        $entity->is_band = $request->input('is_band') ? true : false;
        $entity->description = trim($request->input('description'));
        if (!$entity->is_band)
            $entity->dob = $request->input('dob');

        $entity->save();

        return redirect()->action(
            'ArtistController@show', ['id' => $id]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = Artist::destroy($id);

        // Remove associated images
        $images = Image::where('imageable_id', $id)->where('imageable_type', 'App\Artist')->pluck('id')->toArray();
        foreach ($images as $image) {
            $return &= Image::destroy($image);
        }

        return response()->json([$return]);
    }
}
