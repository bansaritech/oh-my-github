<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

// <!-- ?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Scan;

// class ScanController extends Controller
// {
//     public function scan(Request $request)
//     {
//         // Validate the request
//         $validatedData = $request->validate([
//             'username' => 'required',
//             'token' => 'required',
//         ]);

//         // Check if both fields are provided and validated
//         if (!empty($validatedData['username']) && !empty($validatedData['token'])) {
//             // Create entry in scan table
//             Scan::create([
//                 'username' => $validatedData['username'],
//                 'token' => $validatedData['token'],
                
//             ]);

//             // Increment scan job counter (example logic)
//             $scanJobCount = Scan::count(); // Adjust this as per your actual implementation

//             // Redirect back with success message
//             return redirect()->back()->with('success', 'Scan initiated successfully.');
//         } else {
//             // Redirect back with error message if validation fails
//             return redirect()->back()->withErrors('Validation failed. Please fill in required fields.');
//         }
//     }
// } -->
