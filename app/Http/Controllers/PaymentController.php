<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\PaymentItem;
use App\Models\Student;
use App\Models\Staff;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['paymentType', 'paymentItem', 'payer', 'receipt'])->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $paymentTypes = PaymentType::all();
        $paymentItems = PaymentItem::all();
        return view('admin.payments.create', compact('paymentTypes', 'paymentItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_type_id' => 'required|exists:payment_types,id',
            'payment_item_id' => 'required|exists:payment_items,id',
            'payer_type' => 'required|in:App\Models\Student,App\Models\Staff',
            'payer_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:payment_date',
            'status' => 'required|in:pending,approved,cancelled',
            'notes' => 'nullable|string',
            'receipt_number' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'receipt_date' => 'required|date',
            'receipt_image' => 'nullable|image|max:2048'
        ]);

        $payment = Payment::create([
            'payment_type_id' => $validated['payment_type_id'],
            'payment_item_id' => $validated['payment_item_id'],
            'payer_id' => $validated['payer_id'],
            'payer_type' => $validated['payer_type'],
            'amount' => $validated['amount'],
            'payment_date' => $validated['payment_date'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
            'notes' => $validated['notes']
        ]);

        if ($request->hasFile('receipt_image')) {
            $path = $request->file('receipt_image')->store('receipts', 'public');
        }

        $payment->receipt()->create([
            'receipt_number' => $validated['receipt_number'],
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'],
            'receipt_date' => $validated['receipt_date'],
            'receipt_image' => $path ?? null,
            'verified_by' => auth()->id(),
            'verification_date' => now()
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Ödeme başarıyla oluşturuldu.');
    }

    public function getPayers(Request $request)
    {
        $type = $request->input('type');
        $search = $request->input('search');

        if ($type === 'App\\Models\\Student') {
            $payers = Student::when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('student_number', 'like', "%{$search}%");
                });
            })
            ->select('id', 'first_name', 'last_name', 'student_number')
            ->get()
            ->map(function($student) {
                return [
                    'id' => $student->id,
                    'text' => $student->first_name . ' ' . $student->last_name . ' (' . $student->student_number . ')'
                ];
            });
        } else {
            $payers = Staff::when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('staff_number', 'like', "%{$search}%");
                });
            })
            ->select('id', 'first_name', 'last_name', 'staff_number')
            ->get()
            ->map(function($staff) {
                return [
                    'id' => $staff->id,
                    'text' => $staff->first_name . ' ' . $staff->last_name . ' (' . $staff->staff_number . ')'
                ];
            });
        }

        return response()->json($payers);
    }
} 