@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4 class="page-title">@lang('index.wallet')</h4>
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">@lang('index.your_coins')</h5>
                            <div class="d-flex align-items-center justify-content-center">
                                <h5 class="display-6 me-2">{{ number_format($user->balance, 0) }}</h5>
                                <i class="bi bi-coin fs-2"></i>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <p class="card-text text-muted">@lang('index.1_coin_equals_1_rupiah')</p>
                                <form action="{{ route('wallet_add') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">@lang('index.top_up_coins')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
