@extends('layout')
@section('content')
<div class="container-fluid mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::get('createPage'))
                <div class="alert alert-primary alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Fail</strong> {{ Session::get('createPage')}}
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Page List</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="/createPage{{ $project->id }}">Create Page</a>
                            <a class="btn btn-primary ml-1" href="/dashboard">Back</a>
                        </div>
                        <hr>
                        <p><b class="pr-4">Project Name</b>: {{ $project->project_name }}</p>
                        <p><b class="pr-2">Project Manager</b>: {{ $project->project_manager }}</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Page Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pageDB as $page)
                                    <tr>
                                        <td>{{ $page->page_name }}</td>
                                        <td>{{ $page->status }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/page{{ $project->id }}" class="mr-1">See Pages | </a>
                                                <a href="/page{{ $project->id }}" class="mr-1">Edit | </a>
                                                <form action="{{ route('page.delete', $page['id']) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0">Delete</button>
                                                </form>
                                            </div>
                                        </td>                                                                               
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">No pages found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
