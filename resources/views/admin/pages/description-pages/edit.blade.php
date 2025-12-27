@extends('admin.layout.app')

@section('title', 'Edit Description Page')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Description Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('description-pages.index') }}" class="btn btn-primary">Back</a>
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
                    <form action="{{ route('description-pages.update', $description_page->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- CATEGORY -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Category *</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>

                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id', $description_page->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SUBCATEGORY -->
                            <!-- SUBCATEGORY -->
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label>Subcategory *</label>
                                    <select name="subcategory_id[]" id="subcategory_id" class="form-control select2" multiple>
                                        @foreach($subcategories as $sub)
                                        <option value="{{ $sub->id }}"
                                            {{ in_array($sub->id, explode(',', $description_page->subcategory_id ?? '')) ? 'selected' : '' }}>
                                            {{ $sub->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('subcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <!-- TITLE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Title *</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $description_page->title) }}"
                                        placeholder="Enter title">

                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SLUG -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Slug *</label>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $description_page->slug) }}"
                                        placeholder="Slug">

                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <!-- ============================ -->
                        <!-- MULTI SELECT FIELDS START   -->
                        <!-- ============================ -->

                        @php
                        $selectedEligibility = explode(',', $description_page->eligibility ?? '');


                        $selectedState = explode(',', $description_page->state ?? '');
                        $selectedBrands = explode(',', $description_page->jobbrand ?? '');
                        @endphp

                        <div class="row">

                            <!-- ELIGIBILITY -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Eligibility</label>
                                    <select name="eligibility[]" class="form-control select2" multiple>
                                        @foreach($eligibilityOptions as $opt)
                                        <option value="{{ $opt->title }}"
                                            {{ in_array($opt->title, explode(',', $description_page->eligibility ?? '')) ? 'selected' : '' }}>
                                            {{ $opt->title }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <!-- STATE -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>State</label>
                                    <select name="state[]" class="form-control select2" multiple>
                                        @foreach($stateOptions as $opt)
                                        <option value="{{ $opt->name }}"
                                            {{ in_array($opt->name, explode(',', $description_page->state ?? '')) ? 'selected' : '' }}>
                                            {{ $opt->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- JOB BRAND -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Job Brand</label>
                                    <select name="jobbrand[]" class="form-control select2" multiple>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->name }}"
                                            {{ in_array($brand->name, explode(',', $description_page->jobbrand ?? '')) ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $description_page->meta_title ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $description_page->meta_keywords ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $description_page->meta_description ?? '') }}">
                                </div>
                            </div>
                        </div>


                        <!-- ============================ -->
                        <!-- MULTI SELECT FIELDS END     -->
                        <!-- ============================ -->

                        @if(auth()->user()->role == 'saysadmin')
                        <!-- STATUS -->
                        <div class="row">
                            <div class="col-md-6">

                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $description_page->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $description_page->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>

                            </div>
                        </div>
                        @endif

                        <!-- DESCRIPTION -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="content" id="description" class="form-control" rows="6">{{ $description_page->content }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('description-pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</div>

@endsection

@section('scripts')

<!-- SELECT2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- SUMMERNOTE -->

@php
$selectedSubcategories = old('subcategory_id', $description_page->subcategory_id ? explode(',', $description_page->subcategory_id) : []);
@endphp

<script>
    $(document).ready(function() {

        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select options",
            width: '100%'
        });

        // Auto Slug
        $('#name').on('keyup', function() {
            let slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-');
            $('#slug').val(slug);
        });

        // Load Subcategories (MULTISELECT)
        $('#category_id').on('change', function() {

            let catId = $(this).val();
            $('#subcategory_id').html('<option>Loading...</option>');

            $.get("{{ url('admin/get-subcategories') }}/" + catId, function(data) {

                $('#subcategory_id').html('');

                $.each(data, function(i, sub) {
                    $('#subcategory_id').append(
                        '<option value="' + sub.id + '">' + sub.name + '</option>'
                    );
                });

                // Restore OLD selected values from PHP
                let oldValues = @json($selectedSubcategories);
                $('#subcategory_id').val(oldValues).trigger('change');
            });

        });

        // Trigger change on page load if category exists
        @if(old('category_id', $description_page->category_id))
        $('#category_id').trigger('change');
        @endif

    });
</script>





@endsection