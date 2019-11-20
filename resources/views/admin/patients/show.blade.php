@extends('layouts.appAdmin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="card">
        <div class="card-header">
          patient: {{ $patients->name }}
        </div>
        <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Title</td>
              <td>{{ $patients->name }}</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>{{ $patients->phone }}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{{ $patients->email }}</td>
            </tr>
            <tr>
              <td>Address</td>
              <td>{{ $patients->address }}</td>
            </tr>
          </tbody>
        </table>

        <a href="{{ route('admin.patients.index') }}" class="btn btn-default">Back</a>
        <a href="{{ route('admin.patients.edit', $patients->id) }}" class="btn btn-warning">Edit</a>
        <form style="display:inline-block" method="POST" action ="{{ route('admin.patients.destroy', $patients->user_id) }}">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="form-control btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
@endsection
