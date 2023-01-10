@extends('layouts.fixed.master')


@section('title')
    MyClothes
@endsection


@section('css')
    <style>
        .image-upload>label>button {
            display: none;
        }

        #uploadForm>input {
            display: none;
        }

        .edit {
            position: absolute;
            top: 110px;
            left: 130px;
        }

        #editbutton {
            background-color: rgb(195, 195, 195);
            border-radius: 7px;
            width: 35px;
            height: 35px;
        }

    </style>
@endsection



@section('scripts')

@endsection


@section('content')
    <div class="text-center mb-5" style="color: black">
        <h3><i class="ti-user mR-10"></i> Profile </h3>
    </div>
    <div class="row">
        <div class="CenterPage">

            <!-- profile image -->
                <div class="card card-primary mx-auto mB-30" style="width: 400px;border-radius: 15px;">
                    <div class="row card-body">
                        <div class="col-4 mR-30">
                            <img src="{{ asset('assets/img/' . $partner->image) }}" alt="User avatar" height="130"
                                width="130" style="border-radius: 15px">
                            <div class="image-upload">
                                <label id="editbutton" class="btn edit" data-toggle="tooltip" data-placement="bottom"
                                    title="Change your profile picture">
                                    <i class="fa fa-pencil"></i>
                                    <button type="button" data-toggle="modal" data-target="#updateimage"></button>
                                </label>
                            </div>
                        </div>
                        <div class="justify-content-center col-7">
                            <div class="card-body">
                                <h3 style="color: black"> {{ $partner->name }} </h3>
                                <h6>Role : {{ $partner->role }} </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!--change image Modal -->
                <div class="modal fade" id="updateimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change Profile picture</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('changeProfileImage', $partner->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row card-body">
                                        <div class="form-group">
                                            <input type="file" name="image" class="form-control" placeholder="image">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" style="width: 100px" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- End profile image -->

            <!-- profile body -->
                <form action="{{ route('updateProfile', $partner->id) }}" method="POST">

                    @csrf
                    @method('PUT')
                    <div class="card card-primary mx-auto mB-30" style="width: 900px;border-radius: 15px;">
                        <h4 class="mT-20 mL-30" style="color: black">Account Information</h4>
                        <div class="card-body mx-auto">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" style="width: 700px" class="form-control"
                                    value="{{ $partner->name }}" placeholder="Name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" style="width: 700px" class="form-control"
                                    value="{{ $partner->email }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <button type="submit" style="width: 100px" class="btn btn-success float-right mR-30 mT-10 mB-30"><i
                                    class="fa fa-check"></i> Save</button>
                        </div>
                    </div>

                </form>
            <!-- End profile body -->

            <!-- profile password -->
                <form action="{{ route('changePassword', $partner->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card card-primary mx-auto mB-30" style="width: 900px;border-radius: 15px;">
                        <h4 class="mT-20 mL-30" style="color: black">Change Password</h4>
                        <div class="card-body mx-auto">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" name="old_password" style="width: 700px" class="form-control"
                                    placeholder="Current Password">

                                @if ($errors->has('old_password'))
                                    <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" style="width: 700px" class="form-control"
                                    placeholder="New Password">

                                @if ($errors->has('new_password'))
                                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" style="width: 700px" class="form-control"
                                    placeholder="Confirm Password">

                                @if ($errors->has('confirm_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>

                        </div>
                        <div>
                            <button type="submit" style="width: 100px" class="btn btn-info float-right mR-30 mT-10 mB-30"><i
                                    class="fa fa-check"></i> Change</button>
                        </div>
                    </div>
                </form>
            <!-- End profile password -->

            <!-- delete account -->
                <div class="card card-primary mx-auto" style="width: 900px;height:130px; border-radius: 15px;">
                    <h4 class="mT-20 mL-30" style="color: black">Delete Account</h4>
                    <div class="container text-center">
                        <label class="mR-20">Delete my account</label>
                        <button type="button" data-toggle="modal" data-target="#delete" style="width: 100px" class="btn btn-danger">
                            <i class="fa fa-trash"></i> Delete</button>
                    </div>
                </div>

                <!--Delete account popup -->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header mx-auto">
                                <h6 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red"></i> Warning <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red"></i></h6>
                                <button type="button" class="close position-absolute end-0 mR-10" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('deleteAccount', $partner->id) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <div class="row card-body">
                                           <h5 class="mL-20" style="color: red">Are you sure you want to delete you account ?</h5>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" style="width: 100px" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- End delete account -->

        </div>
    </div>
@endsection
