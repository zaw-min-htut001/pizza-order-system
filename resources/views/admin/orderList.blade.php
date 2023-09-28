@extends('admin.layout.master')

@section('title','Category List')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">Order List</h2>

                </div>
            </div>

        </div>

        {{-- serach --}}
        <div class="">
            {{-- serch key --}}
        <div class="mt-2">
            <h4 class="text-danger">Serach Key : {{ request('key')}}</h4>
        </div>
            <form action="{{ route('admin#orderList')}}" method="get" class="d-flex justify-content-end">
                @csrf
                <input type="search" name="key" id="" class="col-3 form-control" placeholder="Serach..." value="{{ request('key')}}">
                <button type="submit" class=" btn btn-dark">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <form action="{{ route('admin#filter')}}" method="get" class="col-5">
            @csrf
            <div class="input-group">
                <select name="filterStatus" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                  <option value="">All</option>
                  <option value="0" @if ((request()->filterStatus) == '0')
                        selected
                  @endif>Pending...</option>
                  <option value="1" @if ((request()->filterStatus) == '1')
                        selected
                  @endif>Accept...</option>
                  <option value="2" @if ((request()->filterStatus) == '2')
                        selected
                  @endif>Reject</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">Sreach</button>
              </div>
        </form>
        <div class="d-flex justify-content-end mt-3">
            <h3> Total - {{ $order->count()}}  results</h3>
        </div>
        {{-- message --}}


         <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead class="text-center">
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Date</th>
                        <th>Order Code</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="dataList">
                    @foreach ($order as $o)
                    <tr class="tr-shadow">
                        <input type="hidden" class="orderId" value="{{ $o->id}}">
                        <td>{{ $o->user_id }}</td>
                        <td>{{ $o->name }}</td>
                        <td>{{ $o->created_at->format('j/F/y') }}</td>
                        <td><a href="{{ route('admin#orderInfo',$o->order_code)}}">{{ $o->order_code}}</a></td>
                        <td>{{ $o->total_price}}</td>
                        <td>
                            <select name="status" id="status" class="form-control">
                                <option value="0" @if ($o->status == 0)
                                    selected
                                @endif>Pending</option>
                                <option value="1" @if ($o->status == 1)
                                    selected
                                @endif>Accept</option>
                                <option value="2" @if ($o->status == 2)
                                    selected
                                @endif>Reject</option>
                            </select>
                        </td>
                    @endforeach

                    </tr>

                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
        <div class="">
            {{-- {{ $categories->appends(request()->query())->links()}} --}}
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
            $(document).ready(function(){
                // $('#orderStatus').change(function(){
                //     $status =$('#orderStatus').val();
                //     $.ajax({
                //             type : 'get',
                //             url : 'http://127.0.0.1:8000/admin/filter',
                //             data :{ 'status' : $status },
                //             dataType : 'json' ,
                //             success : function(response){
                //                 $list = " ";
                //                 for($i=0;$i<response.length;$i++){

                //                     $month=['January','February','March',"April",'May','June','July','August','September','October','November','December'];
                //                     $dbDate =new Date(response[$i].created_at);
                //                     $finalDate=$month[$dbDate.getMonth()] +'-'+ $dbDate.getDate() +'-'+ $dbDate.getFullYear();
                //                     if(response[$i].status == 0){
                //                         $statusMessage = `
                //                             <select name="status" id="" class="form-control">
                //                                 <option value="0" selected>Pending</option>
                //                                 <option value="1">Accept</option>
                //                                 <option value="2">Reject</option>
                //                             </select>
                //                         `;
                //                     }else if(response[$i].status == 1){
                //                         $statusMessage = `
                //                             <select name="status" id="" class="form-control">
                //                                 <option value="0" >Pending</option>
                //                                 <option value="1" selected>Accept</option>
                //                                 <option value="2">Reject</option>
                //                             </select>
                //                         `;
                //                     }else if(response[$i].status == 2){
                //                         $statusMessage = `
                //                             <select name="status" id="" class="form-control">
                //                                 <option value="0" >Pending</option>
                //                                 <option value="1" >Accept</option>
                //                                 <option value="2" selected> Reject</option>
                //                             </select>
                //                         `;
                //                     }
                //                     $list += `
                //                     <tr class="tr-shadow">
                //                         <td>${response[$i].user_id}</td>
                //                         <td>${response[$i].name}</td>
                //                         <td>${$finalDate}</td>
                //                         <td>${response[$i].order_code}</td>
                //                         <td>${response[$i].total_price}</td>
                //                         <td>${$statusMessage}</td>
                //                     </tr>
                //                             `;
                //                 }
                //                 $('#dataList').html($list)
                //             }
                //         })
                // })
                $('#status').change(function(){
                   $changeStatus = $('#status').val();
                   $parentNode = $(this).parents('tr');
                   $orderId=$parentNode.find('.orderId').val();
                   $data ={
                        'status' : $changeStatus,
                        'id' :$orderId
                   };

                   $.ajax({
                            type : 'get',
                            url : '/admin/change',
                            data :$data,
                            dataType : 'json' ,
                   })
                })

            })

    </script>
@endsection
