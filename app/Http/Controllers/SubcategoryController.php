<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
                'data' => Subcategory::all()->toArray(),
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
                'category_id' => 'required|exists:categories,id',
            ]
        );

        $subcategory = Subcategory::create($fields);

        return response(['data' => $subcategory], 201);
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
                'data' => Subcategory::find($id),
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
        $fields = $this->validate(
            request(),
            [
                'name' => 'sometimes',
                'category_id' => 'sometimes|exists:categories,id',
            ]
        );

        Subcategory::find($id)->update(
            $fields
        );

        return response(
            [
                'data' => Subcategory::find($id),
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
        Subcategory::find($id)->delete();
        return response(
            [
            'data' => ['result' => 'success'],
            ]
        );
    }
}
