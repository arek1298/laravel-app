@extends('layouts.app')


@section('title', 'Home')

@section('content')

<h1 class="text-5xl text-center pt-24"></h1>
<form action="" method="post" enctype="multipart/form-data" class="mb-8">
    @csrf
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-600">Nombre</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full">
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-600">Descripción</label>
            <textarea name="description" id="description" class="mt-1 p-2 border rounded-md w-full"></textarea>
        </div>
        <div>
            <label for="price" class="block text-sm font-medium text-gray-600">Precio</label>
            <input type="number" name="price" id="price" class="mt-1 p-2 border rounded-md w-full">
        </div>
        <div>
            <label for="image" class="block text-sm font-medium text-gray-600">Imagen</label>
            <input type="file" name="image" id="image" class="mt-1 p-2 border rounded-md w-full">
        </div>
    </div>
    <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md">Agregar Producto</button>
</form>
          
@endsection