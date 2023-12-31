@extends('admin.layout.master')

@section('createPage')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2"> Edit your Category </h3>
                </div>
                <hr>
                <form action="{{ route('category#update',$edit->id)}}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="updateId" value="{{ $edit->id }}">
                        <label for="cc-payment" class="control-label mb-1">Name</label>
                        <input value="{{ $edit->name }}" name="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                        @error("category_name")
                            <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Upadte </span>
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
