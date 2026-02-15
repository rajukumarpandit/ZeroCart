<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
class DashboardController extends Controller
{
    //
    public function dashboard(){
        $activities=Activity::with('causer')->latest()->paginate(20);
        return view('Backend.dashboard.dashboard', compact('activities'));
    }
}