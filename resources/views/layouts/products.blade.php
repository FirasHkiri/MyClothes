@extends('layouts.fixed.master')


@section('title')
    MyClothes
@endsection


@section('css')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        #outer
        {
            position: relative;
            width:100%;
        }
        .inner
        {
            display: inline-block;
        }
        .mid{
            position: absolute;
            left: 70%;
            transform: translate(-35%);
        }
        #filtericon {
            background-color: white;
        }
        #filterbtn {
            background-color: white;
            border-radius: 30%;
            
        }
    </style>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        function myFunction() {
            var x = document.getElementById("category");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
                }
    </script>

    <script>
        $(document).ready(function() {
            $(document).on("click", ".editbutton", function() {
                var product_id = $(this).val();
                $('#productedit').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/product/editProduct/" + product_id,
                    success: function(response) {
                        $('#id').val(product_id);
                        $('#Name').val(response.product.name);
                        $('#detail').val(response.product.detail);
                        $('#size').val(response.product.size);
                        $('#category_id').val(response.product.category_id);
                        //$('#image').val(response.product.image);
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
                    <h4 class="c-grey-900 mB-10 text-center">Products</h4>
                        {{-- add Product --}}
                        <button type="button" class="btn btn-success mB-20 float-left"  data-bs-toggle="modal" data-bs-target="#addProduct"><i class="fa fa-plus"></i> Add Product</button>

                        <div id="outer">
                            <div id="category" style="display: none" class="inner mid">

                                {{-- add Category --}}
                                <div class="inner">
                                    <button type="button" class="btn btn-outline-success mR-20"  data-bs-toggle="modal" data-bs-target="#addCategory"><i class="fa fa-plus"></i></button>
                                </div>
                                
                                <form class="inner" action="{{ route('shoes') }}" method="GET">

                                        <button id="filterbtn" type="submit" class="btn btn-outline-info mR-20" data-toggle="tooltip" data-placement="bottom"
                                        title="Shoes"><img id="filtericon" src="{{ asset('assets/img/shoe-filter.png') }}" width="25px" height="25px"></button>

                                </form>

                                <form class="inner" action="{{ route('shirts') }}" method="GET">

                                        <button id="filterbtn" type="submit" class="btn btn-outline-info mR-20" data-toggle="tooltip" data-placement="bottom"
                                        title="Shirts"><img id="filtericon" src="{{ asset('assets/img/tshirt-filter.png') }}" width="25px" height="25px"></button>
                                       
                                </form>

                                <form class="inner" action="{{ route('pants') }}" method="GET">

                                        <button id="filterbtn" type="submit" class="btn btn-outline-info mR-20" data-toggle="tooltip" data-placement="bottom"
                                        title="Pants"><img id="filtericon" src="{{ asset('assets/img/pants-filter.png') }}" width="25px" height="25px"></button>
                                </form>

                                <form class="inner" action="{{ route('products') }}" method="GET">
                                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-times"></i></button>
                                </form>

                            </div>
                            


                            <div class="inner float-right">
                                <button onclick="myFunction()" type="button" class="btn btn-outline-dark"><i class='fas fa-angle-left'></i> Category</button>
                            </div>
                        </div>
       
                    
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="100px">Image</th>
                                <th class="text-center" width="150px">Name</th>
                                <th class="text-center" width="150px">Brand</th>
                                <th class="text-center">Details</th>
                                <th class="text-center">Size</th>
                                <th class="text-center" width="250px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr height="100px">
                                <td><img src="{{ asset('assets/img/'.$product->image) }}" width="100px" height="100px"></td>
                                <td style="text-align:center" class="pt-5"><h6>{{ $product->name }}</h6></td>
                                <td style="text-align:center" class="pt-5"><h6>{{ $product->user->name }}</h6></td>
                                <td style="text-align:center" class="pt-5"><h6>{{ $product->detail }}</h6></td>
                                <td style="text-align:center" class="pt-5"><h6>{{ $product->size }}</h6></td>
                                <td class="pT-40"> 
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="btn btn-info detailsbutton" value="{{ $product->id }}"><i class="fa fa-eye"></i> Details</button> 
                                            
                                            <button type="button" class="btn btn-secondary editbutton" value="{{ $product->id }}"><i class="fa fa-pencil"></i>Edit</button>
                                            
                                            <form style=" display: inline-block;vertical-align: top;" action="{{ route('deleteProduct',$product->id) }}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                        
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <!--Add Product Modal-->
        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mx-auto">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close position-absolute end-0 mR-20 mT-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/product/storeProduct') }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Product Name">
                                </div>
                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Product Detail"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Size</label>
                                    <input type="text" name="size" id="size" class="form-control"
                                        placeholder="Product Size">
                                </div>
                                {{-- <div class="">
                                    <label>Size</label>
                                    <select name="size" id="size" class="form-control" multiple="">
                                        <option value="0" selected hidden>Select Product Size</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control custom-select">
                                        <option value="0" selected hidden>Select Product Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="Product image">
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

    <!--Add Category Modal-->
        <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mx-auto">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        <button type="button" class="btn-close position-absolute end-0 mR-20 mT-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/category/storeCategory') }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Category Name">
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

     <!--Edit Product Modal-->
        <div class="modal fade" id="productedit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mx-auto">
                        <h5 class="modal-title ">Edit product information</h5>
                        <button type="button" class="btn-close position-absolute end-0 mR-20 mT-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/product/updateProduct') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="product_id" id="product_id">

                        <div class="modal-body">
                            <div class="row card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="Name" class="form-control"
                                        placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea class="form-control" style="height:150px" name="detail" id="detail"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Size</label>
                                    <input type="text" name="size" id="size" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" id="category_id" class="form-control custom-select">
                                        <option value="0" selected hidden>Select Product Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div> --}}
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
