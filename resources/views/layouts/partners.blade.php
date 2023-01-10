@extends('layouts.fixed.master')


@section('title')
    MyClothes
@endsection


@section('css')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection


@section('scripts')
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20 text-center">Partners</h4>
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="100px">Logo</th>
                                <th class="text-center">Name</th>
                                <th class="text-center" width="120px">Products</th>
                                <th class="text-center" width="230px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($partners as $partner)
                            <tr height="100px">
                                
                                <td><img src="{{ asset('assets/img/'.$partner->image) }}" width="100px" height="100px"></td>
                                <td style="text-align:center" class="pt-5"><h6>{{ $partner->name }}</h6></td>
                                <td><div class="pt-4"> <a class="btn btn-primary" href="{{ url('/product/hisall',$partner->id) }}"><i class="fa fa-eye"></i> View Products</a></div></td>
                                <td>
                                    <form class="pt-4" action="" method="POST" >
      
                                        <a class="btn btn-info" href=""><i class="fa fa-eye"></i> Details</a>
                              
                                            @csrf
                                            @method('DELETE')
                                 
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection
