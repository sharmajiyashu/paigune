


@extends('admin.layouts.app')

@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Employee</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Employees</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{ $employee->first_name }} {{ $employee->last_name }}</a>
                                </li>
                                <li class="breadcrumb-item active"> Account
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    @include('admin.employees.accounts.tab-bar')
                    <!-- profile -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Profile Details</h4>
                        </div>
                        <div class="card-body py-2 my-25">
                            <!-- header section -->
                            <div class="d-flex">
                                <a href="#" class="me-25">
                                    <img src="{{ asset('public/admin/app-assets/images/portrait/small/avatar-s-11.jpg')}}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                </a>
                                <!-- upload and reset button -->
                                <div class="d-flex align-items-end mt-75 ms-1">
                                    <div>
                                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                        <input type="file" id="account-upload" hidden accept="image/*" />
                                        {{-- <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button> --}}
                                        {{-- <p class="mb-0">Allowed file types: png, jpg, jpeg.</p> --}}
                                    </div>
                                </div>
                                <!--/ upload and reset button -->
                            </div>
                            <!--/ header section -->

                            <!-- form -->
                            <form class="validate-form mt-2 pt-50">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountFirstName">First Name</label>
                                        <input type="text" class="form-control" id="accountFirstName" name="firstName" placeholder="John" value="{{ $employee->first_name }}" data-msg="Please enter first name" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountLastName">Last Name</label>
                                        <input type="text" class="form-control" id="accountLastName" name="lastName" placeholder="Doe" value="{{ $employee->last_name }}" data-msg="Please enter last name" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountEmail">Email</label>
                                        <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="{{ $employee->email }}" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountOrganization">Mobile</label>
                                        <input type="text" class="form-control" id="accountOrganization" name="organization" placeholder="Organization name" value="{{ $employee->mobile }}" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Date Of Birth</label>
                                        <input type="text" class="form-control account-number-mask" id="accountPhoneNumber" name="phoneNumber" placeholder="Phone Number" value="{{ $employee->date_of_birth }}" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountAddress">Date Of Join</label>
                                        <input type="text" class="form-control" id="accountAddress" name="address" placeholder="Your Address" value="{{ $employee->date_of_join }}" />
                                    </div>

                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="country">State</label>
                                        <select id="country" class="select2 form-select">
                                            <option value="">Select Country</option>
                                            @foreach (config('states') as $state => $item)
                                                <option value="{{ $state }}" {{ ($employee->state == $state) ? 'selected' : '' }}>{{ $state }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountAddress">City</label>
                                        <input type="text" class="form-control" id="accountAddress" name="address" placeholder="Your Address" value="{{ $employee->city }}" />
                                    </div>
                                    
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>

                    <!-- deactivate account  -->
                    {{-- <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Delete Account</h4>
                        </div>
                        <div class="card-body py-2 my-25">
                            <div class="alert alert-warning">
                                <h4 class="alert-heading">Are you sure you want to delete your account?</h4>
                                <div class="alert-body fw-normal">
                                    Once you delete your account, there is no going back. Please be certain.
                                </div>
                            </div>

                            <form id="formAccountDeactivation" class="validate-form" onsubmit="return false">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" data-msg="Please confirm you want to delete account" />
                                    <label class="form-check-label font-small-3" for="accountActivation">
                                        I confirm my account deactivation
                                    </label>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-danger deactivate-account mt-1">Deactivate Account</button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <!--/ profile -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection