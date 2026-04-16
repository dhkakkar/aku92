@extends('layouts.shop')

@section('title', 'Profile')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">@include('account._sidebar')</div>
            <div class="col-lg-9">
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

                <div class="shop-cart-summary mb-4">
                    <h4 class="mb-4">Profile Details</h4>
                    <form method="POST" action="{{ route('account.profile.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone *</label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                            <small class="text-muted">Email is locked. Contact support to change it.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pincode</label>
                                <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $user->pincode) }}" maxlength="6">
                            </div>
                        </div>
                        <button class="btn btn-success"><i class="fas fa-save"></i> Save Profile</button>
                    </form>
                </div>

                <div class="shop-cart-summary">
                    <h4 class="mb-4">Change Password</h4>
                    <form method="POST" action="{{ route('account.password.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Current Password *</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password *</label>
                                <input type="password" name="password" class="form-control" required minlength="6">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm New Password *</label>
                                <input type="password" name="password_confirmation" class="form-control" required minlength="6">
                            </div>
                        </div>
                        <button class="btn btn-dark"><i class="fas fa-key"></i> Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
