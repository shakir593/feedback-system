@extends('backend.layout.layout')
@php
    $title='Add New Product';
    $subTitle = 'Add New Product';
    $script = '<script>
                    let table = new DataTable("#dataTable");
                    const fileInputMultiple = document.getElementById("upload-file-multiple");
    const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

               </script>';
@endphp

@section('content')

    <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Add New Feeeback</h6>
                    
                </div>
                <div class="card-body">
                    <form method = "post" action = "{{ route('feedback.store') }}" enctype= "multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-6">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Category</label>
                                <select class="form-control radius-8 form-select @error('feedback_category_id') is-invalid @enderror" name = "feedback_category_id" id="editcountry">
                                    @foreach($feedback_categories as $feedback_category)
                                    <option value = "{{ $feedback_category->id }}" >{{$feedback_category->name}}</option>
                                    @endforeach
                                </select>
                                @error('feedback_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                        
                            </div>
                         
                            <div class="col-12">
                                <label class="form-label">Detailed Description</label>
                                <textarea name="detailed_description" class="form-control @error('detailed_description') is-invalid @enderror" rows="4" cols="50" placeholder="Enter a description..."></textarea>
                                @error('detailed_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class = "col-4">
                                <button type = "submit" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                                    Save Feedback
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
            
@endsection

