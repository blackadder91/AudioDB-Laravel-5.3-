<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArchDisc;
use App\Format;
use App\Release;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archive = ArchDisc::orderBy('title')->paginate(50);

        return view('archive.index')->withArchive($archive);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('archive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = trim($request->input('title'));

        if (ArchDisc::where('title', $title)->get()->count() >0 )
            return redirect()
                ->back()
                ->withErrors(array('Disc already exists'))
                ->withInput();

        $notes = trim($request->input('notes'));
        $disc_brand = trim($request->input('disc_brand'));

        $entity = new ArchDisc;
        $entity->title = $title;
        $entity->slug = $title;
        $entity->is_complete = false;
        $entity->notes = $notes;
        $entity->disc_brand = $disc_brand;
        $entity->save();

        return redirect()->action('ArchiveController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disc = ArchDisc::find($id);
        //$releases = Release::where('recording_id', $recording->id)->get();
        $formats = Format::all();
        $releases = Release::join('archive', 'archive.release_id', '=', 'releases.id')
            ->where('archive.arch_disc_id', $id)
            ->get();

        return view('archive.show')
            ->withReleases($releases)
            ->withFormats($formats)
            ->withDisc($disc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = ArchDisc::find($id);
        return view('archive.edit')->withEntity($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entity = ArchDisc::find($id);
        $entity->title = trim($request->input('title'));
        $entity->is_complete = $request->input('is_complete') ? true : false;
        $entity->notes = trim($request->input('notes'));
        $entity->disc_brand = trim($request->input('disc_brand'));

        $entity->save();

        return redirect()->action(
            'ArchiveController@show', ['id' => $id]
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
        return json_encode(ArchDisc::destroy($id));
    }
}
