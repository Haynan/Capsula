<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->when($request->filled('q'), fn ($query) => $query->where('name', 'like', '%'.$request->string('q').'%'))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.produtos.index', [
            'products' => $products,
        ]);
    }

    public function create(): View
    {
        return view('admin.produtos.create', [
            'product' => new Product(['is_active' => true, 'is_featured' => false]),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $product = Product::query()->create($request->validated());

        return redirect()->route('admin.products.edit', $product)->with('status', 'Produto cadastrado com sucesso.');
    }

    public function edit(Product $product): View
    {
        return view('admin.produtos.edit', [
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('admin.products.edit', $product)->with('status', 'Produto atualizado com sucesso.');
    }
}
