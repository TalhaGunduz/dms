<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\PaymentItem;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['student', 'paymentType', 'paymentItem'])->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $paymentTypes = PaymentType::all();
        $paymentItems = PaymentItem::all();
        $students = Student::all();
        return view('admin.payments.create', compact('paymentTypes', 'paymentItems', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'payment_item_id' => 'required|exists:payment_items,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:255',
        ]);

        Payment::create($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $paymentTypes = PaymentType::all();
        $paymentItems = PaymentItem::all();
        $students = Student::all();
        return view('admin.payments.edit', compact('payment', 'paymentTypes', 'paymentItems', 'students'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'payment_item_id' => 'required|exists:payment_items,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:255',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
} 