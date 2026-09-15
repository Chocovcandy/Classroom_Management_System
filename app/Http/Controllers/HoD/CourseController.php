<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses belonging to the HOD's department.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        $courses = Course::where('department_id', $department->id)
            ->with('department')
            ->latest()
            ->paginate(10);

        return view('hod.courses.index', compact(
            'courses',
            'department'
        ));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        return view('hod.courses.create', compact(
            'department'
        ));
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:50',
                'distinct',
                'unique:courses,course_code',
            ],

            'course_name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'credits' => [
                'nullable',
                'integer',
                'min:0',
                'max:20',
            ],
        ]);

        Course::create([
            'course_code' => $validated['course_code'],
            'course_name' => $validated['course_name'],
            'department_id' => $department->id,
            'description' => $validated['description'],
            'credits' => $validated['credits'] ?? null,
        ]);

        return redirect()
            ->route('hod.courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        /*
         * Prevent an HOD from editing a course
         * that belongs to another department.
         */
        if ((int) $course->department_id !== (int) $department->id) {
            abort(403, 'You are not allowed to edit this course.');
        }

        return view('hod.courses.edit', compact(
            'course',
            'department'
        ));
    }

    /**
     * Update the specified course.
     */
    public function update(Request $request, Course $course)
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        /*
         * Prevent an HOD from updating a course
         * belonging to another department.
         */
        if ((int) $course->department_id !== (int) $department->id) {
            abort(403, 'You are not allowed to update this course.');
        }

        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('courses', 'course_code')
                    ->ignore($course->id),
            ],

            'course_name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'credits' => [
                'nullable',
                'integer',
                'min:0',
                'max:20',
            ],
        ]);

        $course->update([
            'course_code' => $validated['course_code'],
            'course_name' => $validated['course_name'],
            'description' => $validated['description'],
            'credits' => $validated['credits'] ?? null,
        ]);

        return redirect()
            ->route('hod.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course.
     */
    public function destroy(Course $course)
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        /*
         * Prevent an HOD from deleting a course
         * belonging to another department.
         */
        if ((int) $course->department_id !== (int) $department->id) {
            abort(403, 'You are not allowed to delete this course.');
        }

        $course->delete();

        return redirect()
            ->route('hod.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
