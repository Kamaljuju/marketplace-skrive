<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private function checkAdmin() {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    public function index() {
        if (!$this->checkAdmin()) return redirect('/')->with('error', 'Akses ditolak!');
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        if (!$this->checkAdmin()) return redirect('/')->with('error', 'Akses ditolak!');
        return view('admin.products.create');
    }

    public function store(Request $request) {
        if (!$this->checkAdmin()) return redirect('/')->with('error', 'Akses ditolak!');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required', 
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:20480',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id) {
        if (!$this->checkAdmin()) return redirect('/')->with('error', 'Akses ditolak!');
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id) {
        if (!$this->checkAdmin()) return redirect('/')->with('error', 'Akses ditolak!');
        $product = Product::findOrFail($id);
        
        $request->validate(['name' => 'required', 'price' => 'required|numeric', 'stock' => 'required|numeric', 'category' => 'required', 'description' => 'required']);

        if ($request->hasFile('image')) {
            if(file_exists(public_path('uploads/'.$product->image))) unlink(public_path('uploads/'.$product->image));
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $product->image = $imageName;
        }

        $product->update($request->only(['name', 'price', 'stock', 'category', 'description']));
        return redirect()->route('admin.products.index')->with('success', 'Produk diupdate!');
    }

    public function destroy($id) {
        if (!$this->checkAdmin()) return redirect('/')->with('error', 'Akses ditolak!');
        $product = Product::findOrFail($id);
        if(file_exists(public_path('uploads/'.$product->image))) unlink(public_path('uploads/'.$product->image));
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk dihapus!');
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}