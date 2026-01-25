<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\Signature;
use App\Models\RevenueType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;

class RevenuePDFController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $revenueTypes = RevenueType::orderBy('name')->get();
        $revenues = $this->revenueQuery($request)->get();
        $grandTotal = (int) $revenues->sum('amount');

        $selectedType = null;
        if ($request->filled('revenue_type_id')) {
            $selectedType = $revenueTypes->firstWhere('id', (int) $request->revenue_type_id);
        }

        $selectedPaymentMethod = $request->filled('payment_method') ? $request->payment_method : null;

        $paymentMethodLabels = [
            'online' => 'Online',
            'cash' => 'Cash',
            '' => 'All Methods'
        ];
        $paymentMethodLabel = $paymentMethodLabels[$selectedPaymentMethod] ?? 'All Methods';

        $beneficiaryLabels = [
            'pastor' => 'Pastor',
            'general' => 'General',
        ];

        $dateFromLabel = $request->filled('date_from')
            ? Carbon::parse($request->date_from)->format('F j, Y')
            : 'N/A';

        $dateToLabel = $request->filled('date_to')
            ? Carbon::parse($request->date_to)->format('F j, Y')
            : 'N/A';

        $generatedAt = Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y, g:i a');

        $signatures = Signature::with('position')
            ->where('is_active', true)
            ->get();

        $data = [
            'revenues' => $revenues,
            'grandTotal' => $grandTotal,
            'selectedType' => $selectedType,
            'selectedPaymentMethod' => $selectedPaymentMethod,
            'paymentMethodLabel' => $paymentMethodLabel,
            'beneficiaryLabels' => $beneficiaryLabels,
            'dateFromLabel' => $dateFromLabel,
            'dateToLabel' => $dateToLabel,
            'generatedAt' => $generatedAt,
            'signatures' => $signatures,
        ];

        $pdf = DomPdf::loadView('staff.pdf.revenues.index', $data)->setPaper('a4', 'portrait');

        $filename = 'revenue-reports_' . Carbon::now()->format('Y-m-d_His') . '.pdf';

        return $request->boolean('download')
            ? $pdf->download($filename)
            : $pdf->stream($filename);
    }

    private function revenueQuery(Request $request)
    {
        $query = Revenue::query()
            ->with(['revenueType', 'revenueCollection'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $from = $request->date_from;
            $to = $request->date_to;

            $query->whereHas('revenueCollection', function ($q) use ($from, $to) {
                $q->whereDate('collection_date', [$from, $to]);
            });
        } elseif ($request->filled('date_from')) {
            $query->whereHas('revenueCollection', function ($q) use ($request) {
                $q->whereDate('collection_date', '>=', $request->date_from);
            });
        } elseif ($request->filled('date_to')) {
            $query->whereHas('revenueCollection', function ($q) use ($request) {
                $q->whereDate('collection_date', '<=', $request->date_to);
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('revenue_type_id')) {
            $query->where('revenue_type_id', $request->revenue_type_id);
        }

        return $query;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revenue $revenue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        //
    }
}
