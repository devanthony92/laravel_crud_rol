<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800 animate__animated animate__fadeInDown">
            ✏️ {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8 animate__animated animate__fadeInUp">
        <form action="{{ route('products.update', $product) }}" method="POST"
              class="bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden transition-transform transform hover:scale-[1.01]">
            @csrf
            @method('PUT')

            {{-- Encabezado visual --}}
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4 text-white flex justify-between items-center">
                <h3 class="text-2xl font-semibold">Actualizar Datos del Producto</h3>
                <span class="px-3 py-1 text-sm bg-white/20 rounded-full">ID: {{ $product->id }}</span>
            </div>

            {{-- Campos del formulario --}}
            <div class="p-6 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 uppercase">Nombre</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', $product->name) }}"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                           required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 uppercase">Descripción</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                              placeholder="Describe brevemente el producto...">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 uppercase">Precio</label>
                        <input type="number" step="0.01" name="price" id="price"
                               value="{{ old('price', $product->price) }}"
                               class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                               required>
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-semibold text-gray-700 uppercase">Stock</label>
                        <input type="number" name="stock" id="stock"
                               value="{{ old('stock', $product->stock) }}"
                               class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                               required>
                    </div>
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fa-solid fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
