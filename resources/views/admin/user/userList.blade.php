@extends('admin.layout.master')

@section('title','Category List')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <!-- DATA TABLE -->


        <div class="d-flex justify-content-end mt-3">
            <h3> Total -  {{ $users->total()}} results</h3>
        </div>
        {{-- message --}}


         <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead class="text-center">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-center" id="dataList">

                  @foreach ($users as $user )
                  <tr class="tr-shadow">

                    <td class="">
                        @if ($user->image == null )
                        @if ($user->gender == 'male') <img src="{{asset('image/'.'images (1).jpeg')}}" alt="">
                        @else <img src="{{asset('image/'.'images.jpeg')}}" alt=""> @endif
                        @else
                        <img src="{{ asset('storage/'.$user->image) }}"  />
                        @endif
                    </td>
                    <input type="hidden" class="userId" value="{{ $user->id}}">
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->phone}}</td>
                    <td>{{ $user->gender}}</td>
                    <td>{{ $user->address}}</td>
                    <td>
                        <select class="form-control" id="roleChange">
                            <option value="admin" @if($user->role == 'user') selected @endif>Admin</option>
                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin#adminUserDelete',$user->id)}}">
                            <button class="item fs-5" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete  text-danger"></i>
                            </button>
                        </a>
                    </td>

                </tr>



                  @endforeach

                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
        <div class="">
            {{ $users->links()}}
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
            $(document).ready(function(){
                $('#roleChange').change(function(){
                   $changeStatus = $('#roleChange').val();
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
