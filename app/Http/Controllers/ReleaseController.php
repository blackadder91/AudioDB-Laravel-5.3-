<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\EntityStored;
use App\Events\EntityUpdated;
use App\Http\Requests\StoreReleaseRequest;
use App\Http\Requests\UpdateReleaseRequest;
use App\ArchDisc;
use App\Archive;
use App\Artist;
use App\Country;
use App\Format;
use App\Image;
use App\Label;
use App\Recording;
use App\Release;
use App\Helpers\ImageHelper;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formats = Format::all();
        $releases = Release::orderBy('created_at', 'DESC')->paginate(50);

        return view('releases.index')
            ->withReleases($releases)
            ->with('formats', $formats);
    }

    public function filter(Request $request)
    {
        $formats = Format::all();
        $formatSlugs = array_values($formats->pluck('slug')->toArray());
        $releases = new Release;
        $releases = $releases
            ->join('recordings', 'recordings.id', '=', 'releases.recording_id');

        if ($title = $request->input('title'))
            $releases = $releases->where('title', 'like' , '%' . $title . '%');

        if ($artistTitle = $request->input('artist_title')) {
            $artists = Artist::where('title', 'like' , '%' . $artistTitle . '%')->pluck('id')->toArray();
            if (count($artists) > 0) {
                $releases = $releases
                    ->join('artists', 'artists.id', '=', 'recordings.artist_id')
                    ->where('recordings.artist_id', $artists);
            }
        }
        if (($format = $request->input('format')) && in_array($request->input('format'), $formatSlugs)) {
            $formatId = Format::where('slug', $format)->firstOrFail()->id;
            $releases = $releases->where('format_id', $formatId);
        }

        $releases = $releases->select('releases.*')->get();
        return view('releases.index')
            ->withReleases($releases)
            ->with('formats', $formats)
            ->withInput($request->all());
    }

    public function createWithRecordingRef($id)
    {
        return $this->create($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($recordingRefId = null)
    {

        $archDiscs = ArchDisc::where('is_complete', '=', false)->get();
        $recordings = Recording::orderBy('title', 'ASC')->get();
        $countries = Country::orderBy('title', 'ASC')->get();
        $formats = Format::orderBy('title', 'ASC')->get();
        $labels = Label::orderBy('title', 'ASC')->get();

        return view('releases.create')
            ->withRecordings($recordings)
            ->withCountries($countries)
            ->withFormats($formats)
            ->withLabels($labels)
            ->with('archDiscs', $archDiscs)
            ->with('recordingRefId', $recordingRefId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReleaseRequest $request)
    {
        extract($request->all());
        $catalog_no = trim($catalog_no);
        $isbn = trim($isbn) != '' ? trim($isbn) : null;
        $year = trim($year) != '' ? trim($year) : null;

        if (Release::where('slug', $slug)->get()->count() > 0 )
            return redirect()
                ->back()
                ->withErrors(array('Release already exists'))
                ->withInput();

        $entity = new Release;
        $entity->catalog_no = $catalog_no;
        $entity->isbn = $isbn;
        $entity->slug = $slug;
        $entity->year = $year;
        $entity->tracklist = isset($tracklist) ? $tracklist : null;
        $entity->notes = $notes;
        $entity->label_id = $label;
        $entity->format_id = $format;
        $entity->country_id = $country;
        $entity->recording_id = $recording;
        $entity->use_recording_photo = isset($use_recording_photo) || (!$request->hasFile('image')) ? true : false;
        $entity->save();

        $entityId = DB::getPdo()->lastInsertId();
        $eventData = array(
            'request' => $request,
            'imageable_type' => 'App\\Release',
            'image_type' => 'recording_main',
            'entity' => $entity,
        );

        $event = event(new EntityStored($eventData));
        if(count($event) > 0 && $event[0] != null)
            return redirect()
                ->back()
                ->withErrors($event)
                ->withInput();

        if ($arch_disc != 0) {
            $archive = new Archive();
            $archive->release_id = $entity->id;
            $archive->arch_disc_id = $arch_disc;
            $archive->file_format_id = 1;
            $archive->flags = 0;
            $archive->notes = $arch_disc_notes;
            $archive->save();
        }

        return redirect()->action(
            'ReleaseController@show',
            array('id' => $entityId)
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
        $release = Release::find($id);
        return view('releases.show')
            ->withRelease($release);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archDiscs = ArchDisc::where('is_complete', '=', false)->get();
        $release = Release::find($id);
        $countries = Country::orderBy('title', 'ASC')->get();
        $formats = Format::orderBy('title', 'ASC')->get();
        $labels = Label::orderBy('title', 'ASC')->get();

        return view('releases.edit')
            ->withEntity($release)
            ->withCountries($countries)
            ->withFormats($formats)
            ->withLabels($labels)
            ->with('archDiscs', $archDiscs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReleaseRequest $request, $id)
    {
        extract($request->all());
        $catalog_no = trim($catalog_no);
        $isbn = trim($isbn) != '' ? trim($isbn) : null;
        $year = trim($year) != '' ? trim($year) : null;

        $entity = Release::find($id);
        $entity->catalog_no = $catalog_no;
        $entity->isbn = $isbn;
        $entity->year = $year;
        $entity->tracklist = isset($tracklist) ? $tracklist : null;
        $entity->notes = $notes;
        $entity->label_id = $label;
        $entity->format_id = $format;
        $entity->country_id = $country;
        $entity->use_recording_photo = isset($use_recording_photo) || (!$request->hasFile('image')) ? true : false;
        $entity->save();

        if ($arch_disc != 0) {
            $archive = new Archive();
            $archive->release_id = $entity->id;
            $archive->arch_disc_id = $arch_disc;
            $archive->file_format_id = 1;
            $archive->flags = 0;
            $archive->notes = $notes;
            $archive->save();
        }

        return redirect()->action(
            'ReleaseController@show', ['id' => $id]
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
        $return = Release::destroy($id);

        // Remove associated images
        $images = Image::where('imageable_id', $id)->where('imageable_type', 'App\Release')->pluck('id')->toArray();
        foreach ($images as $image) {
            $return &= Image::destroy($image);
        }

        return response()->json([$return]);
    }
}
