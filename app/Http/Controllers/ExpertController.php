<?php

namespace App\Http\Controllers;
use App\Models\Expert;
use Illuminate\Http\Request;

class ExpertController extends Controller
{

    public function getExpertProfile(Request $request)
{
    // Get the userId from the query parameter
    $userId = $request->query('userId');
    
    // Fetch the expert profile using the userId
    $expert = Expert::find($userId);

    if (!$expert) {
        return response()->json(['message' => 'Expert not found'], 404);
    }

    return response()->json($expert);
}
}
