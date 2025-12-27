@extends('admin.layout.app')

@section('title', 'Edit Job Brand')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Job Brand</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('jobbrand.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('jobbrand.update', $jobBrand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- CATEGORY -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Category *</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">-- Select Category --</option>

                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $jobBrand->category_id) == $cat->id ? 'selected' : '' }}>
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
                                    <label>Brand Name *</label>
                                    <input type="text"
                                        id="name"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $jobBrand->name) }}">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SLUG -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Slug *</label>
                                    <input type="text"
                                        id="slug"
                                        name="slug"
                                        class="form-control"
                                        value="{{ old('slug', $jobBrand->slug) }}">
                                </div>
                            </div>

                            <!-- IMAGE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Brand Image</label>
                                    <input type="file" name="image" class="form-control">

                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($jobBrand->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/jobBrand/'.$jobBrand->image) }}"
                                                width="80" height="80" class="rounded border">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status *</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $jobBrand->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $jobBrand->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="pt-3">
                            <button class="btn btn-outline-primary">Update Brand</button>
                            <a href="{{ route('jobbrand.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection


@section('scripts')
<script>
    // Auto slug generate
    $('#name').keyup(function () {
        let text = $(this).val().toLowerCase();
        text = text.replace(/[^a-z0-9]+/g, '-');
        $('#slug').val(text);
    });
</script>
@endsection
