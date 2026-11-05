<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Customer::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('cnic', 'like', "%{$search}%")
                  ->orWhere('passport', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('number', 'like', "%{$search}%");
            });
        }

        if (!empty($status) && $status !== 'All') {
            $query->where('status', $status);
        }

        $customers = $query->latest('id')->paginate(15)->withQueryString();

        $stats = [
            'total' => Customer::count(),
            'active' => Customer::where('status', 'Active')->count(),
            'inactive' => Customer::where('status', 'Inactive')->count(),
        ];

        return view('customers.index', [
            'customers' => $customers,
            'stats' => $stats,
            'searchTerm' => $search ?? '',
            'selectedStatus' => $status ?? 'All',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('customers.create', [
            'titles' => ['Mr.', 'Mrs.', 'Ms.', 'Dr.'],
            'genders' => ['Male', 'Female', 'Other'],
            'statuses' => ['Active', 'Inactive'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (!$request->filled('name') && ($request->filled('first_name') || $request->filled('last_name'))) {
            $request->merge([
                'name' => trim($request->input('first_name', '') . ' ' . $request->input('last_name', '')),
            ]);
        }

        if (!$request->filled('cnic')) {
            $request->merge([
                'cnic' => '35202-' . rand(1000000, 9999999) . '-' . rand(1, 9),
            ]);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:255',
            'cnic' => 'required|string|max:50|unique:customers,cnic',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'passport' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'number' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:Active,Inactive',
        ]);

        $validated['status'] = $validated['status'] ?? 'Active';

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer registered successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     * @return View
     */
    public function show(int|string $id): View
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', [
            'customer' => $customer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int|string $id
     * @return View
     */
    public function edit(int|string $id): View
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', [
            'customer' => $customer,
            'titles' => ['Mr.', 'Mrs.', 'Ms.', 'Dr.'],
            'genders' => ['Male', 'Female', 'Other'],
            'statuses' => ['Active', 'Inactive'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int|string $id
     * @return RedirectResponse
     */
    public function update(Request $request, int|string $id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);

        if (!$request->filled('name') && ($request->filled('first_name') || $request->filled('last_name'))) {
            $request->merge([
                'name' => trim($request->input('first_name', '') . ' ' . $request->input('last_name', '')),
            ]);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:255',
            'cnic' => 'required|string|max:50|unique:customers,cnic,' . $customer->id,
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'passport' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'number' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:Active,Inactive',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.show', $customer->id)->with('success', 'Customer details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     * @return RedirectResponse
     */
    public function destroy(int|string $id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
