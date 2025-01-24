<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('dashboard::dashboard.index', $data);
    }
}
