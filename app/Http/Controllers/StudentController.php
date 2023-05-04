<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        
        if ($students->count() > 0) {
            return response()->json([
                'data' => $students,
                'status' => 200,
                'message' => 'Data Students ditampilkan',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Students tidak ada',
            ], 404);
        }
        
    }

    public function store(Request $request)
    {
       $validator =  Validator::make($request->all(),[
        'name' => 'required',
        'umur' => 'required',
        'description' => 'required',
       ]);

       if ($validator->fails()) {
           return response()->json([
               'status' => 422,
               'errors' => $validator->messages(),
           ], 422);
       } 
       else {
              $student = Student::create([
                'name' => $request->name,
                'umur' => $request->umur,
                'description' => $request->description,
              ]);
    
              if ($student) {
                return response()->json([
                     'status' => 200,
                     'data' => $student,
                     'message' => 'Data Students ditambahkan',
                ], 200);
              } else {
                return response()->json([
                     'status' => 500,
                     'message' => 'Data Students gagal ditambahkan',
                ], 500);
              }
       }
    }

    public function show($id)
    {
        $student = Student::find($id);
        
        if ($student) {
            return response()->json([
                'status' => 200,
                'data' => $student,
                'message' => 'Data Students ditampilkan',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Students tidak ada',
            ], 404);
        }
    }

    // public function edit($id)
    // {
    //     $student = Student::find($id);
        
    //     if ($student) {
    //         return response()->json([
    //             'status' => 200,
    //             'data' => $student,
    //             'message' => 'Data Students ditampilkan',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status' => 404,
    //             'message' => 'Data Students tidak ada',
    //         ], 404);
    //     }
    // }

    public function update(Request $request , int $id)
    {
        $student = Student::find($id);
        
        if ($student) {
            $validator =  Validator::make($request->all(),[
                'name' => 'required',
                'description' => 'required',
                'umur' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(), 
                ], 422);
            } 
            else {
                $student = Student::find($id);
                if ($student) {
                    $student->update([
                        'name' => $request->name,
                        'umur' => $request->umur,
                        'description' => $request->description,
                      ]);
                    return response()->json([
                        'status' => 200,
                        'data' => $student,
                        'message' => 'Data Students diupdate',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Data Students gagal diupdate',
                    ], 500);
                }
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Students tidak ada',
            ], 404);
        }
    }
}
