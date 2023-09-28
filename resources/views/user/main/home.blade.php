@extends('user.layouts.master')

@section('comtent')
<a href="" onclick="history.back()"></a>
        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Sidebar Start -->
                <div class="col-lg-3 col-md-4">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by price</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-light">

                                <label class=" m-3" for="price-all">Category</label>
                                <span class="badge border font-weight-normal m-3">{{  $category->count()}}</span>
                            </div>
                            <div class="mb-3" >
                                <a href="{{ route('user#home')}}" class="text-dark text-decoration-none ">All</a>
                            </div>
                          @foreach ( $category as $c )
                            <div class=" d-flex align-items-center justify-content-between mb-3">

                               <a href="{{ route('user#filter',$c->id)}}" class="text-dark"> <label class="" for="price-1">{{ $c->name }}</label></a>

                            </div>
                          @endforeach

                        </form>
                    </div>
                    <!-- Price End -->
                    <div class="">
                        <button class="btn btn btn-warning w-100">Order</button>
                    </div>
                </div>
                <!-- Shop Sidebar End -->


                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4" >
                                <div>
                                    <a href="{{ route('user#cartList')}}">
                                        <button type="button" class="btn btn-dark position-relative" >
                                            <i class="fa-solid fa-cart-shopping"></i>

                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($cart)}}
                                              <span class="visually-hidden">unread messages</span>
                                            </span>
                                          </button>
                                    </a>
                                    <a href="{{ route('user#history')}}">
                                        <button type="button" class="btn btn-dark position-relative ms-3" >
                                             History

                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($order)}}
                                              <span class="visually-hidden">unread messages</span>
                                            </span>
                                          </button>
                                    </a>
                                </div>
                                <div class="ml-2">
                                       <div>
                                        <select class="form-control" id="sortingOption" name="sorting">
                                            <option value=""  class="">Choose Option</option>
                                            <option value="asc"  class="">Ascending</option>
                                            <option value="desc" class="" >Descending</option>
                                        </select>

                                       </div>
                                </div>
                            </div>
                        </div>

                        <div id="dataList" class="row">
                            @if (count($data) != 0)
                            @foreach ( $data as $d )
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                              <div class="product-item bg-light mb-4">
                                  <div class="product-img position-relative overflow-hidden">
                                      <img class="img-fluid w-100 " style="height: 200px" src="{{ asset('storage/'.$d->image)}}" alt="">
                                      <div class="product-action">
                                          <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                          <a class="btn btn-outline-dark btn-square" href="{{ route('user#details',$d->id)}} "><i class="fa-solid fa-circle-info"></i></a>
                                      </div>
                                  </div>
                                  <div class="text-center py-4">
                                      <a class="h6 text-decoration-none text-truncate" href="">{{ $d->name}}</a>
                                      <div class="d-flex align-items-center justify-content-center mt-2">
                                          <h5>{{ $d->price}} kyats</h5><h6 class="text-muted ml-2"></h6>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center mb-1">
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                      </div>
                                  </div>
                              </div>
                          </div>

                            @endforeach
                            @else
                               <div class="text-center row">
                                <h3 class="text-center bg-danger text-light col-8 offset-2 p-3 rounded-pill">There is no Pizza...  <i class="fa-solid fa-pizza-slice"></i></h3>
                               </div>
                            @endif
                        </div>

                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
@endsection

@section('scriptSource')
        <script>
            $(document).ready(function(){

               $('#sortingOption').change(function(){
                    $eventOption =$('#sortingOption').val();
                    if($eventOption == 'asc'){
                        $.ajax({
                            type : 'get',
                            url : '/user/ajax/list',
                            data :{ 'status' : 'asc' },
                            dataType : 'json' ,
                            success : function(response){
                                $list = " ";
                                for($i=0;$i<response.length;$i++){
                                    $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                              <div class="product-item bg-light mb-4">
                                  <div class="product-img position-relative overflow-hidden">
                                      <img class="img-fluid w-100 " style="height: 200px" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                      <div class="product-action">
                                          <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                          <a class="btn btn-outline-dark btn-square" href="{{ route('user#details',$d->id)}} "><i class="fa-solid fa-circle-info"></i></a>
                                      </div>
                                  </div>
                                  <div class="text-center py-4">
                                      <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                      <div class="d-flex align-items-center justify-content-center mt-2">
                                          <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"></h6>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center mb-1">
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                      </div>
                                  </div>
                              </div>
                          </div>
                                            `;
                                }
                                $('#dataList').html($list);

                            }
                        })
                    }else{
                        $.ajax({
                            type : 'get',
                            url : '/user/ajax/list',
                            data :{ 'status' : 'desc' },
                            dataType : 'json' ,
                            success : function(response){
                                $list = " ";
                                for($i=0;$i<response.length;$i++){
                                    $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                              <div class="product-item bg-light mb-4">
                                  <div class="product-img position-relative overflow-hidden">
                                      <img class="img-fluid w-100 " style="height: 200px" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                      <div class="product-action">
                                          <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                          <a class="btn btn-outline-dark btn-square" href="{{ route('user#details',$d->id)}} "><i class="fa-solid fa-circle-info"></i></a>
                                      </div>
                                  </div>
                                  <div class="text-center py-4">
                                      <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                      <div class="d-flex align-items-center justify-content-center mt-2">
                                          <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"></h6>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center mb-1">
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                          <small class="fa fa-star text-primary mr-1"></small>
                                      </div>
                                  </div>
                              </div>
                          </div>

                                            `;
                                }
                                $('#dataList').html($list);

                            }
                        })
                    }
               })

            });
        </script>
@endsection
