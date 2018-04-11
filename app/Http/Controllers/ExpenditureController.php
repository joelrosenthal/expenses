<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
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
                'data' => Expenditure::all()->toArray(),
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
                'datetime'       => 'required|date',
                'location'       => 'required',
                'amount'         => 'required|numeric',
                'subcategory_id' => 'required|exists:subcategories,id',
                'source_id'      => 'required|exists:sources,id',
                'comments'       => 'sometimes',
            ]
        );

        $expenditure = Expenditure::create($fields);

        return response(['data' => $expenditure], 201);
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
                'data' => Expenditure::find($id),
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
        $formData = $this->validate(
            request(),
            [
                'datetime'       => 'sometimes|date',
                'location'       => 'sometimes',
                'amount'         => 'sometimes|numeric',
                'subcategory_id' => 'sometimes|exists:subcategories,id',
                'source_id'      => 'sometimes|exists:sources,id',
                'comments'       => 'sometimes',
            ]
        );

        Expenditure::find($id)->update($formData);

        return response(
            [
                'data' => Expenditure::find($id),
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
        Expenditure::find($id)->delete();

        return response(
            [
                'data' => ['result' => 'success'],
            ]
        );
    }
}
