<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\RevenueCashCount;
use App\Models\RevenueCollection;
use App\Models\Revenue_collection;

use Illuminate\Support\Facades\DB;

use function Pest\Laravel\delete;
use function Symfony\Component\Clock\now;

class RevenueController extends Controller
{

    public function index()
    {
        $revenues = Revenue::with(['revenueCollection'])->orderBy('id')->paginate(10);
        return view('staff.revenue.index', compact('revenues'));
    }

    public function create()
    {
        return view('staff.revenue.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([


            'revenues' => ['required', 'array', 'min:1'],

            'revenues.*.name' => ['required', 'string', 'max:255'],
            'revenues.*.types' => ['required', 'string', 'in:tithes,offering'],
            'revenues.*.payment_method' => ['required', 'string', 'in:gcash,cash'],
            'revenues.*.amount' => ['required', 'integer', 'min:0'],
            'revenues.*.bill_1000' => ['nullable', 'integer', 'min:0'],
            'revenues.*.bill_500' => ['nullable', 'integer', 'min:0'],
            'revenues.*.bill_200' => ['nullable', 'integer', 'min:0'],
            'revenues.*.bill_100' => ['nullable', 'integer', 'min:0'],
            'revenues.*.bill_50' => ['nullable', 'integer', 'min:0'],
            'revenues.*.bill_20' => ['nullable', 'integer', 'min:0'],
            'revenues.*.coin_20' => ['nullable', 'integer', 'min:0'],
            'revenues.*.coin_10' => ['nullable', 'integer', 'min:0'],
            'revenues.*.coin_5' => ['nullable', 'integer', 'min:0'],
            'revenues.*.coin_1' => ['nullable', 'integer', 'min:0'],
            'revenues.*.centimo_25' => ['nullable', 'integer', 'min:0'],
            'revenues.*.centimo_10' => ['nullable', 'integer', 'min:0'],
            'revenues.*.centimo_5' => ['nullable', 'integer', 'min:0'],
            'revenues.*.centimo_1' => ['nullable', 'integer', 'min:0'],

        ]);

        DB::transaction(function () use ($validated) {



            foreach ($validated['revenues'] as $revenueData) {

                $collection = RevenueCollection::create([
                    'collection_date' => Carbon::now(),
                ]);

                $revenue = Revenue::create([
                    'revenue_collection_id' => $collection->id,
                    'name' => $revenueData['name'] ?? null,
                    'types' => $revenueData['types'] ?? null,
                    'payment_method' => $revenueData['payment_method'] ?? null,
                    'amount' => $revenueData['amount'] ?? null,

                ]);

                RevenueCashCount::create([
                    'revenue_id' => $revenue->id ?? null,
                    'bill_1000' => $revenueData['bill_1000'] ?? 0,
                    'bill_500' => $revenueData['bill_500'] ?? 0,
                    'bill_200' => $revenueData['bill_200'] ?? 0,
                    'bill_100' => $revenueData['bill_100'] ?? 0,
                    'bill_50' => $revenueData['bill_50'] ?? 0,
                    'bill_20' => $revenueData['bill_20'] ?? 0,
                    'coin_20' => $revenueData['coin_20'] ?? 0,
                    'coin_10' => $revenueData['coin_10'] ?? 0,
                    'coin_5' => $revenueData['coin_5'] ?? 0,
                    'coin_1' => $revenueData['coin_1'] ?? 0,
                    'centimo_25' => $revenueData['centimo_25'] ?? 0,
                    'centimo_10' => $revenueData['centimo_10'] ?? 0,
                    'centimo_5' => $revenueData['centimo_5'] ?? 0,
                    'centimo_1' => $revenueData['centimo_1'] ?? 0,
                ]);
            }
        });

