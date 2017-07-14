<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\EntityStored;
use App\Http\Requests\StoreArtistRequest;
use App\Artist;
use App\AlbumType;
use App\Image;
use App\ImageType;
use App\Recording;
use App\Helpers\ImageHelper;

class ArtistController extends Controller
{
    protected $months = array(
        '',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december'
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::orderBy('title')->paginate(1000);

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
        $dobText = trim($request->input('dob_text'));

        $entity = new Artist;
        $entity->title = $title;
        $entity->is_band = $isBand;
        $entity->slug = $title;

        if (!$isBand) {
            if ($dobText != '') {
                $dobParts = explode(' ', $dobText);
                if (count($dobParts) < 3)
                    return redirect()
                        ->back()
                        ->withErrors(array('Invalid value in date field1'))
                        ->withInput();

                $dobPart1 = trim(strtolower(rtrim($dobParts[0], ',')));
                $dobPart2 = trim(strtolower(rtrim($dobParts[1], ',')));
                $dobPart3 = trim(rtrim($dobParts[2], ','));

                if($idx = array_search($dobPart1, $this->months)) {
                    $dateMonth = $idx;
                    $dateDay = intval($dobPart2);
                }
                else {
                    $dateDay = intval($dobPart1);
                    $idx = array_search($dobPart2, $this->months);
                    if (!$idx)
                        return redirect()
                            ->back()
                            ->withErrors(array('Invalid value in date field2'))
                            ->withInput();

                    $dateMonth = $idx;
                }

                $dateYear = intval($dobPart3);

                $dob = $dateYear . '-' . $dateMonth . '-' . $dateDay;
            } else {
                $dob = trim($request->input('dob'));
            }
            $entity->dob = $dob;
        }

        $entity->description = $description;
        $entity->save();

        $entityId = DB::getPdo()->lastInsertId();
        $eventData = array(
            'request' => $request,
            'imageable_type' => 'App\\Artist',
            'image_type' => 'artist_main',
            'entity' => $entity,
        );

        $event = event(new EntityStored($eventData));

        if(count($event) > 0)
            return redirect()
                ->back()
                ->withErrors($event)
                ->withInput();

        return redirect()->action(
            'RecordingController@createWithArtistRef', ['id' => $entityId]
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
        $artist = Artist::find($id);
        $albumTypes = AlbumType::all();
        $recordings = Recording::with('label')->where('artist_id', $artist->id)->orderBy('year', 'asc')->get();
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
