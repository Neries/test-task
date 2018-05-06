<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller
{

    /**
     *TODO: write comment
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getEmployees()
    {
        $query = Employee::select('id', 'avatar', 'last_name', 'first_name', 'patronymic', 'position', 'employment_date', 'salary');
        return datatables($query)->make(true);
    }

    /**
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
     * TODO: validate
     * Update or Creating a new employee
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createOrUpdate(Request $request, $id = null)
    {

//        $this->validate($request, [
//            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
//        ]);

        $avatar = '';

        if ($request->file('avatar')) {
            if ($id) @unlink(public_path(Employee::find($id)->avatar));
            $file = $request->file('avatar');
            $name = rand(1000, 999999) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/img/avatars/', $name);
            $avatar = '/storage/img/avatars/' . $name;
        };

        Employee::updateOrCreate(['id' => $id], [
            "last_name" => $request->last_name,
            "first_name" => $request->first_name,
            "patronymic" => $request->patronymic,
            "position" => $request->position,
            "employment_date" => $request->employment_date,
            "salary" => $request->salary,
            "chief_id" => $request->chief_id,
            "avatar" => $avatar
        ]);

        return redirect('employees');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        $worker = Employee::find($id);
        $data = ['employee' => $worker];
        if ($chief = Employee::find($worker->chief_id)) {
            $data['chief'] = ['text' => $this->prepareDropdownName($chief), 'id' => $chief->id];
        }

        return view('edit', $data);
    }


    /**
     * Remove specified resource in storage
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $this->redistributeChildren($employee);
        $employee->delete();

        return redirect('employees');
    }

    /**
     * @param Employee $employee
     */
    private function redistributeChildren(Employee $employee)
    {
        $children = $employee->children();
        $randomChiefs = Employee::inRandomOrder()->take($children->count())->get();
        $children->each(function ($child, $key) use ($randomChiefs) {
            $child->update(['chief_id' => $randomChiefs[$key]->id]);
        });
    }


    /**
     * TODO: chief himself
     *
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $queryString = $request->get('q');
        $employees = Employee::where('first_name', 'LIKE', "%$queryString%")
            ->orWhere('last_name', 'LIKE', "%$queryString%")
            ->orWhere('patronymic', 'LIKE', "%$queryString%")
            ->orWhere('position', 'LIKE', "%$queryString%")
            ->get(['id', 'first_name', 'last_name', 'patronymic', 'position']);

        foreach ($employees as $employee) {
            $resultData[] = [
                'id' => $employee['id'],
                'text' => $this->prepareDropdownName($employee),
            ];
        }

        return ['results' => $resultData ?? []];
    }

    /**
     * @param $data
     * @return string
     */
    private function prepareDropdownName($data)
    {
        return "$data[last_name] " .
            mb_substr($data['first_name'], 0, 1) . "." . mb_substr($data['patronymic'], 0, 1) .
            ", $data[position]";
    }


    public function test()
    {
//        $employees = Employee::all();
//        $tree = $this->buildTree($employees);
//        die("<pre>".print_r($tree,true)."</pre>");
//        return json_encode($tree);

        $rows = Employee::all()->toArray();
        foreach ($rows as $row) {
            $sub_data["id"] = $row["id"];
//            $sub_data["text"] = '<kbd>ФИО</kbd>' .
//                ' ' . $row["last_name"] . ' ' . $row["first_name"] . ' ' . $row['patronymic'] .
//                ' ' . '<kbd>должность</kbd><nobr class="text-primary">' .
//                ' ' . $row['position'] . '</nobr>';
            $sub_data["text"] = $row['first_name'];
            $sub_data["parent_id"] = $row["chief_id"];
            $data[] = $sub_data;
        }
        foreach ($data as $key => &$value) {
            $output[$value["id"]] = &$value;
        }
        foreach ($data as $key => &$value) {
            if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
                $output[$value["parent_id"]]["nodes"][] = &$value;
            }
        }
        foreach ($data as $key => &$value) {
            if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
                unset($data[$key]);
            }
        }

dd($data);
        return $data;
    }

}
