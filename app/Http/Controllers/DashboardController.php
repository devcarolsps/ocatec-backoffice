<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 * @author Caroline Santos <23/12/2022 12:43>
 */
class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $checkAuth = Auth::user()->is_admin;

        if(!$checkAuth) {
            return view('auth.login');
        }

        return view('painel.dashboard.index');
    }


}
