<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index() : View
    {
        return view('pages.course-list', [
            'courses' => Course::with('department')->paginate(10),
        ]);
    }

    public function create() : View
    {
        return view('pages.course-form', [
            'action' => route('courses.store'),
        ]);  
    }

    public function store(CourseRequest $request) : RedirectResponse
    {
        Course::create(
            $request->validated(),
        );

        return back()->with('status', 'New course has been added.');
    }

    public function edit(Course $course) : View
    {
        $action = route('courses.update', ['course' => $course->id]);
        
        return view('pages.course-form', compact('action','course'));
    }

    public function update(CourseRequest $request, Course $course) : RedirectResponse
    {
        $course->update(
            $request->validated(),
        );

        return back()->with('status', 'Course updated sucessfully');
    }

    public function destroy(Course $course) : RedirectResponse
    {
        $course->delete();

        return back()->with('status', 'Course has been deleted.');
    }
}
