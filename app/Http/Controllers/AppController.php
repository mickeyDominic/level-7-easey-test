<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function viewAddPage()
    {
        return view('app.add');
    }

    public function addRecord(Request $request)
    {
        $data = [
            'first_name' => $request->post('first_name'),
            'last_name' => $request->post('last_name'),
            'date_of_birth' => $request->post('date_of_birth'),
            'province' => $request->post('province'),
            'gender' => $request->post('gender'),
            'admin' => $request->post('admin')
        ];

        if (AppUser::create($data)) {
            $error = "false";
            $errorMessage = "User created successfully";
        } else {
            $error = "true";
            $errorMessage = "An error occurred creating User";
        }
        $result = ["error" => $error, "message" => $errorMessage];

        return json_encode($result);
    }
}