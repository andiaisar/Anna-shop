@extends('admin.layouts.layout')
@section('admin_page_title')
    Edit Attribute Dashboard
@endsection
@section('admin-layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Attribute</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-octagon-fill text-danger me-3 fs-4"></i>
                                <div>
                                    <strong class="text-danger">Oops! Something went wrong:</strong>
                                    <ul class="mb-0 mt-2 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                                <div>
                                    <strong class="text-success">Success!</strong> {{ session('success') }}
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('update.attribute', $attribute_info) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="attribute_value" class="fw-bold mb-2">Attribute Name</label>
                            <input type="text" name="attribute_value" id="name" class="form-control" value="{{ $attribute_info->attribute_value }}">
                        
                            <button type="submit" class="btn btn-primary w-100 mt-2">
                                Update Attribute
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection