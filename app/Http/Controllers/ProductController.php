<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Controlador de productos.
     * Gestiona el CRUD de productos con control de permisos.
     */
    public function __construct()
    {
        //Requiere autenticación y permisos específicos para cada acción
        $this->middleware('auth');
        $this->middleware('permission:view products')->only(['index', 'show']);
        $this->middleware('permission:create products')->only(['create', 'store']);
        $this->middleware('permission:edit products')->only(['edit', 'update']);
        $this->middleware('permission:delete products')->only(['destroy']);
        $this->middleware('permission:restore products')->only(['restore']);
    }

    /**
     * Muestra la lista de productos (incluye eliminados).
     */
    public function index()
    {
        // $products = Product::withTrashed()->latest()->paginate(10);
        if (auth()->user()->hasRole('admin')) {
        $products = Product::withTrashed()->paginate(10);
        } else {
        $products = Product::whereNull('deleted_at')->paginate(10);
    }
        return view('products.index', compact('products'));
    }

    /**
     * Muestra los detalles de un producto específico.
     */
        public function show($id)
    {
        // Busca también entre los eliminados
        $product = Product::withTrashed()->find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Producto no encontrado.');
        }

        return view('products.show', compact('product'));
    }
    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create($request->only('name', 'description', 'price', 'stock'));
        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->only('name', 'description', 'price', 'stock'));
        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto (soft delete).
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado.');
    }

    /**
     * Restaura un producto eliminado.
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product && $product->trashed()) {
            $product->restore();
            return redirect()->route('products.index')->with('success', 'Producto restaurado correctamente.');
        }
        return redirect()->route('products.index')->with('error', 'Producto no encontrado o no está eliminado.');
    }

    /**
     * Elimina permanentemente un producto.
     */
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto eliminado permanentemente.');
    }
}
