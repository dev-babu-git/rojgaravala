@extends('admin.layout.app')

@section('title', 'Edit Education Job')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Edit Education Job</h1></div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('education-jobs.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('education-jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $job->title) }}">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button class="btn btn-outline-primary">Update</button>
                        <a href="{{ route('education-jobs.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
