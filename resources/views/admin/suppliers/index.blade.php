@extends('layouts.adminLayout.admin-layout')
@section('title', 'Suppliers')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Suppliers List</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Supplier Name</th>
                    <th>Profile</th>
                    <th>Address</th>          
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Added On</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($suppliers) > 0)
                        @foreach($suppliers as $key => $supplier)
                        <tr>
                        <td><strong>{{$key+1}}.</strong></td>           
                        <td>{{$supplier['supplier_name']}}</td>
                        <td>
                            <img src="{{ asset('public/images/supplier_images')}}/{{$supplier['supplier_image']}}" class="img-fluid" width="100" height="100">
                        </td>
                        <td>{{$supplier['supplier_address']}}</td>
                        <td>{{$supplier['supplier_rating']}}</td>
                        <td>
                        @if($supplier['status']==1)
                            <button class="btn btn-success">Approved</button>
                        @elseif($supplier['status']==0)
                            <button class="btn btn-warning">UnApproved</button>
                        @else
                            <button class="btn btn-danger">Rejected</button>
                        @endif
                        </td>
                        <td>{{$supplier['added_on']}}</td>
                        <td>
                            <a href="{{route('admin.supplier.view', $supplier['id'])}}" class="href">View</a>
                        </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" style="text-align:center;color:red">Supplier is not available</td>
                        </tr>
                    @endif      
                </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
