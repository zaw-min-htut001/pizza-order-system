

@extends('user.layouts.master')

@section('comtent')



        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5" id="dataTable">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ( $data as $d )
                                <tr>
                                <td class="align-middle"><img src="{{asset('storage/'.$d->image)}}" alt="" style="width: 50px;" class="m-3">{{ $d->name }}

                                    <input type="hidden" class="productId" value="{{ $d->product_id}}"></td>
                                    <input type="hidden" class="userId" value="{{ $d->user_id}}"></td>
                                    <input type="hidden" class="id" value="{{ $d->id}}"></td>



                                <td class="align-middle" id="price">{{ $d->price}} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $d->Qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $d->price*$d->Qty}} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="subTotal">{{ $totalPrice}} Kyats</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">3000 Kyats</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalPrice">{{ $totalPrice + 3000}} Kyats</h5>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="Order"><span>Proceed To Checkout</span></button>
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="removeOrder"><span> Clear Order</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->

@endsection
@section('scriptSource')
    <script>
            $(document).ready(function(){
                $('.btn-plus').click(function(){
                    $parentNode = $(this).parents('tr');
                    $price =Number($parentNode.find('#price').html().replace('Kyats',''));

                    $qty =Number($parentNode.find('#qty').val());
                    $total=$price*$qty;
                    $parentNode.find('#total').html($total+ " Kyats")
                    summaryCalu();
                })

                $('.btn-minus').click(function(){
                    $parentNode = $(this).parents('tr');
                    $price =Number($parentNode.find('#price').html().replace('Kyats',''));
                    $qty =Number($parentNode.find('#qty').val());

                    $total=$price*$qty;
                    $parentNode.find('#total').html($total+ " Kyats")
                    summaryCalu();

                })

                function summaryCalu(){

                    $totalPrice = 0;
                    $('#dataTable tr').each(function(index,row){
                        $totalPrice +=Number($(row).find('#total').text().replace('Kyats',''));

                    });
                    $('#subTotal').html(`${$totalPrice} Kyats`);
                    $('#finalPrice').html(`${$totalPrice+3000} Kyats`);
                }
            });
    </script>
    <script>
        $('#Order').click(function(){
            $orderList =[];
            $random = Math.floor(Math.random() * 100000001);
            $('#dataTable tbody tr').each(function(index,row){
                      $orderList.push({
                        'user_id' : $(row).find('.id').val(),
                        'product_id' : $(row).find('.productId').val(),
                        'qty' : $(row).find('#qty').val(),
                        'total' : $(row).find('#total').text().replace('Kyats','')*1,
                        'orderCode' :'POS' + $random

                      })

                    });
                    $.ajax({
                            type : 'get',
                            url : '/user/ajax/order',
                            data : Object.assign({},$orderList),
                            dataType : 'json' ,
                            success : function(response){
                                console.log(response)
                                if(response.status == 'true'){
                                    window.location.href ="/user/home";
                                }

                            }
                        })

        })
    </script>
    <script>
         $('#removeOrder').click(function(){
                $parentNode = $('#dataTable tbody tr');
                $parentNode.remove();
                $('#subTotal').html('0 Kyats');
                $('#finalPrice').html('0 Kyats');
                $.ajax({
                            type : 'get',
                            url : '/user/ajax/clear',
                            dataType : 'json' ,

                        })
        })

        $('.btnRemove').click(function(){
                    $parentNode = $(this).parents('tr');
                    $productId=$parentNode.find('.productId').val();
                    $id=$parentNode.find('.id').val();
                    $.ajax({
                            type : 'get',
                            url : '/user/ajax/delete',
                            data :{'productId' : $productId ,'id' : $id},
                            dataType : 'json' ,

                        })
                    $parentNode.remove();
                    $totalPrice = 0;
                    $('#dataTable tr').each(function(index,row){
                        $totalPrice +=Number($(row).find('#total').text().replace('Kyats',''));

                    });
                    $('#subTotal').html(`${$totalPrice} Kyats`);
                    $('#finalPrice').html(`${$totalPrice+3000} Kyats`);
                })
    </script>
@endsection
