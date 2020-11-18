@extends('layouts.adminLayout.admin-layout')
@section('title', 'Polls')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Polls List</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Poll Title</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($polls) > 0)
                        @foreach($polls as $key => $poll)
                        <tr>
                        <td><strong>{{$key+1}}.</strong></td>           
                        <td>{{$poll['poll_name']}}</td>
                        <td>{{$poll['added_by']}}</td>
                        <td>{{$poll['added_on']}}</td>
                        <td>
                        @if($poll['status']==1)
                            <button class="btn btn-success">Approved</button>
                        @elseif($poll['status']==0)
                            <button class="btn btn-warning">UnApproved</button>
                        @else
                            <button class="btn btn-danger">Rejected</button>
                        @endif     
                        </td>                        
                        <td>
                            <a href="{{route('admin.poll.view',$poll['id'])}}" class="href">View</a>
                        </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" style="text-align:center;color:red">Poll is not available</td>
                        </tr>
                    @endif      
                </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
