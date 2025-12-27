@extends('usersPage.layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard</h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid mt-4">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileSettingsModal">
    Profile
</button>

<!-- Update Profile Modal -->
<div class="modal fade" id="profileSettingsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="settingsForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{ auth()->user()->student->phone ?? '' }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Course</label>
                        <input type="text" name="course" value="{{ auth()->user()->student->course ?? '' }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>New Password (optional)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div id="profile-error-msg" class="text-danger"></div>
                    <div id="profile-success-msg" class="text-success"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card card-hover bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Tests</h6>
                    <h3>{{ $totalTests ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Completed Tests</h6>
                    <h3>{{ $completedTests ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover bg-warning text-dark shadow-sm">
                <div class="card-body text-center">
                    <h6>Pending Tests</h6>
                    <h3>{{ $pendingTests ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover bg-danger text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Score Avg</h6>
                    <h3>{{ $averageScore ?? 0 }}%</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Test List -->
    <div class="row g-3">
        @forelse($tests as $test)
            <div class="col-md-4">
                <div class="card card-hover test-card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $test->name }}</h5>
                        <p class="card-text mb-1"><strong>Duration:</strong> {{ $test->duration }} min</p>
                        <p class="card-text mb-2"><strong>Total Marks:</strong> {{ $test->total_marks }}</p>
                        <a href="{{ route('student.tests.start', $test->id) }}" class="btn btn-primary w-100">Start Test</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No tests available at the moment.
                </div>
            </div>
        @endforelse
    </div>
 

</div>


    </section>

</div>



@endsection


@section('scripts')
<script>

$(document).ready(function(){

    // Form submit → AJAX
    $('#settingsForm').on('submit', function(e){
        e.preventDefault();
        $('#profile-error-msg').html('');
        $('#profile-success-msg').html('');

        $.ajax({
            url: "{{ route('student.settings.update') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response){
                if(response.success){
                    $('#profile-success-msg').html(response.success);
                    $('#profileSettingsModal').modal('hide');
                }
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let errorHtml = '';
                $.each(errors, function(key, value){
                    errorHtml += value[0] + '<br>';
                });
                $('#profile-error-msg').html(errorHtml);
            }
        });
    });

});

</script>

@endsection