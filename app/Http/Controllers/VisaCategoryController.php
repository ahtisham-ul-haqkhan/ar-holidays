<?php

namespace App\Http\Controllers;

use App\Services\VisaCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisaCategoryController extends Controller
{
    /**
     * VisaCategoryController constructor using PHP 8.3 property promotion.
     *
     * @param VisaCategoryService $visaCategoryService
     */
    public function __construct(
        protected VisaCategoryService $visaCategoryService
    ) {
    }

    /**
     * Display a listing of the visa categories.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('visa-categories.index', $this->visaCategoryService->getIndexData($request));
    }

    /**
     * Show the form for creating a new visa category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('visa-categories.create', $this->visaCategoryService->getFormData());
    }

    /**
     * Store a newly created visa category in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->visaCategoryService->createVisaCategory($request->all());

        return redirect()->route('visa-categories.index')->with('success', 'Visa category created successfully.');
    }

    /**
     * Display the specified visa category.
     *
     * @param int|string $id
     * @return View
     */
    public function show(int|string $id): View
    {
        $category = $this->visaCategoryService->getVisaCategoryById($id);

        return view('visa-categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified visa category.
     *
     * @param int|string $id
     * @return View
     */
    public function edit(int|string $id): View
    {
        return view('visa-categories.edit', $this->visaCategoryService->getEditData($id));
    }

    /**
     * Update the specified visa category in storage.
     *
     * @param Request $request
     * @param int|string $id
     * @return RedirectResponse
     */
    public function update(Request $request, int|string $id): RedirectResponse
    {
        $this->visaCategoryService->updateVisaCategory($id, $request->all());

        return redirect()->route('visa-categories.index')->with('success', 'Visa category updated successfully.');
    }

    /**
     * Remove the specified visa category from storage.
     *
     * @param int|string $id
     * @return RedirectResponse
     */
    public function destroy(int|string $id): RedirectResponse
    {
        $this->visaCategoryService->deleteVisaCategory($id);

        return redirect()->route('visa-categories.index')->with('success', 'Visa category deleted successfully.');
    }
}

