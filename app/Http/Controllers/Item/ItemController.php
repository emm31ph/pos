<?php

namespace App\Http\Controllers\Item;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        switch ($request->trnmode) {
            case 'fetchItem':
                $data = $this->fetchItem($request);
                break;
            case 'deleteItem':
                $data = $this->deleteItem($request);
                break;
            default:
                # code...
                break;
        }


        if (isset($data['error'])) {
            return \response()->json($data, 400);
        }
        return \response()->json($data);
    }

    private function deleteItem($request)
    {
        return Item::where('itemcode', $request->itemcode)->update(['status' => '999']);
    }
    public function fetchItem($request)
    {
        return Item::get();
    }
}
