@extends('admin.layout.master')

@section('createPage')
<div class="container-fluid">
    <div class="col-lg-10 offset-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2"> Account Info </h3>
                </div>
                <hr>

                @if (session('update'))
                <div class="offset-8 col-4 ">
                    <div class="alert alert-primary alert-dismissible fade show  " role="alert">
                        <strong>{{ session('update')}} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="image col-3 offset-2 img-thumbnail shadow-sm me-5 ">
                        @if (Auth::user()->image == null )
                        @if (Auth::user()->gender == 'male') <img src="{{asset('image/'.'images (1).jpeg')}}" >
                        @else <img src="{{asset('image/'.'images.jpeg')}}" alt=""> @endif
                        @else
                        <img src="{{ asset('storage/'.Auth::user()->image) }}"  />
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 mt-4  ">
                        <h3 class=" my-3"><i class="fa-solid fa-user me-3"></i> {{ Auth::user()->name }}</h3>
                        <h3 class=" my-3"><i class="fa-solid fa-envelope me-3"></i> {{ Auth::user()->email }}</h3>
                        <h3 class=" my-3"><i class="fa-solid fa-phone me-3"></i> {{ Auth::user()->phone }}</h3>
                        <h3 class=" my-3"><i class="fa-solid fa-mars me-3"></i> {{ Auth::user()->gender  }}</h3>
                        <h3 class=" my-3"><i class="fa-solid fa-location-dot me-3"></i> {{ Auth::user()->address }}</h3>
                        <h3 class="my-3"><i class="fa-regular fa-calendar me-3"></i> {{ Auth::user()->created_at->format('F-j-Y')}}</h3>
                    </div>
                   <a href="{{ route('admin#edit')}}">
                        <button class="btn btn-dark col-3 text-light offset-2 mt-3">Edit Account</button>
                   </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
