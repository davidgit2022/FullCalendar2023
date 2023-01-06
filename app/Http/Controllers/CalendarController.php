<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();
        $bookings = Booking::all();
        foreach($bookings as $booking) {
            $color = null;
            if($booking->title == 'Test') {
                $color = '#924ACE';
            }
            if($booking->title == 'Test 1') {
                $color = '#68B01A';
            }

            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color
            ];
        }
        return view('calendar.index', ['events' => $events]);
    }
}
