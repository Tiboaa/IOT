<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateDepartmentsRequest;
use App\Models\Departments;

class DepartmentsController extends Controller
{
    public function store(CreateDepartmentsRequest $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:departments,name|min:6|max:256',
            'code' => 'required|unique:departments,code|size:4',
        ]);

        $department = Departments::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
        ]);
        
        return redirect()->route('departments')->with('success', 'Department created successfully.');
    }
}
