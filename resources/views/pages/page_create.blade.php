@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Create Page</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><b>Dashboard</b></div>
                    <div class="breadcrumb-item"><a href="{{ route('project') }}">Project</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('page', $project->id) }}">Page</a></div>
                    <div class="breadcrumb-item text-muted">Create</div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button> <strong>Error:</strong>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </div>
                            @endif
                            <form class="form-valide" action="{{ route('page_create.post', $project->id) }}"
                                method="post">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-1">Save Page</button>
                                    <a class="btn btn-danger" href="{{ route('page', $project->id) }}">Back</a>
                                </div>
                                <hr>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-4 col-form-label">Project Name</label>
                                    <div class="col-lg-6">
                                        <span>: {{ $project->project_name }}</span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-lg-4 col-form-label">Project Manager</label>
                                    <div class="col-lg-6">
                                        <span>: {{ $project->projectManager->name }}</span>
                                    </div>
                                </div>
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-page-name">Page Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input name="page_name" type="text" class="form-control" id="val-page-name"
                                            name="val-page-name" placeholder="Enter page-name.."
                                            value="{{ old('page_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-note">Note <span
                                            class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea name="note" class="form-control" id="val-note" name="val-note"
                                            rows="5" placeholder="Not Required">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Status <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control selectric" aria-label="Default select example"
                                            name="status" value="{{ old('status') }}">
                                            <option value="On Progress">On Progress</option>
                                            <option value="On Review">On Review</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Declined">Declined</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection
