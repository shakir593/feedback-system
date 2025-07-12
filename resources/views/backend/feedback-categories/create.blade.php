@extends('backend.layout.layout')
@php
    $title='Add Product Category';
    $subTitle = 'Add Product Category';
    $script = '<script>
                    let table = new DataTable("#dataTable");
               </script>';
@endphp

@section('content')

    <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Add Product Category</h6>
                    
                </div>
                <div class="card-body">
                    <form method = "post" action = "{{ route('product-category.store') }}">
                        <div class="row gy-3">
                            @csrf
                            <div class="col-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Status</label>
                                <div class="form-switch switch-success d-flex align-items-center gap-3">
                                    <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" name = "status" role="switch" value = "1" id="horizontal3">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal3">Active</label>
                                </div>
                                 @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <button type = "submit" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                                    Save Category
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- card end -->
        </div>
    </div>
            
@endsection