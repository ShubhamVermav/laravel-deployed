<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function addStudent(Request $request){
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->password = bcrypt($request->password);

        if($student->save()){
            return ["result" => "student added successfully"];
        } else {
            return ["result" => "operation failed"];
        }
    }

    public function updateStudent(Request $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->password = bcrypt($request->password);

        if($student->save()){
            return ["result" => "student Updated"];
        } else {
            return ["result" => "student not Updated"];
        }
    } 

    public function deleteStudent($id)
    {
       $student = Student::destroy($id);
        if($student){
            return ["result" => "student record deleted"];
        } else {
            return ["result" => "student not deleted"];
        }
    }

    // public function login(){

    // }
    public function searchStudent($name)
    {
        $student = Student::where('name', 'like', "%{$name}%")->get();

        if ($student->count() > 0) {
            return ["result" => $student];
        } else {
            return ["result" => "student not found"];
        }
    }

}
