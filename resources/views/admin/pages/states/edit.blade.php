@extends('admin.layout.app')

@section('title', 'Edit State')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit State</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('states.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('states.update', $state->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- STATE NAME -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>State Name *</label>
                                    <input type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $state->name) }}">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status *</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $state->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $state->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="pt-3">
                            <button class="btn btn-outline-primary">Update</button>
                            <a href="{{ route('states.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
