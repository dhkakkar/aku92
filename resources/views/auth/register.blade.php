@extends('layouts.shop')

@section('title', 'Register')

@section('content')
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="shop-cart-summary">
                    <h2 class="mb-3 text-center">Create an account</h2>
                    <p class="text-muted text-center mb-4">Register once, then track every order you place.</p>

                    @if($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
                    @endif

                    <form method="POST" action="{{ url('/register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone *</label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password *</label>
                                <input type="password" name="password" class="form-control" required minlength="6">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm Password *</label>
                                <input type="password" name="password_confirmation" class="form-control" required minlength="6">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100"><i class="fas fa-user-plus"></i> Register</button>
                    </form>

                    <p class="text-center text-muted mt-3 mb-0 small">
                        Already have an account? <a href="{{ route('login') }}">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
