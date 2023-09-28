@extends('admin.layout.master')

@section('createPage')
<div class="container-fluid">
    <div class="col-lg-10 offset-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2"> Pizza Info Edit</h3>
                </div>


                <hr>
                <form action=" {{ route('product#update') }} " method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pizzaId" value={{$pizzaUpdate->id}}>
                    <div class="row">
                        <div class="image col-3 offset-2 me-5 ">
                            <img src="{{ asset('storage/'.$pizzaUpdate->image) }}" alt="John Doe" />

                            <input type="file" name="image" id="" class="form-control mt-2 @error('image') is-invalid @enderror">
                            @error("image")
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-dark col-12 mt-2">
                                Update <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="col-5  ">

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" value="{{old('name',$pizzaUpdate->name)}}" type="text" class="form-control  @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                    @error("name")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" id="" cols="30" rows="10" class=" @error('pizzaDescription') is-invalid @enderror" placeholder="Enter description">{{old('pizzaDescription',$pizzaUpdate->description)}}</textarea>
                                    @error("pizzaDescription")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input placeholder="Enter Price" id="cc-pament" name="price" value="{{old('price',$pizzaUpdate->price)}}" type="number" class="form-control  @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error("price")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Pizza category</label>
                                    <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                        <option value="">Choose Pizza Category...</option>
                                       @foreach ( $categories as $c )
                                       <option value="{{ $c->id }}" @if ($c->id == $pizzaUpdate->category_id)
                                           selected
                                       @endif>{{ $c->name}}</option>
                                       @endforeach

                                    </select>
                                    @error("pizzaCategory")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1 @error('waitingTime') is-invalid @enderror">WaitingTime</label>
                                    <input id="cc-pament" name="waitingTime" value="{{old('waitingTime',$pizzaUpdate->waiting_time)}}" type="number" class="form-control  @error('WaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time..">
                                    @error("waitingTime")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">View Count</label>
                                    <input id="cc-pament" name="" value="{{ $pizzaUpdate->view_count}}" type="text" class="form-control " aria-required="true" aria-invalid="false" disabled>

                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Created at</label>
                                    <input id="cc-pament" name="" value="{{ $pizzaUpdate->created_at}}" type="text" class="form-control " aria-required="true" aria-invalid="false" disabled>

                                </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
