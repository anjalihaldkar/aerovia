@extends('layouts.admin')

@section('page_title', 'Contact Leads')
@section('page_subtitle', 'View and manage inquiries sent from the frontend contact form')

@section('content')
      @if(session('success'))
        <div class="alert alert-success" style="background-color: rgba(16, 185, 129, 0.2); border: 1px solid rgb(16, 185, 129); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
          {{ session('success') }}
        </div>
      @endif

      <!-- Leads list table panel -->
      <div class="table-panel">
        <div class="table-toolbar">
          <form action="{{ route('admin.leads.index') }}" method="GET" style="display: flex; gap: 0.75rem; width: 100%; align-items: center; flex-wrap: wrap;">
            <div class="search-wrapper" style="flex: 1; max-width: 400px; margin: 0; position: relative;">
              <input type="text" name="search" class="search-input"
                placeholder="Search leads by name, email, message..." value="{{ $search ?? '' }}">
              <i class="fas fa-search" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            </div>
            <button type="submit" class="btn btn-primary" style="margin: 0; padding: 0.5rem 1.25rem; font-size: 0.85rem;"><i class="fas fa-search"></i> Search</button>
            @if(!empty($search))
              <a href="{{ route('admin.leads.index') }}" class="btn-add-item" style="margin: 0; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; justify-content: center; height: 38px; box-sizing: border-box; background: rgba(255, 255, 255, 0.1); color: white;"><i class="fas fa-undo" style="margin-right: 0.4rem;"></i> Clear</a>
            @endif
          </form>

          <div class="tours-count" id="leads-count-display">
            Showing {{ count($leads) }} total entries
          </div>
        </div>

        <div class="responsive-table-container">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Traveler Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Subject / Query</th>
                <th style="width: 35%;">Message</th>
                <th>Received Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($leads as $lead)
              <tr>
                <td><strong class="tour-name-cell">{{ $lead->first_name }} {{ $lead->last_name }}</strong></td>
                <td class="tour-route-cell">{{ $lead->email }}</td>
                <td>{{ $lead->phone }}</td>
                <td>
                  <span style="background-color: rgba(249, 115, 22, 0.15); color: rgb(249, 115, 22); padding: 0.25rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; display: inline-block;">
                    {{ $lead->subject }}
                  </span>
                </td>
                <td style="font-size: 0.85rem; line-height: 1.4; color: var(--text-muted);">{{ $lead->message }}</td>
                <td>{{ $lead->created_at->format('M d, Y h:i A') }}</td>
                <td>
                  <div class="table-actions">
                    <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this contact lead? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete-btn" title="Delete Lead"><i class="fas fa-trash"></i></button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" style="text-align: center; color: var(--text-muted);">No contact leads available.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="table-pagination">
          <div>Showing page 1 of 1 ({{ count($leads) }} total items)</div>
          <div class="pagination-controls">
            <button class="page-link-btn" disabled><i class="fas fa-chevron-left"></i></button>
            <button class="page-link-btn active">1</button>
            <button class="page-link-btn" disabled><i class="fas fa-chevron-right"></i></button>
          </div>
        </div>
      </div>
@endsection
