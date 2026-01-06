@extends('admin.layout.app')

@section('title', 'Edit Exam')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Exam</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('exams.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- TITLE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Title *</label>
                                    <input type="text"
                                        name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $exam->title) }}">

                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SLUG -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Slug *</label>
                                    <input type="text"
                                        name="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $exam->slug) }}">

                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <!-- STATUS -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="0" {{ $exam->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $exam->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('exams.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
