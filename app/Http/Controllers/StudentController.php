<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
            ]);

            Student::create($validated);

            return redirect()->route('dashboard')->with('success', 'Student has been added successfully');
        }


        public function destroy(Student $student)
        {
            $student->delete();
        
            return redirect()->route('dashboard')->with('deleted', 'Student deleted successfully');
        }

        public function edit(Student $student)
        {
            return view('edit-student', compact('student'));
        }

        public function update(Request $request, Student $student)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,'. $student->id,
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
            ]);

            $student->update($validated);


            return redirect()->route('dashboard')->with('success', 'Student Updated Successfully');
        }
}
