@extends('admin.layout.app')

@section('title', 'Add Job Brand')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Job Brand</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('jobbrand.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Form -->
    <section class="content">
        <div class="container-fluid">

            <form action="{{ route('jobbrand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control">
                                        <option value="">-- Select Category --</option>

                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Brand Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Brand Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name') }}"
                                        class="form-control" placeholder="Enter Brand Name">

                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Slug (Auto) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" name="slug" id="slug"
                                        value="{{ old('slug') }}"
                                        class="form-control" placeholder="Auto-generated">
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Brand Image</label>
                                    <input type="file" name="image" class="form-control">

                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label>Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" class="custom-control-input"
                                           id="status" {{ old('status', 1) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status">Active</label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-outline-primary">Save Brand</button>
                    </div>
                </div>

            </form>

        </div>
    </section>

</div>

@endsection


@section('scripts')
<script>
    // Auto-create slug from name
    $('#name').on('keyup', function () {
        let text = $(this).val().toLowerCase();
        text = text.replace(/[^a-z0-9]+/g, '-');
        $('#slug').val(text);
    });
</script>
@endsection
