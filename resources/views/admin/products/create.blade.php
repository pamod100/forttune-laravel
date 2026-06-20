@extends('layouts.admin')

@section('title', 'Add Product')
@section('page-title', 'Add New Product')

@section('content')

  <div class="panel">
    <div class="panel-header">
      <h2>Product Details</h2>
      <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">← Back to Products</a>
    </div>

    <div class="panel-body">
      <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- IMAGE UPLOAD -->
        <div class="form-group full">
          <label>Product Photo</label>
          <span class="hint">Upload any size photo — it will be automatically resized and converted to a fast-loading format.</span>
          <label class="image-upload-box" for="imageInput">
            <span id="uploadText">📷 Click to upload a photo</span>
            <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(event)" />
            <img id="imagePreview" style="display:none;" />
          </label>
        </div>

        <div class="form-grid">

          <div class="form-group">
            <label>Product Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. EliteBook 8 G1i — Ultra 7 14th Gen" required />
          </div>

          <div class="form-group">
            <label>Brand</label>
            <input type="text" name="brand" value="{{ old('brand') }}" placeholder="e.g. HP, Dell, Asus" />
          </div>

          <div class="form-group">
            <label>Category</label>
            <select name="category_id">
              <option value="">Select category</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Price (LKR) *</label>
            <input type="number" name="price" value="{{ old('price') }}" placeholder="e.g. 106000" step="0.01" min="0" required />
          </div>

          <div class="form-group">
            <label>Processor</label>
            <input type="text" name="processor" value="{{ old('processor') }}" placeholder="e.g. Intel Core i7 13th Gen" />
          </div>

          <div class="form-group">
            <label>RAM</label>
            <input type="text" name="ram" value="{{ old('ram') }}" placeholder="e.g. 16GB DDR4" />
          </div>

          <div class="form-group">
            <label>Storage</label>
            <input type="text" name="storage" value="{{ old('storage') }}" placeholder="e.g. 512GB SSD" />
          </div>

          <div class="form-group">
            <label>Display</label>
            <input type="text" name="display" value="{{ old('display') }}" placeholder="e.g. 15.6&quot; FHD" />
          </div>

          <div class="form-group">
            <label>Warranty</label>
            <input type="text" name="warranty" value="{{ old('warranty') }}" placeholder="e.g. 2 Years" />
          </div>

          <div class="form-group">
            <label>Stock Status *</label>
            <select name="stock_status" required>
              <option value="in_stock">In Stock</option>
              <option value="out_of_stock">Out of Stock</option>
              <option value="pre_order">Pre-Order</option>
            </select>
          </div>

          <div class="form-group">
            <label>Stock Quantity *</label>
            <input type="number" name="stock_qty" value="{{ old('stock_qty', 0) }}" min="0" required />
          </div>

          <div class="form-group full">
            <label>Description</label>
            <textarea name="description" rows="4" placeholder="Short description of the product…">{{ old('description') }}</textarea>
          </div>

          <div class="form-group">
            <label class="checkbox-row"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} /> Show on homepage (Featured)</label>
          </div>

          <div class="form-group">
            <label class="checkbox-row"><input type="checkbox" name="is_active" value="1" checked /> Active (visible on website)</label>
          </div>

        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save Product</button>
          <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const preview = document.getElementById('imagePreview');
    const text = document.getElementById('uploadText');
    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
    text.textContent = file.name;
  }
</script>
@endpush
