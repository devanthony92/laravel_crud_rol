<x-app-layout> 
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8  animate__animated animate__fadeInDown">
        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class=" mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                <i class="fa-solid fa-circle-check mr-2"></i>    
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Botón de nuevo producto --}}
        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-bold leading-tight text-gray-800">
                🛍️{{ __('Gestión de Productos') }}
            </h2>
            @can('create products')
                <a href="{{ route('products.create') }}" 
                class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 text-white font-semibold py-2 px-5 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Nuevo Producto
                </a>
            @endcan
        </div>
        

        {{-- 📱 Modo móvil: tarjetas --}}
        <div class="md:hidden space-y-4">
            @forelse ($products as $product)
                <div class="bg-white shadow-md rounded-lg p-4 border border-gray-100 hover:shadow-lg transition">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                        <span class="text-indigo-600 font-bold">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($product->description, 80) }}</p>
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span>Stock: {{ $product->stock }}</span>
                        <div class="flex space-x-3">
                            <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @can('edit products')
                                <a href="{{ route('products.edit', $product) }}" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            @endcan
                            @can('delete products')
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-6">No hay productos registrados.</p>
            @endforelse
        </div>

        {{-- 💻 Modo escritorio: tabla --}}
        <div class="hidden md:block overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-100">
            <table class="min-w-full border-collapse">
                <thead class="bg-gradient-to-r from-indigo-100 to-blue-100 text-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($products as $product)
                        <tr class="border-t hover:bg-indigo-50 transition-colors duration-200">
                            <td class="px-6 py-3">{{ $product->id }}</td>
                            <td class="px-6 py-3 font-medium">{{ $product->name }}</td>
                            <td class="px-6 py-3">{{ Str::limit($product->description, 50) }}</td>
                            <td class="px-6 py-3 font-semibold text-indigo-700">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-3">{{ $product->stock }}</td>
                            
                                <td class="px-6 py-3 text-right space-x-2">
                                    <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:text-blue-800 transition">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @can('edit products')
                                        <a href="{{ route('products.edit', $product) }}" class="text-yellow-500 hover:text-yellow-600 transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan
                                    @can('delete products')
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endcan
                                    @if($product->deleted_at)
                                    @can('restore products')
                                        <form action="{{ route('products.restore', $product->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('¿Seguro que deseas restaurar este producto?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="text-green-600 hover:text-green-700" title="Restaurar">
                                                    <i class="fa-solid fa-recycle"></i>
                                                </button>
                                        </form>
                                    @endcan
                                    @endif
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                <i class="fa-solid fa-box-open text-gray-400 text-3xl mb-2"></i>
                                <p>No hay productos registrados.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
