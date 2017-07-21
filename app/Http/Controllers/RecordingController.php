<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\EntityStored;
use App\Events\EntityUpdated;
use App\Http\Requests\StoreRecordingRequest;
use App\Http\Requests\UpdateRecordingRequest;
use App\Artist;
use App\AlbumType;
use App\Format;
use App\Genre;
use App\Image;
use App\ImageType;
use App\Recording;
use App\Release;
use App\Helpers\ImageHelper;

class RecordingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albumTypes = AlbumType::all();
        $recordings = Recording::orderBy('created_at', 'DESC')->paginate(50);
        return view('recordings.index')
            ->withRecordings($recordings)
            ->with('albumTypes', $albumTypes);
    }

    public function filter(Request $request)
    {
        $albumTypes = AlbumType::all();
        $albumTypeSlugs = array_values($albumTypes->pluck('slug')->toArray());
        $recordings = new Recording;

        if ($title = $request->input('title'))
            $recordings = $recordings->where('title', 'like' , '%' . $title . '%');

        if ($artistTitle = $request->input('artist_title')) {
            $artists = Artist::where('title', 'like' , '%' . $artistTitle . '%')->pluck('id')->toArray();
            if (count($artists) > 0) {
                $recordings = $recordings->where('artist_id', $artists);
            }
        }
        if (($albumType = $request->input('album_type')) && in_array($request->input('album_type'), $albumTypeSlugs)) {
            $albumTypeId = AlbumType::where('slug', $albumType)->firstOrFail()->id;
            $recordings = $recordings->where('album_type_id', $albumTypeId);
        }

        $recordings = $recordings->get();
        return view('recordings.index')
            ->withRecordings($recordings)
            ->with('albumTypes', $albumTypes)
            ->withInput($request->all());
    }

    public function createWithArtistRef($id)
    {
        return $this->create($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($artistRefId = null)
    {
        $artists = Artist::orderBy('title', 'asc')->get();
        $albumTypes = AlbumType::all();
        $genres = Genre::orderBy('title', 'asc')->get();
        $refArtist = null;

        if($artistRefId != null) // get referred artist
            $refArtist = Artist::find($artistRefId);

        return view('recordings.create')
            ->withArtists($artists)
            ->with('albumTypes', $albumTypes)
            ->withGenres($genres)
            ->with('artistRefId', $artistRefId)
            ->with('refArtist', $refArtist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecordingRequest $request)
    {
        extract($request->all());
        $title = trim($title);
        $slug = str_slug($slug);
        if (Recording::where('title', $title)->where('artist_id', $artist)->get()->count() >0 )
            return redirect()
                ->back()
                ->withErrors(array('Recording already exists'))
                ->withInput();

        $entity = new Recording;
        $entity->title = $title;
        $entity->slug = $slug;
        $entity->year = $year;
        $entity->tracklist = isset($tracklist) ? $tracklist : null;
        $entity->artist_id = $artist;
        $entity->album_type_id = $album_type;
        $entity->genre_id = $genre;
        $entity->save();

        $entityId = DB::getPdo()->lastInsertId();
        $eventData = array(
            'request' => $request,
            'imageable_type' => 'App\\Recording',
            'image_type' => 'recording_main',
            'entity' => $entity,
        );

        $event = event(new EntityStored($eventData));

        if(count($event) > 0)
            return redirect()
                ->back()
                ->withErrors($event)
                ->withInput();

        return redirect()->action(
            'ReleaseController@createWithRecordingRef', ['id' => $entityId]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recording = Recording::find($id);
        $releases = Release::where('recording_id', $recording->id)->get();
        $formats = Format::all();
        return view('recordings.show')
            ->withRecording($recording)
            ->withReleases($releases)
            ->withFormats($formats);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recording = Recording::find($id);
        $artists = Artist::orderBy('title', 'asc')->get();
        $albumTypes = AlbumType::all();
        $genres = Genre::orderBy('title', 'asc')->get();
        return view('recordings.edit')
            ->withEntity($recording)
            ->withArtists($artists)
            ->with('albumTypes', $albumTypes)
            ->withGenres($genres);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecordingRequest $request, $id)
    {
        extract($request->all());
        $title = trim($title);
        $entity = Recording::find($id);
        $entity->title = $title;
        $entity->year = $year;
        $entity->tracklist = isset($tracklist) ? $tracklist : null;
        $entity->artist_id = $artist;
        $entity->album_type_id = $album_type;
        $entity->genre_id = $genre;
        $entity->save();

        $eventData = array(
            'request' => $request,
            'imageable_type' => 'App\\Recording',
            'image_type' => 'recording_main',
            'entity' => $entity,
        );

        $event = event(new EntityUpdated($eventData));

        return redirect()->action(
            'RecordingController@show', ['id' => $id]
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
        $return = Recording::destroy($id);

        // Remove associated images
        $images = Image::where('imageable_id', $id)->where('imageable_type', 'App\Recording')->pluck('id')->toArray();
        foreach ($images as $image) {
            $return &= Image::destroy($image);
        }

        return response()->json([$return]);
    }
}
