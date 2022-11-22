<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() : View
    {
        $department = Department::all();

        return view('pages.department-list', compact('department'));
    }

    public function create() : View
    {
        return view('pages.department-form', [
            'action' => route('departments.store'),
        ]);
    }

    public function store(DepartmentRequest $request) : RedirectResponse
    {
        Department::create(
            $request->validated(),
        );

        return back()->with('status', 'Department has benn added successfully');
    }

    public function edit(Department $department) : View
    {
        $action = route('departments.update', ['department' => $department->id]);

        return view('pages.department-form', compact('department','action'));
    }

    public function update(DepartmentRequest $request, Department $department) : RedirectResponse
    {
        $department->update(
            $request->validated(),
        );

        return back()->with('status', 'Department has benn updated successfully');
    }

    public function destroy(Department $department) : RedirectResponse
    {
        $department->delete();

        return back()->with('status', 'Department has benn deleted successfully');
    }
}
