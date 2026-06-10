<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Models\Comment;
use App\Models\ExperienceRoom;
use App\Models\JobResponsibity;
use App\Models\ProfessionalInformation;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
         return view('backend.layouts.dashboard.index');
    }
}
