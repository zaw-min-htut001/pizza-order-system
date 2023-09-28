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
                <a href="{{ route('product#create')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add pizza
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
            <form action="{{route('product#list')}}" method="get" class="d-flex justify-content-end">
                @csrf
                <input type="search" name="key" class="col-3 form-control" placeholder="Serach..." value="{{ request('key')}}">
                <button type="submit" class=" btn btn-dark">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <h3> Total -{{ $pizza->total() }}  results</h3>
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
        @if (count($pizza) != 0)
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead class="text-center">
                        <tr>
                            <th>Image</th>
                            <th> Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>View</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @foreach ($pizza as $p )
                        <tr class="tr-shadow">
                            <td class=" col-5"> <img src="{{ asset('storage/'.$p->image) }}" class="w-50 img-thumbnail"></td>
                            <td class=" col-5">{{ $p->name }}</td>
                            <td class=" col-5">{{ $p->price }}</td>
                            <td class=" col-5">{{ $p->category_name}}</td>
                            <td class=" col-5"><i class="fa-solid fa-eye"></i> {{ $p->view_count + 1}}</td>

                            <td class=" col-5">
                                <div class="table-data-feature ">
                                    <a href="{{ route('product#view',$p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('product#updatePage',$p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href=" {{ route('product#delete',$p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

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
            <div class="">
                {{ $pizza->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
