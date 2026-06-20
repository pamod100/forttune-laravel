<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * List all products with simple search + category filter.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the "add product" form — isolated empty data boxes per the proposal
     * (Brand, Price, RAM, Warranty etc. as separate fields, not one text blob).
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Save a new product. Handles image upload + auto .webp conversion.
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->processAndStoreImage($request->file('image'));
        }

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Show the "edit product" form, pre-filled.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update an existing product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product->id);

        if ($request->hasFile('image')) {
            // Remove old image file to avoid clutter
            if ($product->image) {
                @unlink(public_path('uploads/products/' . $product->image));
            }
            $validated['image'] = $this->processAndStoreImage($request->file('image'));
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            @unlink(public_path('uploads/products/' . $product->image));
        }

        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    /**
     * Quick toggle for stock status / active status from the list view
     * (so staff don't need to open the full edit form just to mark "out of stock").
     */
    public function toggleStock(Product $product)
    {
        $product->stock_status = $product->stock_status === 'in_stock' ? 'out_of_stock' : 'in_stock';
        $product->save();

        return back()->with('success', 'Stock status updated.');
    }

    /**
     * Shared validation rules for store() and update().
     */
    private function validateProduct(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'processor' => 'nullable|string|max:150',
            'ram' => 'nullable|string|max:50',
            'storage' => 'nullable|string|max:100',
            'display' => 'nullable|string|max:100',
            'warranty' => 'nullable|string|max:100',
            'stock_status' => 'required|in:in_stock,out_of_stock,pre_order',
            'stock_qty' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max raw upload
        ]);
    }

    /**
     * THE AUTOMATED IMAGE OPTIMIZATION PIPELINE (from the proposal):
     * Staff upload any raw photo (jpg/png, any size) and this resizes it
     * to a sensible max width and converts it to lightweight .webp —
     * protecting site speed without staff needing to do anything.
     */
    private function processAndStoreImage($file): string
    {
        $filename = Str::random(20) . '.webp';
        $destination = public_path('uploads/products/' . $filename);

        $image = Image::make($file);

        // Resize down if too large, keep aspect ratio, never upscale
        $image->resize(900, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Convert to webp at 80% quality — good balance of size vs sharpness
        $image->encode('webp', 80);
        $image->save($destination);

        return $filename;
    }
}
