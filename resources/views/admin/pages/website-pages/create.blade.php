@extends('admin.layout.app')

@section('title', 'Create Page')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('website-pages.index') }}" class="btn btn-outline-primary">Back</a>
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
                    <form action="{{ route('website-pages.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <!-- PAGE NAME -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Name *</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label>Slug *</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <label>Status *</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>

                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <!-- DESCRIPTION -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-outline-primary">Create</button>
                            <a href="{{ route('website-pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection