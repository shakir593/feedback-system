@extends('backend.layout.layout')
@php
    $title='Manage Feedback';
    $subTitle = 'Manage Feedback';
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
                    <h5 class="card-title mb-0">Feedback Datatables</h5>
                     <a href = "{{ route('feedback.create') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Add Feedback
                    </a>
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
                                {{-- <th scope="col">Invoice</th> --}}
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedbacks as $index=>$feedback)
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
                                        <h6 class="text-md mb-0 fw-medium flex-grow-1"> {{ $feedback->title }} </h6>
                                    </div>
                                </td>
                                <td> {{ $feedback->feedback_category->name ?? '' }} </td>
                                <td>
                                    <a  href="{{ route('feedback.show',$feedback->id) }}" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>
                                    <a  href="{{ route('feedback.add_comment',$feedback->id) }}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                         <iconify-icon icon="iconamoon:comment" ></iconify-icon>
                                    </a>
                                    @if(Auth::user()->canEditFeedback($feedback))
                                        <a  href="{{ route('feedback.edit',$feedback->id) }}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a  href="javascript:void(0)" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" onclick="event.preventDefault();
                                                         document.getElementById('delete-feedback-{{ $feedback->id }}').submit();">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form id="delete-feedback-{{ $feedback->id }}" action="{{ route('feedback.delete',$feedback->id) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                      
                        </tbody>
                    </table>
                </div>
            </div>
            
@endsection