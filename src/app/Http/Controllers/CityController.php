<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $cities = City::with('state.country')->paginate(5);

        return \App\Http\Resources\City::collection($cities)->response();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $city = City::create($request->all());

        return \App\Http\Resources\City::make($city)->response();
    }
}
