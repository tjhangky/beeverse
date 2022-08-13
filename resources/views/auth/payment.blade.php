@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="d-flex flex-column align-items-center mt-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center">Continue with Payment</h4>
                    <form action="{{ route('confirm') }}" method="POST">
                        @csrf

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3 text-center">
                            <label for="price" class="form-label">Registration Price</label>
                            <p class="fw-bold">IDR {{ number_format($price, 0) }}</p>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount"
                                placeholder="amount">
                            <label for="amount">Enter Amount</label>

                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-warning">Pay Now</button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <div class="d-flex mt-3 justify-content-center">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <form action="{{ route('finish') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Yes</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
