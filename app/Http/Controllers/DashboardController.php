<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the main AR Holidays dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $kpis = [
            [
                'title' => 'Total Bookings',
                'value' => '2,845',
                'change' => '+14.2%',
                'trend' => 'up',
                'period' => 'vs last month',
                'icon' => 'plane-departure',
                'color' => 'red',
                'gradient' => 'from-red-600 to-rose-700',
                'bg_light' => 'bg-red-50 text-red-600',
            ],
            [
                'title' => 'Active Travelers',
                'value' => '1,420',
                'change' => '+8.7%',
                'trend' => 'up',
                'period' => 'in 18 countries',
                'icon' => 'users',
                'color' => 'dark',
                'gradient' => 'from-slate-800 to-slate-950',
                'bg_light' => 'bg-slate-100 text-slate-800',
            ],
            [
                'title' => 'Monthly Revenue',
                'value' => '$184,250',
                'change' => '+22.5%',
                'trend' => 'up',
                'period' => 'PKR ~51.2M',
                'icon' => 'coins',
                'color' => 'red',
                'gradient' => 'from-red-600 to-red-800',
                'bg_light' => 'bg-red-50 text-red-600',
            ],
            [
                'title' => 'Holiday Packages',
                'value' => '384 Sold',
                'change' => '98.6%',
                'trend' => 'up',
                'period' => 'customer satisfaction',
                'icon' => 'umbrella-beach',
                'color' => 'amber',
                'gradient' => 'from-amber-500 to-amber-700',
                'bg_light' => 'bg-amber-50 text-amber-600',
            ],
        ];

        $recentBookings = [
            [
                'id' => 'BKG-9921',
                'pnr' => 'EK-88912',
                'customer' => 'Muhammad Hamza',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Dubai, UAE',
                'destination_code' => 'DXB',
                'flight' => 'Emirates EK-607',
                'date' => '12 Nov 2026',
                'package' => 'Dubai 5D Luxury Safari',
                'amount' => '$2,450',
                'status' => 'Confirmed',
                'badge' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
            ],
            [
                'id' => 'BKG-9920',
                'pnr' => 'TK-77412',
                'customer' => 'Fatima Zahra',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Baku, Azerbaijan',
                'destination_code' => 'GYD',
                'flight' => 'Azerbaijan Airlines J2-054',
                'date' => '15 Nov 2026',
                'package' => 'Baku Winter Wonder 6D',
                'amount' => '$1,850',
                'status' => 'Ticketed',
                'badge' => 'bg-blue-500/10 text-blue-600 border-blue-200',
            ],
            [
                'id' => 'BKG-9919',
                'pnr' => 'QR-19044',
                'customer' => 'Bilal Siddiqui',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80',
                'destination' => 'London, UK',
                'destination_code' => 'LHR',
                'flight' => 'Qatar Airways QR-007',
                'date' => '20 Nov 2026',
                'package' => 'London Holiday & Shopping',
                'amount' => '$3,800',
                'status' => 'Processing',
                'badge' => 'bg-amber-500/10 text-amber-600 border-amber-200',
            ],
            [
                'id' => 'BKG-9918',
                'pnr' => 'SV-66109',
                'customer' => 'Usman Ghafoor',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Jeddah / Makkah',
                'destination_code' => 'JED',
                'flight' => 'Saudia SV-735',
                'date' => '01 Dec 2026',
                'package' => 'Umrah Deluxe Executive',
                'amount' => '$5,600',
                'status' => 'Confirmed',
                'badge' => 'bg-emerald-500/10 text-emerald-600 border-emerald-200',
            ],
            [
                'id' => 'BKG-9917',
                'pnr' => 'MH-44021',
                'customer' => 'Ayesha Malik',
                'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=100&auto=format&fit=crop&q=80',
                'destination' => 'Kuala Lumpur',
                'destination_code' => 'KUL',
                'flight' => 'Malaysia Airlines MH-156',
                'date' => '22 Dec 2026',
                'package' => 'Malaysia & Langkawi 7D',
                'amount' => '$1,950',
                'status' => 'Pending Visa',
                'badge' => 'bg-purple-500/10 text-purple-600 border-purple-200',
            ],
        ];

        $packages = [
            [
                'id' => 1,
                'name' => 'Dubai Luxury Desert Safari & Burj',
                'days' => '5 Days / 4 Nights',
                'image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&auto=format&fit=crop&q=80',
                'price' => '$799',
                'original_price' => '$950',
                'badge' => 'Bestseller',
                'rating' => '4.9 (124 reviews)',
                'highlights' => ['Desert Safari with BBQ', 'Burj Khalifa 124th Floor', 'Dubai Marina Dhow Cruise', 'Airport Transfers'],
            ],
            [
                'id' => 2,
                'name' => 'Baku Winter City & Shahdag Mountain',
                'days' => '6 Days / 5 Nights',
                'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=600&auto=format&fit=crop&q=80',
                'price' => '$650',
                'original_price' => '$800',
                'badge' => 'Trending',
                'rating' => '4.8 (98 reviews)',
                'highlights' => ['Baku Old City & Flame Towers', 'Shahdag Snow Resort Cable Car', 'Gabala Lake Tour', 'Visa Assistance'],
            ],
            [
                'id' => 3,
                'name' => 'Istanbul & Cappadocia Hot Air Balloon',
                'days' => '7 Days / 6 Nights',
                'image' => 'https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?w=600&auto=format&fit=crop&q=80',
                'price' => '$1,190',
                'original_price' => '$1,350',
                'badge' => 'Hot Deal',
                'rating' => '5.0 (180 reviews)',
                'highlights' => ['Hot Air Balloon Flight', 'Bosphorus Dinner Cruise', 'Blue Mosque & Hagia Sophia', 'Cave Hotel Experience'],
            ],
            [
                'id' => 4,
                'name' => 'Maldives Honeymoon Water Villa Escape',
                'days' => '5 Days / 4 Nights',
                'image' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=600&auto=format&fit=crop&q=80',
                'price' => '$1,890',
                'original_price' => '$2,200',
                'badge' => 'Luxury VIP',
                'rating' => '4.9 (84 reviews)',
                'highlights' => ['Private Overwater Villa', 'All-Inclusive Dine Around', 'Speedboat Airport Transfer', 'Complimentary Couple Spa'],
            ],
        ];

        return view('welcome', [
            'kpis' => $kpis,
            'recentBookings' => $recentBookings,
            'packages' => $packages,
        ]);
    }
}

