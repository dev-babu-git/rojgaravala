@extends('front.layout.app')

@section('title','Student Registration')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
 
            <div class="card shadow border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4>Create Account</h4>
                    <small>Register to start online tests</small>
                </div>

                <div class="card-body p-4">

                    {{-- Show Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('student.register.submit') }}" method="POST" id="registerForm">
                        @csrf

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                        </div>

                       <div class="mb-3 position-relative">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control pr-5" required>
                            <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                        </div>

                        <div class="mb-3 position-relative">
                            <label>Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control pr-5" required>
                            <span toggle="#password_confirmation" class="fa fa-eye field-icon toggle-password"></span>
                            <small id="passwordMatchMsg" class="text-danger d-none">Passwords do not match!</small>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-info" id="registerBtn">Register</button>
                        </div>

                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('student.login') }}">
                            Already have an account? Login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

 


  
@endsection
