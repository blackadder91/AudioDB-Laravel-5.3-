<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCountryRequest;
use App\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('title', 'ASC')
            ->get();

        return view('countries.index')
            ->withCountries($countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $title = trim($request->input('title'));
        $title_short = trim($request->input('title_short'));
        $slug = str_slug($title_short);

        if (Country::where('slug', $slug)->get()->count() > 0)
            return redirect()
                ->back()
                ->withErrors(array('Country already exists'))
                ->withInput();

        $country = new Country;
        $country->title = $title;
        $country->title_short = $title_short;
        $country->slug = $slug;
        $country->save();

        return redirect()->action('CountryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->action('CountryController@edit', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('countries.edit')->withCountry($country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCountryRequest $request, $id)
    {
        $country = Country::find($id);
        $country->title = trim($request->input('title'));
        $country->title_short = trim($request->input('title_short'));
        $country->slug = str_slug($country->title_short);
        $country->save();

        return redirect()->action('CountryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Country::destroy($id);
    }
}
