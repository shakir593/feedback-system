@extends('backend.layout.layout')
@php
    $title='Dashboard';
    $subTitle = 'eCommerce';
    $script = '<script src="' . asset('assets/js/homethreeChart.js') . '"></script> ';
@endphp

@section('content')

            <div class="row gy-4">
                <div class="col-xxl-12">
                    <div class="card radius-8 border-0">
                        <div class="row h-100 g-0">
                            <div class="col-4 p-0 m-0">
                                <div class="card-body p-24 h-100 d-flex flex-column justify-content-center border border-top-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                        <div>
                                            <span class="mb-1 fw-medium text-secondary-light text-md">Total Users</span>
                                            <h6 class="fw-semibold text-primary-light mb-1">0</h6>
                                        </div>
                                    </div>
                                    <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">0</span> this week</p>
                                </div>
                            </div>
                            <div class="col-4 p-0 m-0">
                                <div class="card-body p-24 h-100 d-flex flex-column justify-content-center border border-top-0 border-start-0 border-end-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                        <div>
                                            <span class="mb-1 fw-medium text-secondary-light text-md">Total Customer</span>
                                            <h6 class="fw-semibold text-primary-light mb-1">0</h6>
                                        </div>
                                    </div>
                                    <p class="text-sm mb-0">Increase by <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">0</span> this week</p>
                                </div>
                            </div>
                            <div class="col-4 p-0 m-0">
                                <div class="card-body p-24 h-100 d-flex flex-column justify-content-center border border-top-0 border-bottom-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                        <div>
                                            <span class="mb-1 fw-medium text-secondary-light text-md">Total Orders</span>
                                            <h6 class="fw-semibold text-primary-light mb-1">0</h6>
                                        </div>
                                    </div>
                                    <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">0</span> this week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>

@endsection