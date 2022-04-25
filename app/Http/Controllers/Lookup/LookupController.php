<?php

namespace App\Http\Controllers\Lookup;

use App\Models\Lookup;
use App\Models\UserLookup;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LookupController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        switch ($request->trnmode) {
            case 'fetchUserLookup':
                $data = $this->fetchUserLookup($request);
                break;
            case 'storeLookup':
                $data = $this->storeLookup($request);
                break;
            case 'updateLookup':
                $data = $this->updateLookup($request);
                break;
            case 'deleteLookup':
                $data = $this->deleteLookup($request);
                break;
            case 'fetchLookup':
                $data = $this->fetchLookup($request);
                break;
            default:
                $data = '';
                break;
        }

        if (isset($data['error'])) {
            return \response()->json($data, 400);
        }
        return \response()->json($data);
    }
    
    private function deleteLookup($request)
    {
            Lookup::find($request->id)->delete();
        return $request->all();
    }

    private function updateLookup($request)
    {
        $this->validate($request, [
            'lookup' => 'required|unique:lookup,id,'.$request->id,
            'fulltitle' => 'required|unique:lookup,id,'.$request->id, 
        ],[
            'lookup.required' => 'The branch lookup  field is required.',
            'lookup.unique' => 'The branch lookup  has already been taken.',
            'fulltitle.required' => 'The fulltitle field is required.',
            'lookup.unique' => 'The lookup  has already been taken.',
        ]);
        $lookup = Lookup::find($request->id); 
        $lookup->lookup = Str::upper($request->lookup);
        $lookup->code = Str::upper($request->code);
        $lookup->fulltitle = ($request->fulltitle);
        $lookup->fulldesc = ($request->fulldesc);
        $lookup->save();
        return $lookup;
    }
    private function storeLookup($request)
    {
    
        $this->validate($request, [
            'lookup' => 'required|unique:lookup',
            'fulltitle' => 'required|unique:lookup', 
        ],[
            'lookup.required' => 'The branch lookup  field is required.',
            'lookup.unique' => 'The branch lookup  has already been taken.',
            'fulltitle.required' => 'The fulltitle field is required.',
            'lookup.unique' => 'The lookup  has already been taken.',
        ]);
        
        $lookup = new Lookup();
        $lookup = Lookup::find($request->id); 
        $lookup->lookup = Str::upper($request->lookup);
        $lookup->code = Str::upper($request->code);
        $lookup->fulltitle = ($request->fulltitle);
        $lookup->fulldesc = ($request->fulldesc);
        $lookup->save();

        return $lookup;
    }

    private function fetchUserLookup($request)
    {

        return UserLookup::with('lookup')->get();
    }
    private function fetchLookup($request)
    {
        return Lookup::get();
    }
}
