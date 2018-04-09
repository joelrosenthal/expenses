<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
                'data' => Category::all()->toArray(),
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

        $category = Category::create($fields);

        return response(['data' => $category], 201);
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
                'data' => Category::find($id),
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

        Category::find($id)->update(
            [
                'name' => request()->name,
            ]
        );

        return response(
            [
                'data' => Category::find($id),
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
        Category::find($id)->delete();
        return response(
            [
            'data' => ['result' => 'success'],
            ]
        );
    }
}
