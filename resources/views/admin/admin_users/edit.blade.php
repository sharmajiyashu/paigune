


@extends('admin.layouts.app')

@section('content')

<style>
    .error{
        color:#a93c3d !important;
        font-weight: 500;
    }
    /* input {
        text-transform: uppercase;
    } */
</style>

 <!-- BEGIN: Content-->
 <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Admin User</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.admin_users.index') }}">Admin User</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

            {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" user="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif --}}

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.admin_users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('PATCH')
                                    
                                        <div class="row">
                                            

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">First Name <span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="first_name" class="form-control" placeholder="First Name"  value="{{ $user->first_name }}" />
                                                    @error('first_name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Last Name <span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="last_name" class="form-control" placeholder="Last Name"  value="{{ $user->last_name }}" />
                                                    @error('last_name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email<span class="error"></span></label>
                                                    <input type="email" id="first-name-column" name="email" class="form-control" placeholder="Email"  value="{{ $user->email }}" />
                                                    @error('email')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Role<span class="error"></span></label>
                                                    <select name="role_id" id="" class="form-select">
                                                        <option value="">(Select Role)</option>
                                                        @foreach ($roles as $item)
                                                            <option value="{{ $item->id }}" {{ ($user->role_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role_id')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Password<span class="error"></span></label>
                                                    <input type="password" id="first-name-column" name="password" class="form-control" placeholder="Enter Password"  value="{{ $user->password }}" />
                                                    @error('password')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    
@endsection