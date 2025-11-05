<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $products['dataProducts'] = Products::all();
        return view('admin.products.index', $products);
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        $products = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ];

        Products::create($products);

        return redirect()->route('products.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(string $id)
    {
    $product = Products::findOrFail($id);
    return view('admin.products.edit', compact('product'));
}

    /**
     * Mengupdate produk berdasarkan ID.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        $products = Products::findOrFail($id);

        $products->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Menghapus produk berdasarkan ID.
     */
    public function destroy(string $id)
    {
        $products = Products::findOrFail($id);
        $products->delete();

        return redirect()->route('products.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
