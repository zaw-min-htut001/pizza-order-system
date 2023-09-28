@extends('admin.layout.master')

@section('title','Category List')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <button><a href="{{ route('admin#orderList')}}" class="text-dark"><i class="fa-solid fa-arrow-left"></i></a></button>


        <div class="card col-5">
            <div class="card-header">
             <h6> Order Info</h6>
              <small class="text-danger">Include Delivery Fee</small>
            </div>
            <div class="card-body">
                <h6 class="mb-3">Customer Name :   {{ $data->name}}</h6>
                <h6 class="mb-3">Order Date :   {{ $data->created_at->format('j/F/y')}}</h6>
                <h6 class="mb-3">Order Code :   {{ $data->order_code}}</h6>
                <h6 class="mb-3">Total :   {{ $data->total_price}}</h6>
            </div>
          </div>

         <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead class="text-center">
                    <tr>
                        <th></th>

                        <th>Order ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="dataList">
                    @foreach ($order as $o)
                    <tr class="tr-shadow">
                        <td></td>
                        <td>{{ $o->id }}</td>
                        <td class="col-2"><img src="{{ asset('storage/'.$o->image)}}"  class="img-thumbnail"></td>
                        <td>{{ $o->product_name}}</td>
                        <td>{{ $o->created_at->format('j/F/y') }}</td>
                        <td>{{ $o->total}}</td>
                        <td>{{ $o->qty}}</td>
                    @endforeach

                    </tr>

                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->

    </div>
</div>
@endsection

