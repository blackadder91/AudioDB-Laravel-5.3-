<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLabelRequest;
use App\Label;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::orderBy('title', 'ASC')
            ->get();

        return view('labels.index')
            ->withLabels($labels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabelRequest $request)
    {
        $title = trim($request->input('title'));
        $title_short = trim($request->input('title_short'));
        $slug = str_slug($title_short);

        if (Label::where('slug', $slug)->get()->count() > 0)
            return redirect()
                ->back()
                ->withErrors(array('Label already exists'))
                ->withInput();

        $label = new Label;
        $label->title = $title;
        $label->title_short = $title_short;
        $label->slug = $slug;
        $label->save();

        return redirect()->action('LabelController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->action('LabelController@edit', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $label = Label::find($id);
        return view('labels.edit')->withLabel($label);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLabelRequest $request, $id)
    {
        $label = Label::find($id);
        $label->title = trim($request->input('title'));
        $label->title_short = trim($request->input('title_short'));
        $label->slug = str_slug($label->title_short);
        $label->save();

        return redirect()->action('LabelController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Label::destroy($id);
    }
}
