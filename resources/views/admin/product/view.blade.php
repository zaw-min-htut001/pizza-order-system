@extends('admin.layout.master')

@section('createPage')
    <div class="container-fluid">
        <div class="col-lg-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>
                        <h3 class="text-center title-2"> Pizza Details </h3>
                    </div>
                    <hr>

                    @if (session('update'))
                        <div class="offset-8 col-4 ">
                            <div class="alert alert-primary alert-dismissible fade show  " role="alert">
                                <strong>{{ session('update') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class=" col-3 ">

                            <img src="{{ asset('storage/' . $data->image) }}" class="img-thumbnail shadow-sm me-5" />

                        </div>

                        <div class="col-9  ">
                            <div class=" my-3 btn btn-danger text-white d-block w-25">{{ $data->name }}</div>
                            <span class=" my-3 btn btn-danger text-black"><i class="fa-solid fa-money-bill-wave"></i>
                                {{ $data->price }} Kyats</span>
                            <span class=" my-3 btn btn-danger text-black"><i class="fa-solid fa-clock"></i>
                                {{ $data->waiting_time }} mins</span>
                            <span class=" my-3 btn btn-danger text-black"><i class="fa-regular fa-eye"></i>
                                {{ $data->view_count }}</span>
                            <span class=" my-3 btn btn-danger text-black"><i class="fa-solid fa-database"></i>
                                {{ $data->category_name }}</span>
                            <span class=" my-3 btn btn-danger text-black"><i class="fa-regular fa-calendar me-3"></i>
                                {{ $data->created_at->format('j-F-Y') }}</span>
                            <div class=" d-block text-dark text-decoration-underline"> Details</div>
                            <span>{{ $data->description }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 ">
                            <a href="{{ route('admin#edit') }}">
                                <button class="btn btn-dark text-light  mt-3">Edit Pizza</button>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
