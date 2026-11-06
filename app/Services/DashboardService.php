<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Vendor;

class DashboardService
{
    /**
     * Get core high-level KPIs for the travel operations desk.
     *
     * @return array<string, mixed>
     */
    public function getKPIs(): array
    {
        $customerCount = Customer::count();
        $vendorCount = Vendor::count();

        return [
            [
                'title' => 'Tickets Sold',
                'value' => '3,485',
                'sub_value' => 'PKR 142.8M Gross Volume',
                'change' => '+18.4%',
                'trend' => 'up',
                'period' => 'vs last month',
                'icon' => 'ticket',
                'color' => 'red',
                'gradient' => 'from-red-600 to-rose-700',
                'bg_light' => 'bg-red-50 text-red-600',
                'badge' => 'High Demand',
            ],
            [
                'title' => 'Vendor Payables (Due)',
                'value' => 'PKR 24.6M',
                'sub_value' => '11 Airline Carriers',
                'change' => 'Due in 7 Days',
                'trend' => 'warning',
                'period' => 'GDS Billing Cycle',
                'icon' => 'building-columns',
                'color' => 'amber',
                'gradient' => 'from-amber-600 to-amber-700',
                'bg_light' => 'bg-amber-50 text-amber-600',
                'badge' => 'Pending Settlement',
            ],
            [
                'title' => 'Visas Sold & Issued',
                'value' => '842 Visas',
                'sub_value' => '98.6% Approval Rate',
                'change' => '+24.1%',
                'trend' => 'up',
                'period' => 'Umrah, UAE, Saudi, UK',
                'icon' => 'passport',
                'color' => 'emerald',
                'gradient' => 'from-emerald-600 to-teal-700',
                'bg_light' => 'bg-emerald-50 text-emerald-600',
                'badge' => 'Active Desk',
            ],
            [
                'title' => 'Registered Clients',
                'value' => (string) max($customerCount, 3),
                'sub_value' => 'Corporate & Retail Dossiers',
                'change' => '+12.5%',
                'trend' => 'up',
                'period' => '100% CNIC Verified',
                'icon' => 'users',
                'color' => 'slate',
                'gradient' => 'from-slate-800 to-slate-950',
                'bg_light' => 'bg-slate-100 text-slate-800',
                'badge' => 'Database Sync',
            ],
        ];
    }

    /**
     * Get monthly ticket sales trend data for the chart.
     *
     * @return array{months: array<string>, tickets: array<int>, revenue: array<float>}
     */
    public function getMonthlyTicketSalesChart(): array
    {
        return [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'tickets' => [245, 310, 425, 380, 520, 690, 840, 780, 920, 1140, 1290, 1485],
            'revenue_millions' => [10.2, 12.8, 17.5, 15.6, 21.4, 28.3, 34.5, 32.1, 37.8, 46.7, 52.9, 61.2],
        ];
    }

