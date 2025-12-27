@extends('admin.layout.app')

@section('title', 'Create Category')

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">Back</a>
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
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" 
                                        name="name" 
                                        id="name" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        placeholder="Category Name"
                                        value="{{ old('name') }}"
                                    >

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

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
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button class="btn btn-outline-primary">Create</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection


  

