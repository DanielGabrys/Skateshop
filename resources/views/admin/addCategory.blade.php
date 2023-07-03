@extends('layouts.admin')

@section('content')

    <div class="table-responsive" >

        <form action="{{route('storeCategory')}}" method="post" enctype="multipart/form-data">
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


                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary"> ZAPISZ </button>

        </form>

    </div>

@endsection