        return redirect()->route('staff.revenues.index')->with('success', 'Revenue Successfully Created');
    }

    public function edit($collectionId)
    {
        $collection = RevenueCollection::with(['revenue.revenue_cash_count'])->findOrFail($collectionId);
        return view('staff.revenue.edit', compact('collection'));
    }

    public function update(Request $request, Revenue $revenue)
    {
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'types' => 'required|string|in:tithes,offerrinng',
            'payment_method' => 'required|string|in:gcash,cash',
            'amount' => 'required|numeric',
            'bill_1000' => 'nullable|integer|min:0',
            'bill_500' => 'nullable|integer|min:0',
            'bill_200' => 'nullable|integer|min:0',
            'bill_100' => 'nullable|integer|min:0',
            'bill_50' => 'nullable|integer|min:0',
            'bill_20' => 'nullable|integer|min:0',
            'coin_20' => 'nullable|integer|min:0',
            'coin_10' => 'nullable|integer|min:0',
            'coin_5' => 'nullable|integer|min:0',
            'coin_1' => 'nullable|integer|min:0',
            'centimo_25' => 'nullable|integer|min:0',
            'centimo_10' => 'nullable|integer|min:0',
            'centimo_5' => 'nullable|integer|min:0',
            'centimo_1' => 'nullable|integer|min:0',
        ]);

        $revenue->update([
            'name' => $validated['name'],
            'types' => $validated['types'],
            'payment_method' => $validated['payment_method'],
            'amount' => $validated['amount'],
        ]);

        if ($validated['payment_method'] === 'cash') {
            RevenueCashCount::updateOrCreate(
                [
                    'revenue_id' => $revenue->id
                ],
                [
                    'bill_1000' => $validated['bill_1000'] ?? 0,
                    'bill_500'  => $validated['bill_500'] ?? 0,
                    'bill_200'  => $validated['bill_200'] ?? 0,
                    'bill_100'  => $validated['bill_100'] ?? 0,
                    'bill_50'   => $validated['bill_50'] ?? 0,
                    'bill_20'   => $validated['bill_20'] ?? 0,
                    'coin_20'   => $validated['coin_20'] ?? 0,
                    'coin_10'   => $validated['coin_10'] ?? 0,
                    'coin_5'    => $validated['coin_5'] ?? 0,
                    'coin_1'    => $validated['coin_1'] ?? 0,
                    'centimo_25' => $validated['centimo_25'] ?? 0,
                    'centimo_10' => $validated['centimo_10'] ?? 0,
                    'centimo_5' => $validated['centimo_5'] ?? 0,
                    'centimo_1' => $validated['centimo_1'] ?? 0,
                ]
            );
        } else {
            RevenueCashCount::where('revenue_id', $revenue->id)->delete();
        }

        return redirect()->route('staff.revenues.index')->with('success', 'Revenue Updated Successfully');
    }

    public function archived()
    {
        $revenues = Revenue::onlyTrashed()
            ->with(['revenueCollection' => fn($q) => $q->withTrashed()])
            ->paginate(10);
        return view('staff.revenue.archive', compact('revenues'));
    }

    public function archive(Revenue $revenue)
    {
        $revenue->delete();
        $revenue->revenueCollection()->delete();
        $revenue->revenue_cash_count()->delete();
        return redirect()->route('staff.revenues.index')->with('success', 'Revenue Successfully Archive');
    }

    public function restore($id)
    {
        $revenues = Revenue::onlyTrashed()->findOrFail($id);
        $revenues->restore($id);
        $revenues->revenue_cash_count()->withTrashed()->restore();
        $revenues->revenueCollection()->withTrashed()->restore();
        return redirect()->route('staff.revenues.archived')->with('success', 'Revenue Successfully Restored');
    }

    public function forceDelete($id)
    {
        $revenues = Revenue::onlyTrashed()->findOrFail($id);
        $revenues->forceDelete($id);
        $revenues->revenue_cash_count()->withTrashed()->forceDelete();
        $revenues->revenueCollection()->withTrashed()->forceDelete();

        return redirect()->route('staff.revenues.archived')->with('success', 'Revenue Successfully Deleted');
    }
}
