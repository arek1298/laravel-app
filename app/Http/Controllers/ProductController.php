<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Guardar la información en la base de datos
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        // Guardar la imagen
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;

        $product->save();

        return redirect('/admin/product/create')->with('success', 'Producto agregado exitosamente.');
    }
}