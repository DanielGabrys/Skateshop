@extends('layouts.admin')

@section('content')


    <div class="table-responsive">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PRODUCTS</h1>

            <a href="{{route('adminAddCategoryForm')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm "></i> ADD NEW</a>

        </div>

        <table class="table table-striped">
            <thead>
            <tr>

                <th>Category</th>
                <th>Parent Category</th>
                <th>Level</th>
                <th>Edit</th>
                <th>Remove</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->category}}</td>
                    <td>{{$category->parent_category}}</td>
                    <td>{{$category->level}}</td>


                    <td> <a href="{{route('adminEditProducts',['id' =>$category->id])}}" class="btn btn-primary">
                            <i class="fas fa-fw fa-pencil-alt"></i>
                        </a>
                    </td>

                    <td> <a href="{{route('adminDeleteProducts',['id' =>$category->id])}}" class="btn btn-primary"
                            onclick="return confirm('Napewno chcesz usunąć product, zmiany będa nieodwracalne?')">
                            <i class="fas fa-fw fa-trash-alt"></i>

                        </a>
                    </td>

            @endforeach


            </tbody>

        </table>

    </div>


@endsection

