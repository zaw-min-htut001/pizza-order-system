@extends('admin.layout.master')

@section('title','Category List')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">User Message</h2>

                </div>
            </div>

        </div>

        <div class="d-flex justify-content-end mt-3">
            <h3> Total -  {{ $contact->total()}} results</h3>
        </div>
        {{-- message --}}


         <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead class="text-center">
                    <tr>
                        <th>Name</th>
                        <th>User Email</th>
                        <th>Date</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="dataList">
                    @foreach ($contact as $c)
                    <tr class="tr-shadow">

                        <td>{{ $c->name}}</td>
                        <td>{{ $c->email}}</td>
                        <td>{{ $c->created_at->format('j-F-Y')}}</td>
                        <td>{{ $c->message}}</td>
                    @endforeach

                    </tr>

                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
        <div class="">
            {{ $contact->links()}}
        </div>
    </div>
</div>
@endsection
