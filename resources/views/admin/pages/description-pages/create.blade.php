@extends('admin.layout.app')

@section('title', 'Create Description Post')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Description Post</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('description-pages.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('description-pages.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- CATEGORY -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Category *</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SUBCATEGORY (MULTISELECT) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Sub Category *</label>
                                    <select name="subcategory_id[]" id="subcategory_id"
                                        multiple
                                        class="form-control select2 @error('subcategory_id') is-invalid @enderror">
                                    </select>
                                    @error('subcategory_id.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- NAME -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Name *</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Title">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SLUG -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Slug *</label>
                                    <input type="text" name="slug" id="slug"
                                        value="{{ old('slug') }}"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="Slug">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- MULTISELECT FIELDS -->
                        <div class="row mt-3">
                            <!-- JOB BRAND -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Job Brand *</label>
                                    <select name="jobbrand[]" multiple
                                        class="form-control select2 @error('jobbrand.*') is-invalid @enderror">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->name }}"
                                                {{ collect(old('jobbrand'))->contains($brand->name) ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jobbrand.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- EDUCATION -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Education / Eligibility *</label>
                                    <select name="eligibility[]" multiple
                                        class="form-control select2 @error('eligibility.*') is-invalid @enderror">
                                        @foreach($education as $edu)
                                            <option value="{{ $edu->title }}"
                                                {{ collect(old('eligibility'))->contains($edu->title) ? 'selected' : '' }}>
                                                {{ $edu->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('eligibility.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- STATE -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>State *</label>
                                    <select name="state[]" multiple
                                        class="form-control select2 @error('state.*') is-invalid @enderror">
                                        @foreach($states as $state)
                                            <option value="{{ $state->name }}"
                                                {{ collect(old('state'))->contains($state->name) ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- META FIELDS -->
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}">
                                </div>
                            </div>
                        </div>

                        <!-- STATUS -->
                        <div class="row mt-3">
                            @if(auth()->user()->role == 'saysadmin')
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            @endif
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Description *</label>
                                <textarea name="content" id="description" class="form-control">{{ old('content') }}</textarea>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button class="btn btn-outline-primary">Create</button>
                            <a href="{{ route('description-pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
$(document).ready(function () {

    // Summernote
    $('#description').summernote({ height: 250 });

    // Select2
    $('.select2').select2({
        placeholder: "Select options",
        width: '100%'
    });

    // Auto Slug
    $('#name').on('keyup', function () {
        let slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-');
        $('#slug').val(slug);
    });

    // Load Subcategories (MULTISELECT)
    $('#category_id').on('change', function () {

        let catId = $(this).val();
        $('#subcategory_id').html('<option>Loading...</option>');

        $.get("{{ url('admin/get-subcategories') }}/" + catId, function (data) {

            $('#subcategory_id').html('');

            $.each(data, function (i, sub) {
                $('#subcategory_id').append(
                    '<option value="' + sub.id + '">' + sub.name + '</option>'
                );
            });

            // Reapply select2
            $('#subcategory_id').trigger('change');

            // Restore OLD selected values
            @if(old('subcategory_id'))
                $('#subcategory_id').val({!! json_encode(old('subcategory_id')) !!}).trigger('change');
            @endif

        });

    });

    // If old category id exists
    @if(old('category_id'))
        $('#category_id').trigger('change');
    @endif
});
</script>

@endsection
