<!-- resources/views/admin/edit.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>

        <!-- Formulario de edición -->
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="mt-1 p-2 border rounded-md w-full">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-600">Descripción</label>
                    <textarea name="description" id="description" class="mt-1 p-2 border rounded-md w-full">{{ old('description', $product->description) }}</textarea>
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-600">Precio</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="mt-1 p-2 border rounded-md w-full">
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-600">Imagen Actual</label>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover mb-4">
                    <label for="new_image" class="block text-sm font-medium text-gray-600">Nueva Imagen</label>
                    <input type="file" name="new_image" id="new_image" class="mt-1 p-2 border rounded-md w-full">
                </div>
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md">Actualizar Producto</button>
        </form>
    </div>

</body>
</html>
