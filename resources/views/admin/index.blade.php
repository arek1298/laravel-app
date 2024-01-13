<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>

        <!-- Formulario para agregar nuevos productos -->
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data" class="mb-8">
            @csrf
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

        <!-- Tabla para mostrar productos existentes -->
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nombre</th>
                    <th class="py-2 px-4 border-b">Descripción</th>
                    <th class="py-2 px-4 border-b">Precio</th>
                    <th class="py-2 px-4 border-b">Imagen</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->description }}</td>
                        <td class="py-2 px-4 border-b">${{ $product->price }}</td>
                        <td class="py-2 px-4 border-b">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover">
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500">Editar</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>