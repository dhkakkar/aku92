@extends('layouts.app')

@section('title', 'OPD Form')

@section('content')

<section class="section opd-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="opd-form-wrapper">
                    <h3 class="text-center mb-4">Patient Registration Form</h3>
                    <p class="text-center text-muted mb-4">Fill in the details below to register for OPD.</p>

                    <div id="opdFormAlert" class="alert d-none"></div>

                    <form id="opdForm" action="{{ url('/api/opd.php') }}" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="patient_name" class="form-label">Patient Name *</label>
                                <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="opd_phone" class="form-label">Phone *</label>
                                <input type="tel" class="form-control" id="opd_phone" name="phone" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Age *</label>
                                <input type="number" class="form-control" id="age" name="age" min="0" max="150" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender *</label>
                                <div class="d-flex gap-4 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="opd_address" class="form-label">Address *</label>
                            <input type="text" class="form-control" id="opd_address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe your symptoms or reason for visit..." required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
