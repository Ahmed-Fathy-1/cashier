<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin\ContactUs;
use App\Models\SuperAdmin\FeedBack;
use App\Models\SuperAdmin\User;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count(); // Get user count
        $domainsCount = Tenant::count();
        $feedbackCount = FeedBack::count();
        $contactusCount = ContactUs::count();
        // Get the user count for the next 6 months
        $userCounts = [];
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('F Y'); // Format the month for display
            $userCounts[] = User::whereYear('created_at', $month->year)
                                ->whereMonth('created_at', $month->month)
                                ->count();
        }
        return view('home', compact('userCounts', 'months','userCount','domainsCount','feedbackCount','contactusCount')); // Pass it to the view
    }
}
