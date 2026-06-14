<?php

namespace App\Http\Controllers\Web;

use App\Models\Expertise;
use App\Models\User;

class DashboardController
{
    public function index()
    {
        // Fetch statistics for the dashboard
        $stats = [
            'total_users'     => User::count(),
            'total_expertise' => Expertise::count(),
            'total_suspended' => User::where('status', 'suspended')->count(),
        ];

        // Fetch recent users for a quick overview table
        $userInfo = User::latest()->take(5)->get();

        return view('backend.layouts.dashboard.index', compact('stats', 'userInfo'));
    }
}
