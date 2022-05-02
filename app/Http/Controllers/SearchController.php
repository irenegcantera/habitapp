<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;

class SearchController extends Controller
{
    public function places(Request $request){
        $term = $request->get('term');

        //$queries = Place::where('term', $term)->get();
        return $term;
    }
}
