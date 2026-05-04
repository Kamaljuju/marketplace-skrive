<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Tampilkan data orderan masuk khusus di sisi admin
     */
    public function adminOrders()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Konfirmasi orderan pending menjadi completed
     */
    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'pending') {
            $order->update([
                'status' => 'completed'
            ]);

            return redirect()->back()->with('success', "Order #INV-{$order->id}-X berhasil dikonfirmasi dan diselesaikan.");
        }

        return redirect()->back()->with('error', "Order sudah tidak berstatus pending.");
    }

    /**
     * Mengubah status pesanan secara fleksibel dari sisi Admin
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', "Status pesanan #ORD-{$order->id} berhasil diubah menjadi " . strtoupper($request->status));
    }

    /**
     * Hapus/batalkan pesanan dari sistem admin
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', "Data order berhasil dihapus dari sistem.");
    }

    /**
     * Fitur Pembeli: Tampilkan Riwayat Transaksi Pribadi
     */
    public function history()
    {
        $orders = Order::where('user_id', auth()->id())->with('product')->latest()->get();
        
        // Mengarah ke file history.blade.php di folder views
        return view('history', compact('orders')); 
    }

    /**
     * Fitur Pembeli: Form Checkout
     */
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Fitur Pembeli: Simpan Pesanan Baru (Checkout Process)
     */
    public function process(Request $request)
    {
        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'total_price'      => 'required|numeric',
            'shipping_address' => 'required|string',
            'payment_method'   => 'required|string'
        ]);

        $order = Order::create([
            'user_id'          => auth()->id(),
            'product_id'       => $request->product_id,
            'total_price'      => $request->total_price,
            'address'          => $request->shipping_address, // Simpan ke kolom address
            'payment_method'   => $request->payment_method,
            'status'           => 'pending'
        ]);

        return redirect()->route('checkout.success', $order->id);
    }

    /**
     * Fitur Pembeli: Success Page
     */
    public function success($id)
    {
        $order = Order::with('product')->findOrFail($id);
        // Diubah langsung memanggil file view 'success.blade.php' yang ada di folder views
        return view('success', compact('order'));
    }
}