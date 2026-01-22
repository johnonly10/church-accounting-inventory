<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\RevenueCashCount;
use App\Models\RevenueCollection;
use App\Models\Revenue_collection;
use App\Models\RevenueType;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\delete;
use function Symfony\Component\Clock\now;

class RevenueController extends Controller
{

    public function index(Request $request)
    {
        $query = Revenue::with(['revenueCollection', 'revenueType']);
        // dd($request->all());

        // Send the query and request
        $this->applyFilters($query, $request);
        $revenueTypes = RevenueType::all()->pluck('name', 'id');

        $revenues = $query->orderBy('id')->paginate(10)->withQueryString();
        return view('staff.revenue.index', compact('revenues', 'revenueTypes'));
    }

    // received the query and request from the index
    private function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereHas('revenueCollection', function ($q) use ($request) {
                $q->withTrashed()->whereDate('collection_date', '>=', $request->date_from);
            });
        }
        if ($request->filled('date_to')) {
            $query->whereHas('revenueCollection', function ($q) use ($request) {
                $q->withTrashed()->whereDate('collection_date', '<=', $request->date_to);
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('beneficiary')) {
            $query->where('beneficiary', $request->beneficiary);
        }

        if ($request->filled('revenue_type')) {
            $query->where('revenue_type_id', $request->revenue_type);
        }
    }





    public function create()
    {
        $revenueTypes = RevenueType::orderBy('name')->get();
        return view('staff.revenue.create', compact('revenueTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'revenues' => ['required', 'array', 'min:1'],

            'revenues.*.name' => ['nullable', 'string', 'max:255'],
            'revenues.*.revenue_type_id' => ['required', 'integer', 'exists:revenue_types,id'],
            'revenues.*.beneficiary' => ['required', 'in:pastor,general'],
            'revenues.*.payment_method' => ['required', 'in:gcash,cash'],
            'revenues.*.amount' => ['required', 'numeric', 'min:0'],


        ]);

        DB::transaction(function () use ($validated) {
            $collection = RevenueCollection::create([
                'collection_date' => Carbon::now(),
            ]);

            foreach ($validated['revenues'] as $revenueData) {
                Revenue::create([
                    'revenue_collection_id' => $collection->id,
                    'revenue_type_id' => $revenueData['revenue_type_id'],
                    'name' => $revenueData['name'] ?? null,
                    'beneficiary' => $revenueData['beneficiary'],
                    'payment_method' => $revenueData['payment_method'],
                    'amount' => $revenueData['amount'],
                ]);
            }
        });

        return redirect()->route('staff.revenues.index')->with('success', 'Revenue Successfully Created');
    }


    public function edit(Revenue $revenue)
    {
        $revenue->load(['revenueCollection']);
        $revenueTypes = RevenueType::orderBy('name')->get();

        return view('staff.revenue.edit', compact('revenue', 'revenueTypes'));
    }

    public function update(Request $request, Revenue $revenue)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'revenue_type_id' => ['required', 'integer', 'exists:revenue_types,id'],
            'beneficiary' => ['required', 'in:pastor,general'],
            'payment_method' => ['required', 'in:gcash,cash'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $revenue->update($validated);



        return redirect()->route('staff.revenues.index')->with('success', 'Revenue Updated Successfully');
    }


    public function archived(Request $request)
    {

        $query = Revenue::onlyTrashed()
            ->with([
                'revenueCollection' => fn($q) => $q->withTrashed(),
                'revenueType' => fn($q) => $q->withTrashed()
            ]);

        $this->applyFilters($query, $request);

        $revenueTypes = RevenueType::all()->pluck('name', 'id');

        $revenues = $query->orderBy('deleted_at', 'desc')->paginate(10);
        return view('staff.revenue.archive', compact('revenues', 'revenueTypes'));
    }

    public function archive(Revenue $revenue)
    {
        $revenue->delete();
        $revenue->revenueCollection()->delete();
        // $revenue->revenueCashCount()->delete();
        return redirect()->route('staff.revenues.index')->with('success', 'Revenue Successfully Archive');
    }

    public function restore($id)
    {
        $revenues = Revenue::onlyTrashed()->findOrFail($id);
        $revenues->restore($id);
        // $revenues->revenueCashCount()->withTrashed()->restore();
        $revenues->revenueCollection()->withTrashed()->restore();
        return redirect()->route('staff.revenues.archived')->with('success', 'Revenue Successfully Restored');
    }

    public function forceDelete($id)
    {
        $revenues = Revenue::onlyTrashed()->findOrFail($id);
        $revenues->forceDelete($id);
        // $revenues->revenueCashCount()->withTrashed()->forceDelete();
        $revenues->revenueCollection()->withTrashed()->forceDelete();

        return redirect()->route('staff.revenues.archived')->with('success', 'Revenue Successfully Deleted');
    }
}
