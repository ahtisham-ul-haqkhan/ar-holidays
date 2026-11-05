<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Get mock static customer repository.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function getStaticCustomers(): array
    {
        return [
            1 => [
                'id' => 1,
                'customer_code' => 'AR-8821',
                'first_name' => 'Muhammad',
                'last_name' => 'Hamza',
                'full_name' => 'Muhammad Hamza',
                'email' => 'hamza.travels@gmail.com',
                'phone' => '+92 300 8472910',
                'whatsapp' => '+92 300 8472910',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
                'initials' => 'MH',
                'gender' => 'Male',
                'dob' => '1990-06-14',
                'nationality' => 'Pakistan',
                'cnic' => '35202-8492019-3',
                'passport_number' => 'PK8829104',
                'passport_country' => 'Pakistan',
                'passport_expiry' => '2029-11-20',
                'passport_status' => 'Valid (3+ Years)',
                'loyalty_tier' => 'Platinum VIP',
                'tier_badge_color' => 'bg-amber-500/10 text-amber-600 border-amber-200',
                'total_bookings' => 14,
                'total_spend' => '$14,850',
                'status' => 'Active',
                'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                'last_destination' => 'Dubai (DXB)',
                'city' => 'Lahore',
                'address' => 'House 42-B, Phase 5 DHA, Lahore, Pakistan',
                'member_since' => 'March 2022',
                'emergency_contact' => [
                    'name' => 'Ayesha Hamza',
                    'relation' => 'Spouse',
                    'phone' => '+92 321 4455667',
                ],
                'preferences' => [
                    'airline' => 'Emirates / Qatar Airways',
                    'seat' => 'Window / Extra Legroom',
                    'meal' => 'Halal Muslim Meal (MOML)',
                    'hotel' => '5-Star Luxury Suites',
                ],
                'bookings' => [
                    [
                        'id' => 'BKG-9921',
                        'pnr' => 'EK-88912',
                        'title' => 'Dubai 5-Day Luxury Package',
                        'type' => 'Holiday Package',
                        'airline' => 'Emirates (EK-607)',
                        'departure' => '12 Nov 2026',
                        'return' => '17 Nov 2026',
                        'destination' => 'Dubai, UAE (DXB)',
                        'passengers' => 2,
                        'amount' => '$2,450',
                        'status' => 'Confirmed',
                        'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                    ],
                    [
                        'id' => 'BKG-8402',
                        'pnr' => 'TK-44109',
                        'title' => 'Istanbul Historic & Bosphorus Cruise',
                        'type' => 'Holiday Package',
                        'airline' => 'Turkish Airlines (TK-715)',
                        'departure' => '15 Sep 2026',
                        'return' => '22 Sep 2026',
                        'destination' => 'Istanbul, Turkey (IST)',
                        'passengers' => 2,
                        'amount' => '$3,100',
                        'status' => 'Completed',
                        'status_color' => 'bg-slate-500/10 text-slate-600 border-slate-200',
                    ],
                    [
                        'id' => 'BKG-7714',
                        'pnr' => 'J9-33821',
                        'title' => 'Baku Winter Wonder 6 Days',
                        'type' => 'Holiday Package',
                        'airline' => 'Azerbaijan Airlines (J2-054)',
                        'departure' => '05 Jan 2026',
                        'return' => '11 Jan 2026',
                        'destination' => 'Baku, Azerbaijan (GYD)',
                        'passengers' => 4,
                        'amount' => '$4,200',
                        'status' => 'Completed',
                        'status_color' => 'bg-slate-500/10 text-slate-600 border-slate-200',
                    ],
                ],
                'documents' => [
                    ['title' => 'Passport Scan (PK8829104)', 'type' => 'Passport', 'expiry' => 'Nov 2029', 'status' => 'Verified'],
                    ['title' => 'UAE Multiple Entry Visa', 'type' => 'Visa', 'expiry' => 'Dec 2027', 'status' => 'Valid'],
                    ['title' => 'Azerbaijan ASAN e-Visa', 'type' => 'Visa', 'expiry' => 'Expired', 'status' => 'Renewal Needed'],
                    ['title' => 'COVID Vaccination Card', 'type' => 'Health', 'expiry' => 'Lifetime', 'status' => 'On File'],
                ],
            ],
            2 => [
                'id' => 2,
                'customer_code' => 'AR-7940',
                'first_name' => 'Fatima',
                'last_name' => 'Zahra',
                'full_name' => 'Fatima Zahra',
                'email' => 'fatima.zahra@outlook.com',
                'phone' => '+92 333 5599812',
                'whatsapp' => '+92 333 5599812',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80',
                'initials' => 'FZ',
                'gender' => 'Female',
                'dob' => '1995-10-22',
                'nationality' => 'Pakistan',
                'cnic' => '61101-7729104-2',
                'passport_number' => 'PK9201948',
                'passport_country' => 'Pakistan',
                'passport_expiry' => '2030-04-15',
                'passport_status' => 'Valid',
                'loyalty_tier' => 'Gold Member',
                'tier_badge_color' => 'bg-red-500/10 text-red-600 border-red-200',
                'total_bookings' => 8,
                'total_spend' => '$7,840',
                'status' => 'Active',
                'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                'last_destination' => 'Baku (GYD)',
                'city' => 'Islamabad',
                'address' => 'Sector F-7/2, Street 18, Islamabad, Pakistan',
                'member_since' => 'August 2023',
                'emergency_contact' => [
                    'name' => 'Tariq Zahra',
                    'relation' => 'Brother',
                    'phone' => '+92 301 9988776',
                ],
                'preferences' => [
                    'airline' => 'Qatar Airways',
                    'seat' => 'Aisle Seat',
                    'meal' => 'Asian Vegetarian Meal (AVML)',
                    'hotel' => 'Boutique Resorts',
                ],
                'bookings' => [
                    [
                        'id' => 'BKG-9844',
                        'pnr' => 'QR-91820',
                        'title' => 'Maldives Overwater Villa 4N/5D',
                        'type' => 'Honeymoon Tour',
                        'airline' => 'Qatar Airways (QR-615)',
                        'departure' => '20 Nov 2026',
                        'return' => '25 Nov 2026',
                        'destination' => 'Male, Maldives (MLE)',
                        'passengers' => 2,
                        'amount' => '$3,400',
                        'status' => 'Confirmed',
                        'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                    ],
                ],
                'documents' => [
                    ['title' => 'Passport Scan (PK9201948)', 'type' => 'Passport', 'expiry' => 'Apr 2030', 'status' => 'Verified'],
                    ['title' => 'Maldives On-Arrival Entry', 'type' => 'Visa', 'expiry' => '30 Days', 'status' => 'Pre-approved'],
                ],
            ],
            3 => [
                'id' => 3,
                'customer_code' => 'AR-6311',
                'first_name' => 'Bilal',
                'last_name' => 'Siddiqui',
                'full_name' => 'Bilal Siddiqui',
                'email' => 'bilal.siddiqui@techcorp.ae',
                'phone' => '+971 50 123 4567',
                'whatsapp' => '+971 50 123 4567',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
                'initials' => 'BS',
                'gender' => 'Male',
                'dob' => '1987-03-08',
                'nationality' => 'UAE Resident / Pakistan',
                'cnic' => '42101-3891024-1',
                'passport_number' => 'PK7718290',
                'passport_country' => 'Pakistan',
                'passport_expiry' => '2028-09-12',
                'passport_status' => 'Valid',
                'loyalty_tier' => 'Platinum VIP',
                'tier_badge_color' => 'bg-amber-500/10 text-amber-600 border-amber-200',
                'total_bookings' => 19,
                'total_spend' => '$26,400',
                'status' => 'Active',
                'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                'last_destination' => 'London (LHR)',
                'city' => 'Dubai / Karachi',
                'address' => 'Marina Gate 2, Dubai Marina, Dubai, UAE',
                'member_since' => 'January 2021',
                'emergency_contact' => [
                    'name' => 'Sara Siddiqui',
                    'relation' => 'Spouse',
                    'phone' => '+971 55 987 6543',
                ],
                'preferences' => [
                    'airline' => 'Emirates First / Business',
                    'seat' => 'Business Class 2A',
                    'meal' => 'Halal Gourmet',
                    'hotel' => 'Four Seasons / Ritz-Carlton',
                ],
                'bookings' => [
                    [
                        'id' => 'BKG-9901',
                        'pnr' => 'BA-77109',
                        'title' => 'London & Scotland Highlands 8D',
                        'type' => 'Corporate & Leisure',
                        'airline' => 'British Airways (BA-260)',
                        'departure' => '28 Nov 2026',
                        'return' => '06 Dec 2026',
                        'destination' => 'London, UK (LHR)',
                        'passengers' => 1,
                        'amount' => '$4,850',
                        'status' => 'Processing',
                        'status_color' => 'bg-amber-500/10 text-amber-600 border-amber-200',
                    ],
                ],
                'documents' => [
                    ['title' => 'Passport Scan (PK7718290)', 'type' => 'Passport', 'expiry' => 'Sep 2028', 'status' => 'Verified'],
                    ['title' => 'UK 5-Year Multiple Entry Visa', 'type' => 'Visa', 'expiry' => 'Oct 2029', 'status' => 'Valid'],
                ],
            ],
            4 => [
                'id' => 4,
                'customer_code' => 'AR-5209',
                'first_name' => 'Zainab',
                'last_name' => 'Khurram',
                'full_name' => 'Zainab Khurram',
                'email' => 'zainab.k@gmail.com',
                'phone' => '+92 321 8899001',
                'whatsapp' => '+92 321 8899001',
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80',
                'initials' => 'ZK',
                'gender' => 'Female',
                'dob' => '1998-12-05',
                'nationality' => 'Pakistan',
                'cnic' => '35201-9988112-4',
                'passport_number' => 'PK6401928',
                'passport_country' => 'Pakistan',
                'passport_expiry' => '2027-02-18',
                'passport_status' => 'Expiring Soon (Under 6 Mo)',
                'loyalty_tier' => 'Silver Member',
                'tier_badge_color' => 'bg-slate-500/10 text-slate-600 border-slate-200',
                'total_bookings' => 3,
                'total_spend' => '$3,200',
                'status' => 'Pending Renewal',
                'status_color' => 'bg-amber-500/10 text-amber-600 border-amber-200',
                'last_destination' => 'Antalya (AYT)',
                'city' => 'Karachi',
                'address' => 'Clifton Block 4, Karachi, Pakistan',
                'member_since' => 'May 2024',
                'emergency_contact' => [
                    'name' => 'Khurram Shah',
                    'relation' => 'Father',
                    'phone' => '+92 300 2345678',
                ],
                'preferences' => [
                    'airline' => 'Pegasus / Turkish',
                    'seat' => 'Window Seat',
                    'meal' => 'Standard Meal',
                    'hotel' => 'All-Inclusive Beach Resorts',
                ],
                'bookings' => [
                    [
                        'id' => 'BKG-6612',
                        'pnr' => 'TK-99210',
                        'title' => 'Antalya Turkish Riviera 6D/5N',
                        'type' => 'Holiday Package',
                        'airline' => 'Turkish Airlines',
                        'departure' => '14 Oct 2026',
                        'return' => '20 Oct 2026',
                        'destination' => 'Antalya, Turkey (AYT)',
                        'passengers' => 3,
                        'amount' => '$2,850',
                        'status' => 'Completed',
                        'status_color' => 'bg-slate-500/10 text-slate-600 border-slate-200',
                    ],
                ],
                'documents' => [
                    ['title' => 'Passport Scan (PK6401928)', 'type' => 'Passport', 'expiry' => 'Feb 2027', 'status' => 'Expiring Soon'],
                ],
            ],
            5 => [
                'id' => 5,
                'customer_code' => 'AR-4490',
                'first_name' => 'Usman',
                'last_name' => 'Ghafoor',
                'full_name' => 'Usman Ghafoor',
                'email' => 'usman.ghafoor@yahoo.com',
                'phone' => '+92 302 7711223',
                'whatsapp' => '+92 302 7711223',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
                'initials' => 'UG',
                'gender' => 'Male',
                'dob' => '1982-08-30',
                'nationality' => 'Pakistan',
                'cnic' => '38403-1289104-5',
                'passport_number' => 'PK8102941',
                'passport_country' => 'Pakistan',
                'passport_expiry' => '2031-07-25',
                'passport_status' => 'Valid',
                'loyalty_tier' => 'Gold Member',
                'tier_badge_color' => 'bg-red-500/10 text-red-600 border-red-200',
                'total_bookings' => 9,
                'total_spend' => '$11,600',
                'status' => 'Active',
                'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                'last_destination' => 'Jeddah (JED)',
                'city' => 'Faisalabad',
                'address' => 'Canal Park, Jaranwala Road, Faisalabad, Pakistan',
                'member_since' => 'November 2022',
                'emergency_contact' => [
                    'name' => 'Rashid Ghafoor',
                    'relation' => 'Brother',
                    'phone' => '+92 300 9871122',
                ],
                'preferences' => [
                    'airline' => 'Saudia / PIA',
                    'seat' => 'Aisle Seat Front',
                    'meal' => 'Diabetic Friendly',
                    'hotel' => 'Haram View 5-Star Hotels',
                ],
                'bookings' => [
                    [
                        'id' => 'BKG-9944',
                        'pnr' => 'SV-11029',
                        'title' => 'Umrah Deluxe Executive Family Package',
                        'type' => 'Umrah / Religious',
                        'airline' => 'Saudia (SV-735)',
                        'departure' => '01 Dec 2026',
                        'return' => '15 Dec 2026',
                        'destination' => 'Makkah & Madinah (JED/MED)',
                        'passengers' => 4,
                        'amount' => '$5,600',
                        'status' => 'Confirmed',
                        'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                    ],
                ],
                'documents' => [
                    ['title' => 'Passport Scan (PK8102941)', 'type' => 'Passport', 'expiry' => 'Jul 2031', 'status' => 'Verified'],
                    ['title' => 'Saudi Umrah eVisa', 'type' => 'Visa', 'expiry' => 'Jan 2027', 'status' => 'Issued'],
                ],
            ],
            6 => [
                'id' => 6,
                'customer_code' => 'AR-3912',
                'first_name' => 'Ayesha',
                'last_name' => 'Malik',
                'full_name' => 'Ayesha Malik',
                'email' => 'ayesha.malik@creatives.co',
                'phone' => '+92 345 6677889',
                'whatsapp' => '+92 345 6677889',
                'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&auto=format&fit=crop&q=80',
                'initials' => 'AM',
                'gender' => 'Female',
                'dob' => '1993-04-19',
                'nationality' => 'Pakistan',
                'cnic' => '35202-6619284-8',
                'passport_number' => 'PK7491024',
                'passport_country' => 'Pakistan',
                'passport_expiry' => '2029-05-10',
                'passport_status' => 'Valid',
                'loyalty_tier' => 'Lead Traveler',
                'tier_badge_color' => 'bg-purple-500/10 text-purple-600 border-purple-200',
                'total_bookings' => 2,
                'total_spend' => '$1,950',
                'status' => 'Active',
                'status_color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
                'last_destination' => 'Kuala Lumpur (KUL)',
                'city' => 'Rawalpindi',
                'address' => 'Bahria Town Phase 7, Rawalpindi, Pakistan',
                'member_since' => 'July 2024',
                'emergency_contact' => [
                    'name' => 'Kamran Malik',
                    'relation' => 'Father',
                    'phone' => '+92 333 1122334',
                ],
                'preferences' => [
                    'airline' => 'Malaysia Airlines / Batik Air',
                    'seat' => 'Window Seat',
                    'meal' => 'Halal Child Friendly',
                    'hotel' => 'City Center Hotels',
                ],
                'bookings' => [
                    [
                        'id' => 'BKG-5521',
                        'pnr' => 'MH-38910',
                        'title' => 'Malaysia & Langkawi 7 Days Tour',
                        'type' => 'Holiday Package',
                        'airline' => 'Malaysia Airlines',
                        'departure' => '22 Dec 2026',
                        'return' => '29 Dec 2026',
                        'destination' => 'Kuala Lumpur, Malaysia (KUL)',
                        'passengers' => 2,
                        'amount' => '$1,950',
                        'status' => 'Processing',
                        'status_color' => 'bg-amber-500/10 text-amber-600 border-amber-200',
                    ],
                ],
                'documents' => [
                    ['title' => 'Passport Scan (PK7491024)', 'type' => 'Passport', 'expiry' => 'May 2029', 'status' => 'Verified'],
                    ['title' => 'Malaysia MDAC e-Card', 'type' => 'Document', 'expiry' => '30 Days', 'status' => 'Submitted'],
                ],
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $customers = $this->getStaticCustomers();
        $search = $request->query('search');
        $status = $request->query('status');

        if (!empty($search)) {
            $search = strtolower((string) $search);
            $customers = array_filter($customers, function (array $c) use ($search): bool {
                return str_contains(strtolower($c['full_name']), $search) ||
                    str_contains(strtolower($c['email']), $search) ||
                    str_contains(strtolower($c['phone']), $search) ||
                    str_contains(strtolower($c['passport_number']), $search) ||
                    str_contains(strtolower($c['customer_code']), $search);
            });
        }

        if (!empty($status) && $status !== 'All') {
            $customers = array_filter($customers, function (array $c) use ($status): bool {
                return strtolower($c['status']) === strtolower($status);
            });
        }

        $stats = [
            'total' => 1420,
            'vip_count' => 285,
            'active_bookings' => 94,
            'pending_visas' => 42,
        ];

        return view('customers.index', [
            'customers' => $customers,
            'stats' => $stats,
            'searchTerm' => $search,
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
            'titles' => ['Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.'],
            'countries' => ['Pakistan', 'United Arab Emirates', 'Saudi Arabia', 'United Kingdom', 'United States', 'Turkey', 'Canada'],
            'airlines' => ['Emirates', 'Qatar Airways', 'PIA (Pakistan International)', 'Turkish Airlines', 'Saudia', 'FlyDubai', 'Air Arabia'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     * @return View
     */
    public function show(int|string $id): View
    {
        $customers = $this->getStaticCustomers();
        $customer = $customers[(int) $id] ?? $customers[1];

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
        $customers = $this->getStaticCustomers();
        $customer = $customers[(int) $id] ?? $customers[1];

        return view('customers.edit', [
            'customer' => $customer,
            'titles' => ['Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.'],
            'countries' => ['Pakistan', 'United Arab Emirates', 'Saudi Arabia', 'United Kingdom', 'United States', 'Turkey', 'Canada'],
            'airlines' => ['Emirates', 'Qatar Airways', 'PIA (Pakistan International)', 'Turkish Airlines', 'Saudia', 'FlyDubai', 'Air Arabia'],
        ]);
    }

    /**
     * Store a newly created resource in storage (mock).
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('customers.index')->with('success', 'Customer profile created successfully! Ready for ticket & package booking.');
    }

    /**
     * Update the specified resource in storage (mock).
     *
     * @param Request $request
     * @param int|string $id
     * @return RedirectResponse
     */
    public function update(Request $request, int|string $id): RedirectResponse
    {
        return redirect()->route('customers.show', $id)->with('success', 'Customer information updated successfully.');
    }
}

