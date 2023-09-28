@extends('admin.layout.master')

@section('createPage')
<div class="container-fluid">
    <div class="col-lg-10 offset-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2"> Account Info Edit</h3>
                </div>


                <hr>
                <form action=" {{ route('admin#update',Auth::user()->id) }} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="image col-3 offset-2 me-5 ">
                            @if (Auth::user()->image == null )
                            @if (Auth::user()->gender == 'male') <img src="{{asset('image/'.'images (1).jpeg')}}" alt="">
                        @else <img src="{{asset('image/'.'images.jpeg')}}" alt=""> @endif
                            @else
                            <img src="{{ asset('storage/'.Auth::user()->image) }}"  />
                            @endif
                            <input type="file" name="image" id="" class="form-control mt-2">
                            <button type="submit" class="btn btn-dark col-12 mt-2">
                                Update <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="col-5  ">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" value="{{Auth::user()->name}}" type="text" class="form-control  @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                    @error("name")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Email</label>
                                    <input id="cc-pament" name="email" value="{{Auth::user()->email}}" type="email" class="form-control  @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                    @error("email")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Phone</label>
                                    <input id="cc-pament" name="phone" value="{{Auth::user()->phone}}" type="number" class="form-control  @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                    @error("phone")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Gender</label>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="">Choose gender...</option>
                                        <option value="male" @if (Auth::user()->gender == 'male' ) selected @endif>Male</option>
                                        <option value="female" @if (Auth::user()->gender == 'female' ) selected @endif>Female</option>

                                    </select>
                                    @error("gender")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1 @error('address') is-invalid @enderror">Address</label>
                                    <textarea name="address" id="" cols="30" rows="10" placeholder="Enter Admin Address...">{{Auth::user()->address}}</textarea>
                                    @error("address")
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Role</label>
                                    <input id="cc-pament" name="" value="{{Auth::user()->role}}" type="text" class="form-control " aria-required="true" aria-invalid="false" disabled>

                                </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
