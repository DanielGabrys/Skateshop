@extends('layouts.admin')

@section('content')

    <div class="table-responsive" >

        <form action="/admin/EditMainPageImages" method="post" enctype="multipart/form-data">
            @csrf

            zalecany rozmiar zdjęć 1920x1080


            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>NR</th>
                        <th>image</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($custom_images as $image)
                        <tr>
                            <td>{{$loop->iteration}}</td>

                            <td>
                                 <span class="position-absolute top-right bg-Secondary">
                                     <a href ="{{route('adminDeleteMainImages',['id' =>$image['id']])}}"> <i class="fas fa-fw fa-trash-alt"></i> </a>
                                 </span>
                                <img src="{{Storage::disk('local')->url('other_images/'.$image['image'])}}"
                                     width="600" height="250">
                            </td>

                            <td>{{$image['created_at']}}</td>
                            <td>{{$image['updated_at']}}</td>
                            <td>

                                <input id="{{'new_image'.$loop->index}}" type="file" class=" @error('new_image'.$loop->index) is-invalid @enderror"  name="{{'new_image'.$loop->index}}"  autocomplete="{{'new_image'.$loop->index}}" autofocus >

                                @error('new_image'.$loop->index)
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                @enderror

                            </td>
                        </tr>
                    @endforeach

                    <!-- max amount of images = $max_image_amount -->
                    @for($i=count($custom_images);$i<$max_images_amount;$i++)


                        <tr>
                            <td>{{($i+1)}}</td>

                            <td>

                                <img src="{{Storage::disk('local')->url('product_images/add_image.png')}}"
                                     width="600" height="250">
                            </td>

                            <td></td>
                            <td></td>
                            <td>

                                <input id="{{'new_image'.$i}}" type="file" class=" @error('new_image'.$i) is-invalid @enderror"  name="{{'new_image'.$i}}"  autocomplete="{{'new_image'.$i}}" autofocus >

                                @error('new_image'.$i)
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                @enderror

                            </td>
                        </tr>

                    @endfor


                    </tbody>

                </table>

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
