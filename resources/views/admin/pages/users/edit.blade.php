@extends('admin.layout.app')

@section('title', 'Edit User')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
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
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
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
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="User Name" required>

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <!-- EMAIL -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email *</label>
                                    <input type="email"
                                        name="email"
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="Email" required>

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- PASSWORD -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password">Password (Leave blank to keep current)</label>
                                    <input type="password"
                                        name="password"
                                        id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password">

                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- ROLE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="saysadmin" {{ old('role', $user->saysadmin) == 'saysadmin' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                    </select> 
                                </div>
                            </div>

                        </div>

                      

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
