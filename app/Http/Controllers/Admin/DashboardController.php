<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FlightEnquiry;
use App\Models\GroupBooking;
use App\Models\ContactEnquiry;
use App\Models\Airpot;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        // Total counts
        $totalUsers = User::count();
        $totalFlightEnquiries = FlightEnquiry::count();
        $totalGroupBookings = GroupBooking::count();
        $totalContactEnquiries = ContactEnquiry::count();
        $totalAirports = Airpot::count();

        // Today's statistics
        $todayFlightEnquiries = FlightEnquiry::whereDate('created_at', today())->count();
        $todayGroupBookings = GroupBooking::whereDate('created_at', today())->count();
        $todayContactEnquiries = ContactEnquiry::whereDate('created_at', today())->count();

        // This week's statistics
        $weekStart = Carbon::now()->startOfWeek();
        $weekFlightEnquiries = FlightEnquiry::where('created_at', '>=', $weekStart)->count();
        $weekGroupBookings = GroupBooking::where('created_at', '>=', $weekStart)->count();
        $weekContactEnquiries = ContactEnquiry::where('created_at', '>=', $weekStart)->count();

        // This month's statistics
        $monthStart = Carbon::now()->startOfMonth();
        $monthFlightEnquiries = FlightEnquiry::where('created_at', '>=', $monthStart)->count();
        $monthGroupBookings = GroupBooking::where('created_at', '>=', $monthStart)->count();
        $monthContactEnquiries = ContactEnquiry::where('created_at', '>=', $monthStart)->count();

        // Recent activity (last 10 items)
        $recentFlightEnquiries = FlightEnquiry::latest()->take(5)->get();
        $recentGroupBookings = GroupBooking::latest()->take(5)->get();
        $recentContactEnquiries = ContactEnquiry::latest()->take(5)->get();

        // Popular routes (top 5 from flight enquiries)
        $popularRoutes = FlightEnquiry::select('from_city', 'to_city', DB::raw('count(*) as count'))
            ->groupBy('from_city', 'to_city')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Group bookings by passenger range
        $passengerRanges = GroupBooking::select('passengers', DB::raw('count(*) as count'))
            ->groupBy('passengers')
            ->orderByDesc('count')
            ->get();

        // Enquiries trend (last 7 days)
        $enquiriesTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $enquiriesTrend[] = [
                'date' => $date->format('M d'),
                'flight_enquiries' => FlightEnquiry::whereDate('created_at', $date)->count(),
                'group_bookings' => GroupBooking::whereDate('created_at', $date)->count(),
                'contact_enquiries' => ContactEnquiry::whereDate('created_at', $date)->count(),
            ];
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalFlightEnquiries',
            'totalGroupBookings',
            'totalContactEnquiries',
            'totalAirports',
            'todayFlightEnquiries',
            'todayGroupBookings',
            'todayContactEnquiries',
            'weekFlightEnquiries',
            'weekGroupBookings',
            'weekContactEnquiries',
            'monthFlightEnquiries',
            'monthGroupBookings',
            'monthContactEnquiries',
            'recentFlightEnquiries',
            'recentGroupBookings',
            'recentContactEnquiries',
            'popularRoutes',
            'passengerRanges',
            'enquiriesTrend'
        ));
    }
}
