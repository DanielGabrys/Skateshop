@extends('layouts.admin')

@section('content')

    <div class="table-responsive" >

            <div class="form-group">
                <label for="name"> Name </label>

                <div class="col-md-6">

                   <div class="form-control">
                    {{$product->name}}
                   </div>

                </div>
            </div>

            <div class="form-group">
                <label for="price"> Price $ </label>

                <div class="col-md-6">
                    <div class="form-control">
                        {{ $product->price}}
                    </div>

                </div>
            </div>


            <div class="form-group">
                <label for="description"> Description </label>

                <div class="col-md-6">



                                {!! $product->description !!}





                </div>
            </div>

            <div class="form-group">
                <label for="amount"> Amount </label>

                <div class="col-md-6">
                    <div class="form-control">
                        {{$product->amount }}
                    </div>
                </div>
            </div>

            <label for="image"> Images </label>
            <div class="form-group">

                    @foreach($product->products_images as $images)
                        <img src="{{Storage::disk('local')->url('product_images/'.$images->image)}}"
                             width="200" height="200" style="max-height:220px" >
                    @endforeach


            </div>

    </div>

@endsection

