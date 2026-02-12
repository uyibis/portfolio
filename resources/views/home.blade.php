@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-2">
        <a href="{{ route('index') }}" class="text-green-600 no-underline">
            ← Back
        </a>
    </div>

    <div class="mt-4">
        <h2 class="h4 mb-1">Manage Portfolio Projects</h2>
        <p class="text-muted">Dashboard: create, publish/unpublish, edit, and delete projects shown on your portfolio.</p>
    </div>
</div>

<div class="container mt-5">
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted small">Total projects</div>
                    <div class="h3 mb-0">{{ $stats['total'] ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted small">Published</div>
                    <div class="h3 mb-0">{{ $stats['published'] ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted small">Drafts</div>
                    <div class="h3 mb-0">{{ $stats['drafts'] ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h3 class="h5 mb-0">Your Projects</h3>
        <a class="btn btn-primary" href="{{ route('projects.create') }}">New Project</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Updated</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($projects ?? collect()) as $p)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $p->title }}</div>
                        <div class="text-muted small">Slug: {{ $p->slug }}</div>
                        @if(is_array($p->stacks ?? null) && count($p->stacks))
                        <div class="text-muted small">Stack: {{ implode(', ', $p->stacks) }}</div>
                        @endif
                    </td>
                    <td>
                        @if($p->publish)
                        <span class="badge bg-success">Published</span>
                        @else
                        <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td>{{ $p->views ?? 0 }}</td>
                    <td class="text-muted small">{{ optional($p->updated_at)->diffForHumans() }}</td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-2 flex-wrap justify-content-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('projects.edit', $p->id) }}">Edit</a>
                            @if($p->publish)
                                <a class="btn btn-sm btn-outline-success" href="{{ route('projects.show', $p->slug) }}"
                                target="_blank" rel="noopener">View</a>
                            @endif

                                <form action="{{ route('projects.togglePublish', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                    {{ $p->publish ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>

                                <form action="{{ route('projects.destroy', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No projects yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(($projects ?? null) && method_exists($projects, 'links'))
    <div class="mt-3">{{ $projects->links() }}</div>
    @endif
</div>
@endsection
