@extends('layouts.shop')

@section('title', 'Login')

@section('content')
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="shop-cart-summary">
                    <h2 class="mb-3 text-center">Login</h2>
                    <p class="text-muted text-center mb-4">Welcome back! Sign in to manage your orders.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </form>

                    <p class="text-center text-muted mt-3 mb-0 small">
                        Don't have an account? <a href="{{ route('register') }}">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
