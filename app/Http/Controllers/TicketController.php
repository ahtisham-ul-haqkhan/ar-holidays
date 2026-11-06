<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Show the form for creating a new flight ticket / booking.
     *
     * @return View
     */
    public function create(): View
    {
        $vendors = Vendor::where('status', 'Active')->orderBy('name')->get();
        $customers = Customer::where('status', 'Active')->orderBy('name')->get();

        return view('tickets.create', compact('vendors', 'customers'));
    }
}

