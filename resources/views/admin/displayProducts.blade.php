@extends('layouts.admin')

@section('content')




    <div class="table-responsive">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PRODUCTS</h1>

            <a href="{{route('adminAddProducts')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm "></i> ADD NEW</a>

        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Edit</th>
                <th>View</th>
                <th>Remove</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product['id']}}</td>

                    @foreach($product->products_images as $images )
                    <td> <img src="{{Storage::disk('local')->url('product_images/'.$images->image)}}"

                              width="100" height="100" style="max-height:220px" >
                    </td>
                    @endforeach

                    <td>{{$product['name']}}</td>
                    <td>{!! $product['description']!!}</td>
                    <td>{{$product['price']}}</td>
                    <td>{{$product['amount']}}</td>



                    <td> <a href="{{route('adminEditProducts',['id' =>$product['id']])}}" class="btn btn-primary">
                        <i class="fas fa-fw fa-pencil-alt"></i>
                        </a>
                    </td>


                    <td> <a href="{{route('adminOverviewProducts',['id' =>$product['id']])}}" class="btn btn-primary">
                            <i class="fas fa-fw fa-list-alt"></i>
                        </a>
                    </td>

                    <td> <a href="{{route('adminDeleteProducts',['id' =>$product['id']])}}" class="btn btn-primary"
                            onclick="return confirm('Napewno chcesz usunąć product, zmiany będa nieodwracalne?')">
                            <i class="fas fa-fw fa-trash-alt"></i>

                        </a>
                    </td>

            @endforeach


            </tbody>

        </table>

    </div>


@endsection
