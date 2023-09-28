@extends('user.layouts.master')

@section('comtent')
@if (session('completed'))
<div class="offset-8 col-4 mb-5">
    <div class="alert alert-success alert-dismissible fade show  " role="alert">
        <strong>{{ session('completed')}} </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
<form action="{{ route('user#contactData')}}" method="post">
    @csrf
    <div class="row d-block ">

            <div class="form-group col-md-4 offset-4">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group col-md-4 offset-4">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group col-md-4 offset-4">
                <label for="">Message</label>
                <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Message..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary  col-md-4 offset-4">Send</button>
    </div>

  </form>
@endsection
