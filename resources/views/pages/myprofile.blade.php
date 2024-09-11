<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Profile | Minia - Minimal Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('minia/assets/images/favicon.ico') }}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('minia/assets/css/preloader.min.css') }}" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('minia/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('minia/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('minia/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Profile</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm order-2 order-sm-1">
                                        <div class="d-flex align-items-start mt-3 mt-sm-0">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                <img src="{{ $dataProfile->photo ? Storage::url($dataProfile->photo) : asset('minia/assets/images/users/avatar-2.jpg') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid rounded-circle d-block">


                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-16 mb-1">{{ $dataProfile->name }}</h5>
                                                    

                                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $dataProfile->phone_number }}</div>
                                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $dataProfile->email }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto order-1 order-sm-2">
                                        <div class="d-flex align-items-start justify-content-end gap-2"></div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </div>



                                <!-- Edit Profile Form -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Edit Profile</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $dataProfile->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $dataProfile->email }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $dataProfile->phone_number }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password (Leave blank if you don't want to change it)</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>

                                            <div class="mb-3">
                                                <label for="profile_photo" class="form-label">Profile Photo</label>
                                                <input type="file" class="form-control" id="photo" name="photo">

                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value="true" id="del_photo" name="request-del-profile">
                                                <label class="form-check-label" for="del_photo">
                                                    Delete current profile photo
                                                </label>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('minia/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('minia/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('minia/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('minia/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('minia/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('minia/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('minia/assets/libs/pace-js/pace.min.js') }}"></script>
    <script src="{{ asset('minia/assets/js/app.js') }}"></script>
</body>

</html>
