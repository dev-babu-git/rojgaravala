@extends('usersPage.layout.app')

@section('title', 'Edit Category')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
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
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- NAME -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text"
                                        name="name"
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $category->name) }}"
                                        placeholder="Category Name">

                                    @error('name')
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
                                        value="{{ old('slug', $category->slug) }}"
                                        placeholder="Slug">

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
                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-primary">Update</button>
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

 