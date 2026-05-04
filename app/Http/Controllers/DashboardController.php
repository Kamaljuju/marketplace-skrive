<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman Dashboard utama
     */
    public function index() {
        $stats = [
            'products' => Product::count(),
            'orders'   => Order::count(),
            'pending'  => Order::where('status', 'pending')->count(),
            'users'    => User::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Tampilkan halaman Analytics & Metrics
     */
    public function analytics()
    {
        // 1. Hitung total revenue/pendapatan dari orderan yang sukses
        $revenue = Order::where('status', 'completed')->sum('total_price');

        // 2. Total items/products terjual (jumlah pesanan sukses)
        $totalItemsSold = Order::where('status', 'completed')->count();

        // 3. Rata-rata nilai orderan
        $avgOrderValue = $totalItemsSold > 0 ? ($revenue / $totalItemsSold) : 0;

        // 4. Conversion Rate (Pesanan Sukses / Jumlah Total Pengguna Terdaftar)
        $totalUsers = User::count();
        $conversionRate = $totalUsers > 0 ? round(($totalItemsSold / $totalUsers) * 100, 1) : 0;

        // 5. Data Chart Pendapatan Bulanan (6 bulan terakhir)
        $salesStream = Order::select(
                DB::raw('DATE_FORMAT(created_at, "%b %Y") as month'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('created_at', 'asc')
            ->take(6)
            ->get();

        $monthlyLabels = $salesStream->pluck('month')->toArray();
        $monthlyData = $salesStream->pluck('total')->toArray();

        // Data fallback jika database masih kosong
        if (empty($monthlyLabels)) {
            $monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May'];
            $monthlyData = [0, 0, 0, 0, 0];
        }

        // 6. Data Chart Distribusi Status Order
        $statusCounts = [
            Order::where('status', 'completed')->count(),
            Order::where('status', 'pending')->count()
        ];

        return view('admin.analytics', compact(
            'revenue', 'totalItemsSold', 'avgOrderValue', 'conversionRate',
            'monthlyLabels', 'monthlyData', 'statusCounts'
        ));
    }
}