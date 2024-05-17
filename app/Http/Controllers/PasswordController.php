<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    // go to page
    public function index()
    {
        return view('password');
    }

    public function generate(Request $request)
    {
        // Validate the input
        $request->validate([
            'passwordLength' => 'required|integer|min:1',
        ]);
    
        $length = $request->input('passwordLength');
        $includeUppercase = $request->has('uppercase');
        $includeLowercase = $request->has('lowercase');
        $includeNumbers = $request->has('numbers');
        $includeSymbols = $request->has('symbols');
    
        // Character pools
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!#$%&,*+@^';
    
        // Build the pool of characters to use
        $characters = '';
        if ($includeUppercase) {
            $characters .= $uppercase;
        }
        if ($includeLowercase) {
            $characters .= $lowercase;
        }
        if ($includeNumbers) {
            $characters .= $numbers;
        }
        if ($includeSymbols) {
            $characters .= $symbols;
        }
    
        // Ensure there is at least one type of character selected
        if (empty($characters)) {
            return response()->json(['errors' => ['character_type' => ['You must select at least one character type.']]], 422);
        }
    
        // Generate the password
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
    
        // Return the generated password
        return response()->json(['password' => $password]);
    }
    
}
