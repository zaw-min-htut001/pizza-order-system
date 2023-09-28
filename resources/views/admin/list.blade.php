@extends('admin.layout.master')

@section('title','Category List')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">Product List</h2>

                </div>
            </div>
            <div class="table-data__tool-right">
                <a href="{{ route('category#createPage')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add item
                    </button>
                </a>
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    CSV download
                </button>
            </div>
        </div>

        {{-- serach --}}
        <div class="">
            {{-- serch key --}}
        <div class="mt-2">
            <h4 class="text-danger">Serach Key : {{ request('key')}}</h4>
        </div>
            <form action="{{ route('category#list')}}" method="get" class="d-flex justify-content-end">
                @csrf
                <input type="search" name="key" id="" class="col-3 form-control" placeholder="Serach..." value="{{ request('key')}}">
                <button type="submit" class=" btn btn-dark">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <h3> Total - {{ $categories->total() }} results</h3>
        </div>
        {{-- message --}}

        @if (session('deleteSucess'))
        <div class="offset-8 col-4 ">
            <div class="alert alert-danger alert-dismissible fade show  " role="alert">
                <strong>{{ session('deleteSucess')}} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        @if (count($categories) != 0 )
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Created at</th>

                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($categories as $category)
                    <tr class="tr-shadow">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at->format('j/F/y') }}</td>
                        <td>
                            <div class="table-data-feature ">
                                <a href="{{ route('category#edit', $category->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href=" {{ route('category#delete', $category->id )}} ">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    @endforeach

                    </tr>

                </tbody>
            </table>
        </div>
        @else
        <div class="text-center mt-5">
            <h4 class="text-danger ">There is no Category found ... </h4>
        </div>
        @endif
        <!-- END DATA TABLE -->
        <div class="">
            {{ $categories->appends(request()->query())->links()}}
        </div>
    </div>
</div>
@endsection
