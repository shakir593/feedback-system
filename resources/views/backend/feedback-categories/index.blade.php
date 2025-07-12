@extends('backend.layout.layout')
@php
    $title='Feedback Categories';
    $subTitle = 'Basic Table';
    $script = '<script>
                    let table = new DataTable("#dataTable");
                     $(".remove-button").on("click", function() {
                        $(this).closest(".alert").addClass("d-none")
                    });
               </script>';
@endphp

@section('content')

            <div class="card basic-data-table">
                <div class="card-header d-flex align-items-center flex-wrap gap-3 justify-content-between">
                    <h5 class="card-title mb-0">Feedback Categories</h5>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success  bg-primary-50 text-success-600 border-success-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between my-2" role="alert">
                            {{ Session::get('success') }}
                            <button class="remove-button text-success-600 text-xxl line-height-1">
                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('failed'))
                        <div class="alert alert-danger bg-danger-50 text-danger-600 border-danger-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between my-2" role="alert">
                            {{ Session::get('failed') }}
                            <button class="remove-button text-danger-600 text-xxl line-height-1">
                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                            </button>
                        </div>
                    @endif
                    <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            S.L
                                        </label>
                                    </div>
                                </th>
                                <th scope="col">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedback_categories as $index=>$feedback_category)
                            <tr>
                                <td>
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            {{ $index+1 }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $feedback_category->name }}</h6>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                      
                        </tbody>
                    </table>
                </div>
            </div>
            
@endsection