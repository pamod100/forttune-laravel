@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Manage Testimonials')
@section('content')

<div class="panel">
  <div class="panel-header"><h2>All Feedback ({{ $testimonials->count() }})</h2></div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th>Message</th>
          <th>Rating</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($testimonials as $t)
        <tr>
          <td><strong>{{ $t->name }}</strong></td>
          <td>{{ $t->role ?? '-' }}</td>
          <td style="max-width:300px;">{{ Str::limit($t->message, 80) }}</td>
          <td>{{ str_repeat('★', $t->rating) }}</td>
          <td>
            @if($t->approved)
              <span style="color:green; font-weight:600;">✓ Approved</span>
            @else
              <span style="color:orange; font-weight:600;">⏳ Pending</span>
            @endif
          </td>
          <td style="display:flex; gap:0.5rem;">
            @if(!$t->approved)
            <form method="POST" action="{{ route('admin.testimonials.approve', $t) }}">
              @csrf
              <button type="submit" class="btn btn-sm" style="background:green; color:#fff;">Approve</button>
            </form>
            @endif
            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;">No feedback yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection