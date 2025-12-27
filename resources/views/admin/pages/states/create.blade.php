@extends('admin.layout.app')

@section('title', 'Create State')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create State</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('states.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <!-- FORM START -->
                    <form action="{{ route('states.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <!-- STATE NAME -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">State Name *</label>
                                    <input type="text" 
                                        name="name" 
                                        id="name" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        placeholder="Enter State Name"
                                        value="{{ old('name') }}"
                                    >

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="pt-4">
                            <button class="btn btn-outline-primary">Create</button>
                            <a href="{{ route('states.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