    /**
     * Get airline vendor ledger & payables report (Kitnay paise vendor ko dene hain).
     *
     * @return array<int, array<string, mixed>>
     */
    public function getVendorPayables(): array
    {
        return [
            [
                'vendor' => 'PIA (Pakistan International Airlines)',
                'code' => 'PK',
                'logo_badge' => 'bg-emerald-700 text-white',
                'tickets_issued' => 842,
                'gross_amount' => 'PKR 34,250,000',
                'paid_amount' => 'PKR 28,000,000',
                'payable_due' => 'PKR 6,250,000',
                'due_date' => '15 Nov 2026',
                'status' => 'Pending Settlement',
                'status_color' => 'bg-amber-50 text-amber-700 border-amber-200',
            ],
            [
                'vendor' => 'Airblue',
                'code' => 'PA',
                'logo_badge' => 'bg-blue-600 text-white',
                'tickets_issued' => 615,
                'gross_amount' => 'PKR 22,800,000',
                'paid_amount' => 'PKR 18,500,000',
                'payable_due' => 'PKR 4,300,000',
                'due_date' => '18 Nov 2026',
                'status' => 'Pending Settlement',
                'status_color' => 'bg-amber-50 text-amber-700 border-amber-200',
            ],
            [
                'vendor' => 'AirSial',
                'code' => 'PF',
                'logo_badge' => 'bg-cyan-700 text-white',
                'tickets_issued' => 480,
                'gross_amount' => 'PKR 16,500,000',
                'paid_amount' => 'PKR 13,800,000',
                'payable_due' => 'PKR 2,700,000',
                'due_date' => '20 Nov 2026',
                'status' => 'Grace Period',
                'status_color' => 'bg-blue-50 text-blue-700 border-blue-200',
            ],
            [
                'vendor' => 'Emirates Airline',
                'code' => 'EK',
                'logo_badge' => 'bg-red-700 text-white',
                'tickets_issued' => 590,
                'gross_amount' => 'PKR 48,900,000',
                'paid_amount' => 'PKR 42,500,000',
                'payable_due' => 'PKR 6,400,000',
                'due_date' => '12 Nov 2026',
                'status' => 'Payment Due Soon',
                'status_color' => 'bg-rose-50 text-rose-700 border-rose-200',
            ],
            [
                'vendor' => 'Saudia (Saudi Arabian Airlines)',
                'code' => 'SV',
                'logo_badge' => 'bg-emerald-800 text-white',
                'tickets_issued' => 520,
                'gross_amount' => 'PKR 38,100,000',
                'paid_amount' => 'PKR 33,200,000',
                'payable_due' => 'PKR 4,900,000',
                'due_date' => '14 Nov 2026',
                'status' => 'Payment Due Soon',
                'status_color' => 'bg-rose-50 text-rose-700 border-rose-200',
            ],
            [
                'vendor' => 'FlyDubai',
                'code' => 'FZ',
                'logo_badge' => 'bg-orange-600 text-white',
                'tickets_issued' => 438,
                'gross_amount' => 'PKR 14,200,000',
                'paid_amount' => 'PKR 14,200,000',
                'payable_due' => 'PKR 0',
                'due_date' => 'Cleared',
                'status' => 'All Cleared',
                'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
        ];
    }

    /**
     * Get visa sales & processing performance report.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getVisaSalesReport(): array
    {
        return [
            [
                'category' => 'Umrah & Hajj E-Visa',
                'destination' => 'Saudi Arabia (Makkah & Madinah)',
                'visas_sold' => 385,
                'total_revenue' => 'PKR 28.5M',
                'approval_rate' => '99.4%',
                'icon' => 'kaaba',
                'color' => 'text-emerald-600 bg-emerald-50 border-emerald-200',
                'avg_processing' => '24 - 48 Hours',
                'trend' => '+32% Season Peak',
            ],
            [
                'category' => 'UAE 30/60 Days Tourist Visa',
                'destination' => 'Dubai / Abu Dhabi, UAE',
                'visas_sold' => 248,
                'total_revenue' => 'PKR 11.2M',
                'approval_rate' => '98.8%',
                'icon' => 'building',
                'color' => 'text-red-600 bg-red-50 border-red-200',
                'avg_processing' => '12 - 24 Hours',
                'trend' => '+18% Winter Safari',
            ],
            [
                'category' => 'Saudi Multiple Tourist eVisa',
                'destination' => 'Kingdom of Saudi Arabia',
                'visas_sold' => 112,
                'total_revenue' => 'PKR 6.7M',
                'approval_rate' => '99.0%',
                'icon' => 'passport',
                'color' => 'text-amber-600 bg-amber-50 border-amber-200',
                'avg_processing' => 'Instant eVisa',
                'trend' => '+14% Tourism Surge',
            ],
            [
                'category' => 'UK Standard Visitor & Schengen',
                'destination' => 'United Kingdom & European Union',
                'visas_sold' => 54,
                'total_revenue' => 'PKR 4.8M',
                'approval_rate' => '92.5%',
                'icon' => 'earth-europe',
                'color' => 'text-blue-600 bg-blue-50 border-blue-200',
                'avg_processing' => '15 Business Days',
                'trend' => '+9% Dossier Vetted',
            ],
            [
                'category' => 'Azerbaijan ASAN Fast-Track eVisa',
                'destination' => 'Baku, Azerbaijan',
                'visas_sold' => 43,
                'total_revenue' => 'PKR 1.2M',
                'approval_rate' => '100%',
                'icon' => 'bolt',
                'color' => 'text-indigo-600 bg-indigo-50 border-indigo-200',
                'avg_processing' => '3 Hours',
                'trend' => '+25% Snow Season',
            ],
        ];
    }

    /**
     * Get recent ticket bookings list.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getRecentBookings(): array
    {
        return [
            [
                'pnr' => 'EK-88912',
                'customer' => 'Muhammad Hamza',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Dubai (DXB)',
                'flight' => 'Emirates EK-607',
                'ticket_type' => 'Return Economy',
                'date' => '12 Nov 2026',
                'amount' => 'PKR 145,000',
                'vendor' => 'Emirates',
                'status' => 'Ticket Issued',
                'badge' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
            ],
            [
                'pnr' => 'PA-77412',
                'customer' => 'Fatima Zahra',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Karachi (KHI)',
                'flight' => 'Airblue PA-201',
                'ticket_type' => 'One Way Flex',
                'date' => '15 Nov 2026',
                'amount' => 'PKR 38,500',
                'vendor' => 'Airblue',
                'status' => 'Ticket Issued',
                'badge' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
            ],
            [
                'pnr' => 'SV-66109',
                'customer' => 'Tariq Mehmood',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Jeddah (JED)',
                'flight' => 'Saudia SV-735',
                'ticket_type' => 'Umrah Return',
                'date' => '20 Nov 2026',
                'amount' => 'PKR 210,000',
                'vendor' => 'Saudia',
                'status' => 'Processing GDS',
                'badge' => 'bg-blue-500/10 text-blue-600 border-blue-200',
            ],
            [
                'pnr' => 'PF-55102',
                'customer' => 'Bilal Siddiqui',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Islamabad (ISB)',
                'flight' => 'AirSial PF-121',
                'ticket_type' => 'Economy Classic',
                'date' => '22 Nov 2026',
                'amount' => 'PKR 42,000',
                'vendor' => 'AirSial',
                'status' => 'Ticket Issued',
                'badge' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
            ],
            [
                'pnr' => 'QR-19044',
                'customer' => 'Ayesha Malik',
                'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=100&auto=format&fit=crop&q=80',
                'destination' => 'London (LHR)',
                'flight' => 'Qatar Airways QR-007',
                'ticket_type' => 'Business Class',
                'date' => '01 Dec 2026',
                'amount' => 'PKR 580,000',
                'vendor' => 'Qatar Airways',
                'status' => 'Pending Payment',
                'badge' => 'bg-amber-500/10 text-amber-600 border-amber-200',
            ],
        ];
    }
}

