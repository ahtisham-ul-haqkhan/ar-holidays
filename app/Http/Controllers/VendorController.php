<?php

namespace App\Http\Controllers;

use App\Services\VendorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VendorController extends Controller
{
    /**
     * VendorController constructor using PHP 8.3 property promotion.
     *
     * @param VendorService $vendorService
     */
    public function __construct(
        protected VendorService $vendorService
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
        return view('vendors.index', $this->vendorService->getIndexData($request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('vendors.create', $this->vendorService->getFormData());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->vendorService->createVendor($request->all());

        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     * @return View
     */
    public function show(int|string $id): View
    {
        $vendor = $this->vendorService->getVendorById($id);

        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int|string $id
     * @return View
     */
    public function edit(int|string $id): View
    {
        return view('vendors.edit', $this->vendorService->getEditData($id));
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
        $this->vendorService->updateVendor($id, $request->all());

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     * @return RedirectResponse
     */
    public function destroy(int|string $id): RedirectResponse
    {
        $this->vendorService->deleteVendor($id);

        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
    }
}

