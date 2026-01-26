<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    public function index()
    {
        $authUser = Auth::user();
        $statistics = [
            'Total Client' => 1,
            'Total Revenue' => 2,
            'Total Quots' => 3,
        ];

        $graf_statistics  = [
            'Total Client' => 1,
            'Total Revenue' => 2,
            'Total Quots' => 3,
        ];

        return view('admin.dashboard.index', compact('statistics', 'graf_statistics'));
    }
}
