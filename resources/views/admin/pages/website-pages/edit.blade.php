@extends('admin.layout.app')

@section('title', 'Edit Page')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('website-pages.index') }}" class="btn btn-primary">Back</a>
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
                     
                    <form action="{{ route('website-pages.update', $editData->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- PAGE NAME -->
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $editData->name) }}">


                            </div>

                            <div class="col-md-6">
                                <label>Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $editData->slug) }}">

                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $editData->status) == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ old('status', $editData->status) == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>
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
                                <textarea name="description" id="description" class="form-control" rows="5">
                                {{ old('description', $editData->description) }}
                                </textarea>

                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-primary">Update</button>
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