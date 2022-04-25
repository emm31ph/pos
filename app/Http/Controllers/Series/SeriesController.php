<?php

namespace App\Http\Controllers\Series;

use App\Models\Serial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    
    public function index(Request $request)
    {
        $data = Serial::where('branch',$request->branch)->where('key',$request->key)->first();
        return $data->prefix . sprintf('%011d', $data->value);;
        
    }
}
