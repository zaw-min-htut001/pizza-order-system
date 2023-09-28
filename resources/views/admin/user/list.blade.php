@extends('admin.layout.master')

@section('title','Category List')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">Account List</h2>

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
            <form action="#" method="get" class="d-flex justify-content-end">
                @csrf
                <input type="search" name="key" id="" class="col-3 form-control" placeholder="Serach..." value="{{ request('key')}}">
                <button type="submit" class=" btn btn-dark">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <h3> Total -{{ $admin->total()}} results</h3>
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

        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead class="text-center">
                    <tr>
                        <th class=" fs-5">Image</th>
                        <th class=" fs-5">Name</th>
                        <th class=" fs-5">Email</th>
                        <th class=" fs-5">Phone</th>
                        <th class=" fs-5">Gender</th>
                        <th class=" fs-5">Address</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @foreach ($admin as $a)
                    <tr class="tr-shadow">
                        <input type="hidden" class="userId" value="{{ $a->id}}">
                        <th class="col-2">@if ($a->image == null)
                            @if ($a->gender == 'male') <img src="{{asset('image/'.'images (1).jpeg')}}" alt="">
                            @else <img src="{{asset('image/'.'images.jpeg')}}" alt=""> @endif
                        @else
                            <img src="{{asset('storage/'.$a->image)}}" alt="">
                        @endif</th>
                        <th class="fs-4">{{ $a->name}}</th>
                        <th class="fs-4">{{ $a->email}}</th>
                        <th class="fs-4">{{ $a->phone}}</th>
                        <th class="fs-4">{{ $a->gender}}</th>
                        <th class="fs-4">{{ $a->address}}</th>

                        <th class="fs-5">
                            <div class="table-data-feature ">
                        @if (Auth::user()->id != $a->id)
                               <select id="adminListRole" class="form-control me-3">
                                    <option value="admin" @if ($a->role == 'admin')
                                        selected
                                    @endif>Admin</option>
                                    <option value="user" @if ($a->role == 'user')
                                        selected
                                    @endif>User</option>
                               </select>
                        <a href="{{ route('admin#delete',$a->id)}}">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete  text-danger"></i>
                            </button>
                        </a>
                        @endif
                    </div></th>
                    @endforeach

                    </tr>

                </tbody>

            </table>
        </div>
        <!-- END DATA TABLE -->
        <div class="">
            {{ $admin->links()}}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#adminListRole').change(function(){
           $changeStatus = $('#adminListRole').val();
           $parentNode = $(this).parents('tr');
           $userId=$parentNode.find('.userId').val();
           $data ={
                'status' : $changeStatus,
                'id' :$userId
           };

           $.ajax({
                    type : 'get',
                    url : '/user/ajax/role',
                    data :$data,
                    dataType : 'json' ,
           })
           location.reload();
         })

    })

</script>
@endsection
