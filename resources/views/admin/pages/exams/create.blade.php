@extends('admin.layout.app')

@section('title', 'Create Exam')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Exam</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('exams.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <!-- TITLE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Title *</label>
                                    <input type="text"
                                        name="title"
                                         id="name" 
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}"
                                        placeholder="Exam Title">

                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SLUG -->
                               <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug *</label>
                                    <input type="text"
                                        name="slug"
                                        id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="Slug"
                                        value="{{ old('slug') }}"
                                    >

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
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button class="btn btn-outline-primary">Create</button>
                            <a href="{{ route('exams.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
