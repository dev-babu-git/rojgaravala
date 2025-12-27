@extends('admin.layout.app')

@section('title', 'Create Sub Category')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Sub Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('subcategories.index') }}" class="btn btn-outline-primary">Back</a>
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
                    <form action="{{ route('subcategories.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <!-- CATEGORY -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Parent Category *</label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- NAME -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text"
                                        name="name"
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Sub Category Name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- SLUG -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug *</label>
                                    <input type="text"
                                        name="slug"
                                        id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="Slug"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                        </div>

                        <!-- DESCRIPTION -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>

                            </div>
                        </div>

                        <div class="pt-4">
                            <button class="btn btn-outline-primary">Create</button>
                            <a href="{{ route('subcategories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
 