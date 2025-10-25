<x-app-layout>
    <div class="py-10 max-w-3xl mx-auto sm:px-6 lg:px-8 animate__animated animate__fadeInUp">
        {{-- Encabezado --}}
        <div class="bg-gradient-to-r from-indigo-500 to-indigo-700 rounded-t-2xl shadow-lg p-4 flex justify-center items-center text-white">
            <h2 class="text-2xl font-semibold tracking-wide">
                <i class="fa-solid fa-box"></i>
                 Nuevo Producto
            </h2>
        </div>

        {{-- Formulario --}}
        <form action="{{ route('products.store') }}" method="POST"
              class="bg-white border border-gray-100 shadow-xl rounded-b-2xl p-6 space-y-5 transition-transform transform hover:scale-[1.01]">
            @csrf

            {{-- Nombre --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 uppercase">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="mt-2 w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring focus:ring-cyan-200 transition"
                       placeholder="Ej: Laptop Lenovo ThinkPad" required>
                @error('name') 
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 uppercase">Descripción</label>
                <textarea name="description" id="description" rows="3"
                          class="mt-2 w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring focus:ring-cyan-200 transition"
                          placeholder="Describe las características principales...">{{ old('description') }}</textarea>
            </div>

            {{-- Precio y Stock en grid responsive --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 uppercase">Precio</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring focus:ring-cyan-200 transition"
                           placeholder="Ej: 599.99" required>
                    @error('price') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 uppercase">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring focus:ring-cyan-200 transition"
                           placeholder="Ej: 10" required>
                    @error('stock') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fa-solid fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
