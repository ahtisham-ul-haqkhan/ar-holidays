<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CustomerService
{
    /**
     * Get all necessary index data including filtered customers and stats.
     *
     * @param Request|array<string, mixed> $request
     * @return array{customers: LengthAwarePaginator, stats: array{total: int, active: int, inactive: int}, searchTerm: string, selectedStatus: string}
     */
    public function getIndexData(Request|array $request): array
    {
        $search = $request instanceof Request ? $request->query('search') : ($request['search'] ?? null);
        $status = $request instanceof Request ? $request->query('status') : ($request['status'] ?? null);

        $customers = $this->getPaginatedCustomers($search, $status);
        $stats = $this->getCustomerStats();

        return [
            'customers' => $customers,
            'stats' => $stats,
            'searchTerm' => (string) ($search ?? ''),
            'selectedStatus' => (string) ($status ?? 'All'),
        ];
    }

    /**
     * Retrieve paginated customers with search and status filters.
     *
     * @param string|null $search
     * @param string|null $status
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedCustomers(?string $search = null, ?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
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

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }

    /**
     * Get summary counts for customers.
     *
     * @return array{total: int, active: int, inactive: int}
     */
    public function getCustomerStats(): array
    {
        return [
            'total' => Customer::count(),
            'active' => Customer::where('status', 'Active')->count(),
            'inactive' => Customer::where('status', 'Inactive')->count(),
        ];
    }

    /**
     * Get lookup options for forms.
     *
     * @return array{titles: list<string>, genders: list<string>, statuses: list<string>}
     */
    public function getFormData(): array
    {
        return [
            'titles' => ['Mr.', 'Mrs.', 'Ms.', 'Dr.'],
            'genders' => ['Male', 'Female', 'Other'],
            'statuses' => ['Active', 'Inactive'],
        ];
    }

    /**
     * Get data required for edit page.
     *
     * @param int|string $id
     * @return array{customer: Customer, titles: list<string>, genders: list<string>, statuses: list<string>}
     */
    public function getEditData(int|string $id): array
    {
        $customer = $this->getCustomerById($id);

        return array_merge(['customer' => $customer], $this->getFormData());
    }

    /**
     * Find a single customer by id.
     *
     * @param int|string $id
     * @return Customer
     */
    public function getCustomerById(int|string $id): Customer
    {
        return Customer::findOrFail($id);
    }

    /**
     * Validate customer input data.
     *
     * @param array<string, mixed> $data
     * @param int|string|null $customerId
     * @return array<string, mixed>
     * @throws ValidationException
     */
    public function validateCustomerData(array $data, int|string|null $customerId = null): array
    {
        if (empty($data['name']) && (!empty($data['first_name']) || !empty($data['last_name']))) {
            $data['name'] = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
        }

        return Validator::make($data, [
            'title' => 'nullable|string|max:50',
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'regex:/^[\pL\s\.\'-]+$/u',
            ],
            'cnic' => [
                'required',
                'string',
                'max:50',
                'regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/',
                Rule::unique('customers', 'cnic')->ignore($customerId),
            ],
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'passport' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'number' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:Active,Inactive',
        ], [
            'name.required' => 'Customer full name is required.',
            'name.string' => 'Customer name must be a valid text string.',
            'name.min' => 'Customer name must be at least 3 characters long.',
            'name.max' => 'Customer name may not be greater than 100 characters.',
            'name.regex' => 'Customer name may only contain letters, spaces, dots, and hyphens.',
            'cnic.required' => 'CNIC number is required.',
            'cnic.unique' => 'This CNIC number is already registered to another customer.',
            'cnic.regex' => 'CNIC must follow the valid Pakistani format: 12345-1234567-1.',
        ])->validate();
    }

    /**
     * Validate and create a new customer record.
     *
     * @param array<string, mixed> $data
     * @return Customer
     */
    public function createCustomer(array $data): Customer
    {
        $validated = $this->validateCustomerData($data);

        return Customer::create([
            'title' => $validated['title'] ?? null,
            'name' => $validated['name'] ?? null,
            'cnic' => $validated['cnic'],
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'passport' => $validated['passport'] ?? null,
            'email' => $validated['email'] ?? null,
            'number' => $validated['number'] ?? null,
            'address' => $validated['address'] ?? null,
            'status' => $validated['status'] ?? 'Active',
        ]);
    }

    /**
     * Validate and update an existing customer record.
     *
     * @param Customer|int|string $customer
     * @param array<string, mixed> $data
     * @return Customer
     */
    public function updateCustomer(Customer|int|string $customer, array $data): Customer
    {
        $customerModel = $customer instanceof Customer ? $customer : $this->getCustomerById($customer);

        $validated = $this->validateCustomerData($data, $customerModel->id);

        $customerModel->update([
            'title' => $validated['title'] ?? null,
            'name' => $validated['name'] ?? null,
            'cnic' => $validated['cnic'] ?? $customerModel->cnic,
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'passport' => $validated['passport'] ?? null,
            'email' => $validated['email'] ?? null,
            'number' => $validated['number'] ?? null,
            'address' => $validated['address'] ?? null,
            'status' => $validated['status'] ?? 'Active',
        ]);

        return $customerModel;
    }

    /**
     * Soft delete a customer record.
     *
     * @param Customer|int|string $customer
     * @return bool
     */
    public function deleteCustomer(Customer|int|string $customer): bool
    {
        $customerModel = $customer instanceof Customer ? $customer : $this->getCustomerById($customer);

        return (bool) $customerModel->delete();
    }
}
