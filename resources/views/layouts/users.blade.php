@extends('layouts.fixed.master')


@section('title')
    MyClothes
@endsection


@section('css')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        .Sadmin {
            background-color: rgb(99, 255, 59);
            color: white;
            width: 92px;
            border-radius: 20px;
        }

        .admin {
            background-color: rgb(255, 174, 0);
            color: white;
            width: 65px;
            border-radius: 20px;
        }

        .partner {
            background-color: blue;
            color: white;
            width: 65px;
            border-radius: 20px;
        }
    </style>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://raw.githubusercontent.com/phstc/jquery-dateFormat/master/dist/jquery-dateformat.min.js"></script>
    <script src="https://raw.githubusercontent.com/phstc/jquery-dateFormat/master/dist/jquery-dateformat.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(document).on("click", ".editbutton", function() {
                var partner_id = $(this).val();
                
                 $('#useredit').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/user/editUser/" + partner_id,
                    success: function(response) {
                        $('#id').val(partner_id);
                        $('#name').val(response.partner.name);
                        $('#email').val(response.partner.email);
                        $('#role').val(response.partner.role);
                    }
                })
            });
        })
    </script>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20 text-center">User Management</h4>
                    @if (Auth::user()->role == 'Super Admin')
                    <button type="button" class="btn btn-success mB-20" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-plus"></i> Add New
                            User</button>
                    @endif
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="10px">ID</th>
                                <th class="text-center" width="100px">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center" width="100px">Join date</th>
                                <th class="text-center" width="140px">Number of products</th>
                                <th class="text-center" width="70px">Role</th>
                                <th class="text-center" width="150px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($partners as $partner)
                                <tr>
                                    <td class="text-center">
                                        <h6>{{ $partner->id }}</h6>
                                    </td>

                                    <td class="text-center">
                                        <h6>{{ $partner->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $partner->email }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$partner->created_at->diffForHumans()}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $partner->products_count }}</h6>
                                    </td>
                                    <td>
                                        @if ($partner->role == 'Super Admin')
                                            <div class="Sadmin text-center">Super Admin</div>
                                        @elseif ($partner->role == 'Admin')
                                            <div class="admin text-center">Admin</div>
                                        @else
                                            <div class="partner text-center">Partner</div>
                                        @endif

                                    </td>
                                    <td>
                                        @if (Auth::user()->role == 'Super Admin')
                                            <div class="row">
                                                <div class="col-sm-12 text-center">

                                                    <button type="button" class="btn btn-secondary editbutton"
                                                        value="{{ $partner->id }}"><i
                                                            class="fa fa-pencil"></i>Edit</button>

                                                    <form style=" display: inline-block;vertical-align: top;"
                                                        action="{{ route('deleteUser', $partner->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fa fa-trash"></i>
                                                            Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!--Add User Modal-->
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mx-auto">
                        <h5 class="modal-title ">Edit user information</h5>
                        <button type="button" class="btn-close position-absolute end-0 mR-20 mT-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('validate_newUser') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="partner_id" id="partner_id">

                        <div class="modal-body">
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Choose a name..">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                </div>
        
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Choose an email..">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                </div>
        
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Choose a password..">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label>Confirm your Password</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password..">
                                        @if ($errors->has('confirm_password'))
                                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                        @endif
                                </div>
        
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="image" class="form-control">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                  </div>
        
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control custom-select">
                                        <option value="0" selected hidden>Choose user role</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Partner">Partner
                                        </option>
                                    </select>
                                        @if ($errors->has('role'))
                                            <span class="text-danger">Please select a role for this user</span>
                                        @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" style="width: 100px" class="btn btn-success"><i class="fa fa-check"></i>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End Modal -->

    <!--Edit User Modal-->
        <div class="modal fade" id="useredit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mx-auto">
                        <h5 class="modal-title ">Edit user information</h5>
                        <button type="button" class="btn-close position-absolute end-0 mR-20 mT-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/user/updateUser/') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="partner_id" id="id">

                        <div class="modal-body">
                            <div class="row card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" id="role" class="form-control custom-select">
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Partner">Partner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" style="width: 100px" class="btn btn-success"><i
                                        class="fa fa-check"></i>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End Modal -->
@endsection
