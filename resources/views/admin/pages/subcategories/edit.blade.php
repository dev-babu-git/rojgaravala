@extends('admin.layout.app')

@section('title', 'Edit Sub Category')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sub Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('subcategories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <!-- FORM START -->
                    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- CATEGORY DROPDOWN -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Category *</label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>

                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $subcategory->category_id) == $cat->id ? 'selected' : '' }}>
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
                                    <label>Name *</label>
                                    <input type="text"
                                        name="name"
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $subcategory->name) }}"
                                        placeholder="Subcategory Name">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <!-- SLUG -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Slug *</label>
                                    <input type="text"
                                        name="slug"
                                        id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $subcategory->slug) }}"
                                        placeholder="Slug">

                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $subcategory->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $subcategory->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description...">{{ old('description', $subcategory->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-primary">Update</button>
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

 