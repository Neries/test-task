<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{

    /**
     * Display a listing of the employees.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeesList()
    {
        return view('employees');
    }


    /**
     *TODO: write comment
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getEmployees()
    {
        $query = Employee::select('id', 'last_name', 'first_name', 'patronymic', 'position', 'employment_date', 'salary');
        return datatables($query)->make(true);
    }

    /**
     *
     * Display a tree of the employees.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tree()
    {
//        $employees = Employee::all();
        $employees = Employee::limit(10)->get();
        $tree = $this->buildTree($employees);
        return view('tree', ['employees' => $tree]);

    }


    /**
     * creates a multi-dimensional array
     * with parent-children
     *
     * @param Collection $elements
     * @param int $parentId
     * @return array
     */
    private function buildTree($elements, $parentId = 0)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['chief_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);

                if ($children) {
                    $element['children'] = $children;
                }

                $branch[] = $element;
            }
        }

        return $branch;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = Employee::find($id);
        return view('edit', ['employee' => $worker]);
    }

    /**
     * Update or remove specified resource in storage
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateOrDelete(Request $request, $id)
    {
        if ($request->save){
            Employee::findOrFail($id)->update(
                ['last_name' => $request->last_name,
                 'first_name' => $request->first_name,
                 'patronymic' => $request->patronymic,
                 'position' => $request->position,
                 'employment_date' => $request->employment_date,
                 'salary' => $request->salary,
                 'chief_id' => $request->chief_id,
                    ]
                );
        }
        elseif ($request->delete){
            Employee::findOrFail($id)->delete();
        }
        return view('employees');
    }

    //    public function getChild()
//    {
//        $childs = Employee::where('chief_id', $_POST['id'])->select
//        (
//            'id',
//            'last_name',
//            'first_name',
//            'patronymic',
//            'position'
//        )->get()->toArray();
//        return response()->json($childs);
//
//    }
}
