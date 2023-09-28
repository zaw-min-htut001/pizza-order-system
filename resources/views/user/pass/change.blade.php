@extends('user.layouts.master')

@section('comtent')
    <div class="row mt-3">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Password change</h3>
                    </div>
                    <hr>
                    @if (session('PASS'))
                    <div class="col">
                        <div class="alert alert-success alert-dismissible fade show  " role="alert">
                            <strong>{{ session('PASS')}} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                    <form action="{{ route('user#passChange')}}" method="post" novalidate="novalidate">
                        @csrf

                        <div class="form-group my-2">
                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                            <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old password...">
                            @error("oldPassword")
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                            @if(session('notMatch'))
                            <div class="invalid-feedback"> {{ session('notMatch') }}</div>
                            @endif
                        </div>

                        <div class="form-group my-2">
                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                            <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New password...">
                            @error("newPassword")
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group my-2">
                            <label for="cc-payment" class="control-label mb-1">Comfirm Password</label>
                            <input id="cc-pament" name="comfirmPassword" type="password" class="form-control @error('comfirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Comfirm Password...">
                            @error("comfirmPassword")
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Change Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
