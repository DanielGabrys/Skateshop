@extends('layouts.admin')

@section('content')

<div class="table-responsive" >

    <form action="{{route('updateProduct',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="name"> Name </label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{$product->name}}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label for="price"> Price $ </label>

            <div class="col-md-6">
               <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                      value="{{(float) substr($product->price, 1)}}"
                      required autocomplete="price" autofocus> <!-- // $50.00 -> 50.00 -->

                @error('price')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
        </div>


        <div class="form-group">
            <label for="description"> Description </label>

            <div class="col-md-6">
                <textarea class="ckeditor form-control @error('description') is-invalid @enderror"
                          name="description" autocomplete="description" autofocus>

                    {{ $product->description }}

                </textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label for="amount"> Amount </label>

            <div class="col-md-6">
                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{$product->amount }}" required autocomplete="amount" autofocus>

                @error('amount')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
        </div>

        <label for="image"> Images </label>
        <div class="form-group">


                @foreach($product_images as $image)

                <span class="position-absolute top-right bg-Secondary">
                <a href ="{{route('deleteProductImage',['id' =>$image['id']])}}"> <i class="fas fa-fw fa-trash-alt"></i> </a>
                </span>

                    <img src="{{Storage::disk('local')->url('product_images/'.$image['image'])}}"
                     width="200" height="200" style="max-height:220px" >

                @endforeach

                <!-- max amount of images = $max_image_amount -->
                @for($i=count($product_images);$i<$max_images_amount;$i++)

                        <img src="{{Storage::disk('local')->url('product_images/add_image.png')}}"
                             width="200" height="200" style="max-height:220px" >

                @endfor

        </div>

        <div class="form-group">
            <label for="New Images"> LOAD NEW IMAGES </label> </br>

            @for($i=0;$i<$max_images_amount;$i++)
                <label for="New Images">{{'Image '.($i+1)}}</label> </br>
                <input id="{{'new_image'.$i}}" type="file" class="form-control @error('new_image'.$i) is-invalid @enderror"  name="{{'new_image'.$i}}"  autocomplete="{{'new_image'.$i}}" autofocus >

                @error('new_image'.$i)
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
            @endfor
        </div>

        <button type="submit" name="submit" class="btn btn-primary"> Submit </button>

    </form>


    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

</div>

@endsection
