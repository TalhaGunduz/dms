<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalApprovedPayments = Payment::where('status', 'approved')->sum('amount');
        $pendingPaymentsCount = Payment::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalApprovedPayments', 'pendingPaymentsCount'));
    }
} 