<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\PaymentItem;
use App\Models\Student;
use App\Models\Staff;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['paymentType', 'paymentItem', 'payer', 'receipt'])->latest()->get();
        
        // Bu ayki onaylanmış ödemelerin toplam tutarı
        $currentMonthApprovedTotal = Payment::where('status', 'approved')
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('amount');
            
        // Bekleyen ödemelerin sayısı
        $pendingPaymentsCount = Payment::where('status', 'pending')->count();
        
        return view('admin.payment.index', compact('payments', 'currentMonthApprovedTotal', 'pendingPaymentsCount'));
    }

    public function create()
    {
        $paymentTypes = PaymentType::all();
        $paymentItems = PaymentItem::all();
        $students = Student::all();
        return view('admin.payment.create', compact('paymentTypes', 'paymentItems', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_type_id' => 'required|exists:payment_types,id',
            'payment_item_id' => 'required|exists:payment_items,id',
            'payer_type' => 'required|in:App\\Models\\Student,App\\Models\\Staff',
            'payer_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
            'receipt_number' => 'required|string',
            'receipt_image' => 'nullable|image|max:2048'
        ]);

        $payment = Payment::create([
            'payment_type_id' => $validated['payment_type_id'],
            'payment_item_id' => $validated['payment_item_id'],
            'payer_id' => $validated['payer_id'],
            'payer_type' => $validated['payer_type'],
            'amount' => $validated['amount'],
            'payment_date' => $validated['payment_date'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null
        ]);

        $path = null;
        if ($request->hasFile('receipt_image')) {
            $path = $request->file('receipt_image')->store('receipts', 'public');
        }

        $payment->receipt()->create([
            'receipt_number' => $validated['receipt_number'],
            'receipt_image' => $path,
            'receipt_date' => $validated['payment_date'],
            'verified_by' => auth()->id(),
            'verification_date' => now()
        ]);

        return redirect()->route('admin.payment.index')->with('success', 'Ödeme başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $paymentTypes = PaymentType::all();
        $paymentItems = PaymentItem::all();
        return view('admin.payment.edit', compact('payment', 'paymentTypes', 'paymentItems'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'payment_type_id' => 'required|exists:payment_types,id',
            'payment_item_id' => 'required|exists:payment_items,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:payment_date',
            'status' => 'required|in:pending,approved,cancelled',
            'notes' => 'nullable|string',
        ]);

        try {
            $payment->update($validated);

            return redirect()
                ->route('admin.payment.index')
                ->with('success', 'Ödeme başarıyla güncellendi.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ödeme güncellenirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()
            ->route('admin.payment.index')
            ->with('success', 'Ödeme başarıyla silindi.');
    }

    public function getPayers(Request $request)
    {
        $type = $request->input('type');
        $search = $request->input('search');

        if ($type === 'App\Models\Student') {
            $payers = Student::when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('surname', 'like', "%{$search}%")
                      ->orWhere('tc_no', 'like', "%{$search}%");
                });
            })
            ->select('id', 'name', 'surname', 'tc_no')
            ->get()
            ->map(function($student) {
                return [
                    'id' => $student->id,
                    'text' => $student->name . ' ' . $student->surname . ' (' . $student->tc_no . ')'
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