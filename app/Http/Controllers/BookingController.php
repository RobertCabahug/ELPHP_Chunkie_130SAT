<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getExpertBookings($userId)
{
    // Logic to fetch completed bookings for the given expert
    $bookings = Booking::where('expert_id', $userId)->where('status', 'completed')->get();
    return response()->json($bookings);
}

public function getOngoingBookings($userId)
{
    // Logic to fetch ongoing bookings for the given expert
    $bookings = Booking::where('expert_id', $userId)->where('status', 'ongoing')->get();
    return response()->json($bookings);
}
    // Method to create a new booking
    public function createBooking(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'expert_id' => 'required|exists:users,id',
            'expert_name' => 'required|string',
            'user_name' => 'required|string',
            'status' => 'nullable|string',
            'timestamp' => 'nullable|date',
            'note' => 'nullable|string',
            'rate' => 'nullable|string',
            'expert_address' => 'required|string',
            'expert_image_url' => 'nullable|string',
            'user_address' => 'required|string',
        ]);

        $booking = Booking::create([
            'user_id' => $validated['user_id'],
            'expert_id' => $validated['expert_id'],
            'expert_name' => $validated['expert_name'],
            'user_name' => $validated['user_name'],
            'status' => $validated['status'] ?? 'Pending',  // Default to "Pending"
            'timestamp' => $validated['timestamp'] ?? now(),
            'note' => $validated['note'],
            'rate' => $validated['rate'],
            'expert_address' => $validated['expert_address'],
            'expert_image_url' => $validated['expert_image_url'],
            'user_address' => $validated['user_address'],
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'data' => $booking,
        ], 201);
    }

    // Method to update the booking status (e.g., to "Accepted" or "Completed")
    public function updateBookingStatus($id, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Accepted,Completed',
        ]);

        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->status = $validated['status'];
        $booking->save();

        return response()->json([
            'message' => 'Booking status updated successfully',
            'data' => $booking,
        ]);
    }
}
