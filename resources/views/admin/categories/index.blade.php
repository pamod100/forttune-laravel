@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Manage Categories')

@section('content')

  <div style="display:grid; grid-template-columns: 1fr 1.6fr; gap:1.5rem; align-items:start;">

    <!-- ADD CATEGORY -->
    <div class="panel">
      <div class="panel-header"><h2>Add Category</h2></div>
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.categories.store') }}">
          @csrf
          <div class="form-group">
            <label>Category Name *</label>
            <input type="text" name="name" placeholder="e.g. Laptops & Notebooks" required />
          </div>
          <div class="form-group">
            <label>Icon (emoji)</label>
            <input type="text" name="icon" placeholder="💻" maxlength="10" />
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;">Add Category</button>
        </form>
      </div>
    </div>

    <!-- LIST -->
    <div class="panel">
      <div class="panel-header"><h2>All Categories ({{ $categories->count() }})</h2></div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Icon</th><th>Name</th><th>Products</th><th>Actions</th></tr></thead>
          <tbody>
            @forelse ($categories as $cat)
              <tr>
                <td style="font-size:1.3rem;">{{ $cat->icon ?: '📦' }}</td>
                <td><strong>{{ $cat->name }}</strong></td>
                <td>{{ $cat->products_count }}</td>
                <td>
                  <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category? Products in it will become uncategorized.');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="4" style="text-align:center; color:var(--text-light);">No categories yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>

@endsection
