<?php
// app/Http/Controllers/Admin/ProductController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imagePath = $request->file('image')->store('product_images', 'public');

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            // Elimina la imagen anterior si se actualiza
            Storage::disk('public')->delete($product->image);

            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->update(['image' => $imagePath]);
        }

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        // Elimina la imagen asociada al producto antes de eliminar el producto
        Storage::disk('public')->delete($product->image);

        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
