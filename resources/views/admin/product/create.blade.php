@extends('admin.layout.master')

@section('createPage')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Pizza Create</h3>
                </div>
                <hr>
                <form action="{{ route('product#pizzaCreate')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Name</label>
                        <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                        @error("name")
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Pizza Category</label>
                        <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                            <option value="">Choose Pizza Category</option>
                            @foreach ($Category as $c )
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        @error("pizzaCategory")
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1 ">Description</label>
                        <textarea name="pizzaDescription" id="" cols="30" rows="10" class=" form-control @error('pizzaDescription') is-invalid @enderror" placeholder='Enter Description ...'></textarea>
                        @error("pizzaDescription")
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Image</label>
                       <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">
                       @error("image")
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1 ">Waiting Time</label>
                        <input id="cc-pament" name="waitingTime" type="number" class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price...">
                        @error("waitingTime")
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1 ">Price</label>
                        <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price...">
                        @error("price")
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Create</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
