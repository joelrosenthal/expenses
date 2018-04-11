<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            [
                'data' => Source::all()->toArray(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $fields = $this->validate(
            request(),
            [
                'name' => 'required',
            ]
        );

        $Source = Source::create($fields);

        return response(['data' => $Source], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(
            [
                'data' => Source::find($id),
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(
            request(),
            [
                'name' => 'required',
            ]
        );

        Source::find($id)->update(
            [
                'name' => request()->name,
            ]
        );

        return response(
            [
                'data' => Source::find($id),
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Source::find($id)->delete();
        return response(
            [
                'data' => ['result' => 'success'],
            ]
        );
    }
}
