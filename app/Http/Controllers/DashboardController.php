<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- Cards Data ---

        // Total Sales Amount (₱)
        $totalSales = Sale::sum('total_sales');

        // Total Number of Sales (transactions)
        $salesCount = Sale::count();

        // Products sold per region (for card + bar chart)
        $salesPerRegion = Sale::select('region_id', DB::raw('SUM(units_sold) as total_units'))
            ->groupBy('region_id')
            ->with('region') // Make sure you have region() relation in Sale model
            ->get()
            ->map(function ($sale) {
                return [
                    'region_name' => optional($sale->region)->name ?? 'Unknown',
                    'total_units' => $sale->total_units,
                ];
            });

        // --- Charts Data ---

        // Line Chart - Units sold per month
        $salesPerMonth = Sale::select(
            DB::raw('DATE_FORMAT(date, "%Y-%m") as month'),
            DB::raw('SUM(units_sold) as total_units')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        return view('dashboard.index', compact(
            'totalSales',
            'salesCount',
            'salesPerRegion', // Updated variable name
            'salesPerMonth'
        ));
    }
}
