<?php

namespace App\Services;

use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class VendorService
{
    /**
     * Get all necessary index data including filtered vendors and stats.
     *
     * @param Request|array<string, mixed> $request
     * @return array{vendors: LengthAwarePaginator, stats: array{total: int, active: int, inactive: int}, searchTerm: string, selectedStatus: string}
     */
    public function getIndexData(Request|array $request): array
    {
        $search = $request instanceof Request ? $request->query('search') : ($request['search'] ?? null);
        $status = $request instanceof Request ? $request->query('status') : ($request['status'] ?? null);

        $vendors = $this->getPaginatedVendors($search, $status);
        $stats = $this->getVendorStats();

        return [
            'vendors' => $vendors,
            'stats' => $stats,
            'searchTerm' => (string) ($search ?? ''),
            'selectedStatus' => (string) ($status ?? 'All'),
        ];
    }

    /**
     * Retrieve paginated vendors with search and status filters.
     *
     * @param string|null $search
     * @param string|null $status
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedVendors(?string $search = null, ?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Vendor::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        if (!empty($status) && $status !== 'All') {
            $query->where('status', $status);
        }

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }

    /**
     * Get summary counts for vendors.
     *
     * @return array{total: int, active: int, inactive: int}
     */
    public function getVendorStats(): array
    {
        return [
            'total' => Vendor::count(),
            'active' => Vendor::where('status', 'Active')->count(),
            'inactive' => Vendor::where('status', 'Inactive')->count(),
        ];
    }

    /**
     * Get lookup options for vendor forms.
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
     * @return array{vendor: Vendor, statuses: list<string>}
     */
    public function getEditData(int|string $id): array
    {
        $vendor = $this->getVendorById($id);

        return array_merge(['vendor' => $vendor], $this->getFormData());
    }

    /**
     * Find a single vendor by id.
     *
     * @param int|string $id
     * @return Vendor
     */
    public function getVendorById(int|string $id): Vendor
    {
        return Vendor::findOrFail($id);
    }

    /**
     * Validate vendor input data.
     *
     * @param array<string, mixed> $data
     * @param int|string|null $vendorId
     * @return array<string, mixed>
     * @throws ValidationException
     */
    public function validateVendorData(array $data, int|string|null $vendorId = null): array
    {
        $uniqueRule = 'required|string|max:255|unique:vendors,name' . ($vendorId ? ',' . $vendorId : '');

        return Validator::make($data, [
            'name' => $uniqueRule,
            'status' => 'nullable|string|in:Active,Inactive',
        ])->validate();
    }

    /**
     * Validate and create a new vendor record using Vendor::create([...]).
     *
     * @param array<string, mixed> $data
     * @return Vendor
     */
    public function createVendor(array $data): Vendor
    {
        $validated = $this->validateVendorData($data);

        return Vendor::create([
            'name' => $validated['name'],
            'status' => $validated['status'] ?? 'Active',
        ]);
    }

    /**
     * Validate and update an existing vendor record using $vendor->update([...]).
     *
     * @param Vendor|int|string $vendor
     * @param array<string, mixed> $data
     * @return Vendor
     */
    public function updateVendor(Vendor|int|string $vendor, array $data): Vendor
    {
        $vendorModel = $vendor instanceof Vendor ? $vendor : $this->getVendorById($vendor);

        $validated = $this->validateVendorData($data, $vendorModel->id);

        $vendorModel->update([
            'name' => $validated['name'],
            'status' => $validated['status'] ?? 'Active',
        ]);

        return $vendorModel;
    }

    /**
     * Soft delete a vendor record.
     *
     * @param Vendor|int|string $vendor
     * @return bool
     */
    public function deleteVendor(Vendor|int|string $vendor): bool
    {
        $vendorModel = $vendor instanceof Vendor ? $vendor : $this->getVendorById($vendor);

        return (bool) $vendorModel->delete();
    }
}
