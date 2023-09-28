

@extends('user.layouts.master')

@section('comtent')



        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 offset-2 table-responsive mb-5" id="dataTable">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order Id</th>
                                <th>Total Price</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($order as $o )
                            <tr>
                                <td class="align-middle" >{{$o->created_at->format('j-F-Y') }}</td>
                                <td class="align-middle" >{{$o->order_code }} </td>
                                <td class="align-middle" >{{$o->total_price }} Kyats</td>
                                    @if ($o->status == 0)
                                        <td class="align-middle text-warning" >Pending...</td>
                                    @elseif($o->status == 1)
                                        <td class="align-middle text-success" >Success...</td>
                                    @elseif ($o->status == 2)
                                        <td class="align-middle text-danger" >Reject...</td>
                                    @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $order->links()}}
                </div>

            </div>
        </div>
        <!-- Cart End -->

@endsection
