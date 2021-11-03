@extends('layouts.admin')

@section('content')

    <div class="table-responsive" >

        <form action="/admin/submitCategories" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name"> Nazwa Kategorii </label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Kategoria nadrzędna</label>
                <div class="col-md-2">
                    <select class="form-control" id="parent" name="parent">
                        <option>-</option>

                        @foreach($categories as $category)
                            <option>{{$category->category}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="attributes"> INNE ATRYBUTY</label>

                <div class="d-sm-flex align-items-center justify-content-between mb-4">


                    <a href="{{route('adminAddCategoryField')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-plus fa-sm "></i> DODAJ ATRYBUT</a>

                </div>
            </div>


            @for($i=0;$i<$attributes;$i++)
            <div class="form-group">
                <label for="name"> {{'Atrybut '.($i+1)}}</label>

                <div class="col-md-6">
                    <input id="{{'attribute'.$i}}" type="text" class="form-control @error('attribute'.$i) is-invalid @enderror" name="{{'attribute'.$i}}"
                           value="" required autocomplete="{{'attribute'.$i}}" autofocus>

                    @error('attribute'.$i)
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
            </div>
            @endfor

            <button type="submit" name="submit" class="btn btn-primary"> ZAPISZ </button>

        </form>

    </div>

@endsection
