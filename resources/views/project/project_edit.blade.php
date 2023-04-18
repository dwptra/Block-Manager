@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('project.update', $project['id']) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-username">Project Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="project_name" class="form-control" id="val-username" placeholder="Enter a Project Name" value="{{ $project['project_name'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Project Manager <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="project_manager" class="form-control" id="val-email" placeholder="Enter Project Manager" value="{{ $project['project_manager'] }}" readonly>
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection