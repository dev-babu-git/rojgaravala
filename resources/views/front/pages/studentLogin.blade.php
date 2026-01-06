@extends('front.layout.app')

@section('title','Student Login')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Student Login</h4>
                    <small>Sign in to access your dashboard</small>
                </div>

                <div class="card-body p-4">

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('student.login.submit') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                             <input type="email" name="email" class="form-control" placeholder="Email" required
                            value="{{ session('email') ?? old('email') }}">

                      
                        </div>

                        {{-- Password --}}
                        {{-- <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Enter password"
                                   required>
                        </div> --}}

                         <div class="mb-3 position-relative">
                            <label>Password</label>
                              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required
                            value="{{ session('password') ?? '' }}">
                            
                            <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                        </div>
                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info">
                                Login
                            </button>
                        </div>
                    </form>

                    {{-- Forgot Password --}}
                    
                    <hr>

                    {{-- Register CTA --}}
                    <div class="text-center">
                        <p class="mb-2">Don’t have an account?
                        <a href="{{ route('student.register') }}" >
                            Create New Account
                        </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
