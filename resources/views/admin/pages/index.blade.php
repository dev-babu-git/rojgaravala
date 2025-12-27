@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard</h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">

                <!-- CATEGORIES -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalCategories }}</h3>
                            <p>Total Categories</p>
                        </div>
                        <a href="{{ route('categories.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- SUBCATEGORIES -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalSubcategories }}</h3>
                            <p>Total Subcategories</p>
                        </div>
                        <a href="{{ route('subcategories.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- DESCRIPTION PAGES -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalDescriptionPages }}</h3>
                            <p>Total Description Pages</p>
                        </div>
                        <a href="{{ route('description-pages.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- STATES -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalStates }}</h3>
                            <p>Total States</p>
                        </div>
                        <a href="{{ route('states.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- EDUCATION JOBS -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalEducationJobs }}</h3>
                            <p>Total Education Jobs</p>
                        </div>
                        <a href="{{ route('education-jobs.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- JOB BRANDS -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalJobBrands }}</h3>
                            <p>Total Job Brands</p>
                        </div>
                        <a href="{{ route('jobbrand.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- USERS -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>Total Users</p>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- WEBSITE PAGES -->
                <div class="col-lg-3 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $totalWebsitePages }}</h3>
                            <p>Total Website Pages</p>
                        </div>
                        <a href="{{ route('website-pages.index') }}" class="small-box-footer text-dark">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </section>

</div>
@endsection
