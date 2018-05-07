<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Prepares and returns
     * array for treeview
     *
     * @return array
     */
    public function tree()
    {
        $rows = Employee::all()->toArray();
        foreach ($rows as $row) {
            $sub_data["id"] = $row["id"];
            $sub_data["text"] = '<kbd>ФИО</kbd>' .
                ' ' . $row["last_name"] . ' ' . $row["first_name"] . ' ' . $row['patronymic'] .
                ' ' . '<kbd>должность</kbd><nobr class="text-primary">' .
                ' ' . $row['position'] . '</nobr>';
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

        return $data;
    }

    /**
     * Return data for datatable
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getEmployees()
    {
        $query = Employee::select('id', 'avatar', 'last_name', 'first_name', 'patronymic', 'position', 'employment_date', 'salary');

        return datatables($query)->make(true);
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

        $this->validate($request, [
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $avatar = (Employee::find($id)->avatar ?? '');

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
     * TODO : to forbid to delete first chief
     * Remove employee
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
     * TODO: to forbid to make himself chief
     *
     * Prepares and returns data for
     * chief field on edit page
     * (select2)
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
     * Returns chief name and position
     * like Петров В.И.(Детектив)
     *
     * @param $data
     * @return string
     */
    private function prepareDropdownName($data)
    {
        return "$data[last_name] " .
            mb_substr($data['first_name'], 0, 1) . "." . mb_substr($data['patronymic'], 0, 1) .
            ".($data[position])";
    }

    /**
     * Redistribute employees after delete chief
     *
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
}

