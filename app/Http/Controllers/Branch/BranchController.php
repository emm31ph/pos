<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResources;
use App\Models\Branch;
use App\Models\Serial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        switch ($request->trnmode) {
            case 'fetchBranch':
                $data = $this->fetchBranch($request);
                break;
            case 'storeBranch':
                $data = $this->storeBranch($request);
                break;
            case 'deleteBranch':
                $data = $this->deleteBranch($request);
                break;
            case 'updateBranch':
                $data = $this->updateBranch($request);
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
    private function fetchBranch($request)
    {
        return BranchResources::collection(Branch::get());
    }
    private function updateBranch($request)
    {

        $request['branch'] = $request->lookup;
        $request['name'] = $request->fulltitle;
        $this->validate($request, [
            'branch' => 'required|unique:branch,id,' . $request->id,
            'name' => 'required|unique:branch,id,' . $request->id,
        ], [
            'branch.required' => 'The branch code field is required.',
            'branch.unique' => 'The branch code has already been taken.',
            'name.required' => 'The fulltitle field is required.',
            'branch.unique' => 'The fulltitle has already been taken.',
        ]);

        $data = '';
        $branch = Branch::find($request->id);
        $branch->branch = Str::upper($request->branch);
        $branch->name = Str::upper($request->name);
        $branch->updated_by = $request->user_id;
        if ($branch->save()) {

        }

        return BranchResources::collection(Branch::where('id', $branch->id)->get());
    }

    private function deleteBranch($request)
    {

        Branch::find($request->id)->delete();
        return BranchResources::collection(Branch::get());
    }
    private function storeBranch($request)
    {

        $request['branch'] = $request->lookup;
        $request['name'] = $request->fulltitle;

        $this->validate($request, [
            'branch' => 'required|unique:branch',
            'name' => 'required|unique:branch',
        ], [
            'branch.required' => 'The branch code field is required.',
            'branch.unique' => 'The branch code has already been taken.',
            'name.required' => 'The fulltitle field is required.',
            'branch.unique' => 'The fulltitle has already been taken.',
        ]);

        $data = '';
        $branch = new Branch();
        $branch->branch = Str::upper($request->branch);
        $branch->name = Str::upper($request->name);
        $branch->created_by = $request->user_id;
        if ($branch->save()) {
            $branchData = [Str::upper($request->branch)];

            $counter = [
                [
                    'name' => 'EMPLOYEE',
                    'prefix' => 'EMP',
                    'value' => 1,
                ],
            ];

            foreach ($branchData as $value) {
                foreach ($counter as $value1) {
                    $data = [
                        [
                            'key' => $value1['name'],
                            'branch' => $value,
                            'prefix' => $value1['prefix'] . "-" . $value . "-",
                            'value' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                    ];
                    Serial::insert($data);
                }
            }
        }

        return BranchResources::collection(Branch::where('id', $branch->id)->get());
    }

}
