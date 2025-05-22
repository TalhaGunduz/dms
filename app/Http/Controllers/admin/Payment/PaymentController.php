<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['student', 'payer'])->latest()->get();
        $totalApprovedPayments = Payment::where('status', 'approved')->sum('amount');
        $pendingPaymentsCount = Payment::where('status', 'pending')->count();

        return view('admin.payment.index', compact('payments', 'totalApprovedPayments', 'pendingPaymentsCount'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.payment.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
            'description' => 'nullable|string'
        ]);

        Payment::create($validated);

        return redirect()->route('admin.payment.index')
            ->with('success', 'Ödeme başarıyla oluşturuldu.');
    }

    public function edit(Payment $payment)
    {
        $students = Student::all();
        return view('admin.payment.edit', compact('payment', 'students'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
            'description' => 'nullable|string'
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payment.index')
            ->with('success', 'Ödeme başarıyla güncellendi.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payment.index')
            ->with('success', 'Ödeme başarıyla silindi.');
    }
} 