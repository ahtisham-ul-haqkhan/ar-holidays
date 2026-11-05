<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * CustomerController constructor.
     *
     * @param CustomerService $customerService
     */
    public function __construct(
        protected CustomerService $customerService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('customers.index', $this->customerService->getIndexData($request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('customers.create', $this->customerService->getFormData());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->customerService->createCustomer($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     * @return View
     */
    public function show(int|string $id): View
    {
        $customer = $this->customerService->getCustomerById($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int|string $id
     * @return View
     */
    public function edit(int|string $id): View
    {
        return view('customers.edit', $this->customerService->getEditData($id));
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
        $this->customerService->updateCustomer($id, $request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     * @return RedirectResponse
     */
    public function destroy(int|string $id): RedirectResponse
    {
        $this->customerService->deleteCustomer($id);

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
