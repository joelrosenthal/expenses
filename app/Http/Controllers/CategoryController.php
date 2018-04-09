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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
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
}
