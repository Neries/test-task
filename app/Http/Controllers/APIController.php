<?php

namespace App\Http\Controllers;

use App\Employee;

class APIController extends Controller
{
    public function getEmployees()
    {
        $query = Employee::select('id', 'last_name', 'first_name', 'patronymic', 'position', 'employment_date', 'salary');
        return datatables($query)->make(true);

    }
}