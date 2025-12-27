@extends('admin.layout.app')

@section('title', 'Create Test')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Test</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('tests.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <!-- FORM START -->
                    <form action="{{ route('tests.store') }}" method="POST">
                        @csrf
                         <div class="row">
                            <div class="col-md-6">
                                <label>Exam Type</label>
                              <select name="exam_id" class="form-control" required>
                                    <option value="">-- Select Test --</option>
                                    @foreach($examData as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                       
                       
                            <!-- Test Title -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Test Title *</label>
                                    <input type="text"
                                        name="title"
                                        id="name"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter Test Title"
                                        value="{{ old('title') }}"
                                    >
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Slug -->
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
                       

                     
                            <!-- Duration -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Duration (Minutes) *</label>
                                    <input type="number"
                                        name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        placeholder="30"
                                        value="{{ old('duration') }}"
                                    >
                                    @error('duration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Total Marks -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Total Marks *</label>
                                    <input type="number"
                                        name="total_marks"
                                        class="form-control @error('total_marks') is-invalid @enderror"
                                        placeholder="100"
                                        value="{{ old('total_marks') }}"
                                    >
                                    @error('total_marks')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        

                        
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                          </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-outline-primary">Create</button>
                            <a href="{{ route('tests.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
