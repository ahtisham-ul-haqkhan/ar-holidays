<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Create a new DashboardController instance.
     */
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    /**
     * Display the main AR Holidays dashboard.
     */
    public function index(): View
    {
        return view('welcome', [
            'kpis' => $this->dashboardService->getKPIs(),
            'monthlyChart' => $this->dashboardService->getMonthlyTicketSalesChart(),
            'vendorPayables' => $this->dashboardService->getVendorPayables(),
            'visaSalesReport' => $this->dashboardService->getVisaSalesReport(),
            'recentBookings' => $this->dashboardService->getRecentBookings(),
        ]);
    }
}
