<?php

namespace App\Services;

use App\Models\VisaCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class VisaCategoryService
{
    /**
     * Get all necessary index data including filtered visa categories and stats.
     *
     * @param Request|array<string, mixed> $request
     * @return array{categories: LengthAwarePaginator, stats: array{total: int, active: int, inactive: int}, searchTerm: string, selectedStatus: string}
     */
    public function getIndexData(Request|array $request): array
    {
        $search = $request instanceof Request ? $request->query('search') : ($request['search'] ?? null);
        $status = $request instanceof Request ? $request->query('status') : ($request['status'] ?? null);

        $categories = $this->getPaginatedVisaCategories($search, $status);
        $stats = $this->getVisaCategoryStats();

        return [
            'categories' => $categories,
            'stats' => $stats,
            'searchTerm' => (string) ($search ?? ''),
            'selectedStatus' => (string) ($status ?? 'All'),
        ];
    }

    /**
     * Retrieve paginated visa categories with search and status filters.
     *
     * @param string|null $search
     * @param string|null $status
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedVisaCategories(?string $search = null, ?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = VisaCategory::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        if (!empty($status) && $status !== 'All') {
            $query->where('status', $status);
        }

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }

    /**
     * Get summary counts for visa categories.
     *
     * @return array{total: int, active: int, inactive: int}
     */
    public function getVisaCategoryStats(): array
    {
        return [
            'total' => VisaCategory::count(),
            'active' => VisaCategory::where('status', 'Active')->count(),
            'inactive' => VisaCategory::where('status', 'Inactive')->count(),
        ];
    }

    /**
     * Get lookup options for visa category forms.
     *
     * @return array{statuses: list<string>}
     */
    public function getFormData(): array
    {
        return [
            'statuses' => ['Active', 'Inactive'],
        ];
    }

    /**
     * Get data required for edit page.
     *
     * @param int|string $id
     * @return array{category: VisaCategory, statuses: list<string>}
     */
    public function getEditData(int|string $id): array
    {
        $category = $this->getVisaCategoryById($id);

        return array_merge(['category' => $category], $this->getFormData());
    }

    /**
     * Find a single visa category by id.
     *
     * @param int|string $id
     * @return VisaCategory
     */
    public function getVisaCategoryById(int|string $id): VisaCategory
    {
        return VisaCategory::findOrFail($id);
    }

    /**
     * Validate payload for store/update.
     *
     * @param array<string, mixed> $data
     * @param int|null $ignoreId
     * @return array<string, mixed>
     * @throws ValidationException
     */
    public function validateVisaCategory(array $data, ?int $ignoreId = null): array
    {
        $nameRule = Rule::unique('visa_categories', 'name');
        if ($ignoreId) {
            $nameRule->ignore($ignoreId);
        }

        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:100', $nameRule],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ])->validate();
    }

    /**
     * Create a new visa category in database.
     *
     * @param array<string, mixed> $data
     * @return VisaCategory
     */
    public function createVisaCategory(array $data): VisaCategory
    {
        $validated = $this->validateVisaCategory($data);

        return VisaCategory::create($validated);
    }

    /**
     * Update an existing visa category.
     *
     * @param int|string $id
     * @param array<string, mixed> $data
     * @return VisaCategory
     */
    public function updateVisaCategory(int|string $id, array $data): VisaCategory
    {
        $category = $this->getVisaCategoryById($id);
        $validated = $this->validateVisaCategory($data, (int) $category->id);

        $category->update($validated);

        return $category;
    }

    /**
     * Soft delete a visa category.
     *
     * @param int|string $id
     * @return bool
     */
    public function deleteVisaCategory(int|string $id): bool
    {
        $category = $this->getVisaCategoryById($id);

        return (bool) $category->delete();
    }
}

