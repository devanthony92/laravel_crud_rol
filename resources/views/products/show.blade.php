<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800 animate__animated animate__fadeInDown">
            🧾 {{ __('Detalle del Producto') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8 animate__animated animate__fadeInUp">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 transition-transform transform hover:scale-[1.01]">

            {{-- Encabezado del producto --}}
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4 text-white flex justify-between items-center">
                <h3 class="text-2xl font-semibold">{{ $product->name }}</h3>
                <span class="px-3 py-1 text-sm bg-white/20 rounded-full">
                    ID: {{ $product->id }}
                </span>
            </div>

            {{-- Contenido principal --}}
            <div class="p-6 space-y-5">
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-semibold">💰 Precio</p>
                        <p class="text-xl font-bold text-indigo-700">${{ number_format($product->price, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-semibold">📦 Stock</p>
                        <p class="text-xl font-bold text-blue-700">{{ $product->stock }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">📝 Descripción</p>
                    <p class="text-gray-700 leading-relaxed mt-1">
                        {{ $product->description ?: 'Sin descripción disponible.' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">⚙️ Estado</p>
                    @if ($product->deleted_at)
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                            <i class="fa-solid fa-xmark"></i> Eliminado
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                            <i class="fa-solid fa-circle-check"></i> Activo
                        </span>
                    @endif
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 flex flex-col sm:flex-row gap-3 sm:justify-between sm:items-center">
                <div class="text-gray-500 text-sm">
                    Última actualización: {{ $product->updated_at->format('d/m/Y H:i') }}
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fa-solid fa-arrow-left"></i> Volver
                    </a>

                    @can('edit products')
                        <a href="{{ route('products.edit', $product) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
