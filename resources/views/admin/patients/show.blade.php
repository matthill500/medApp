@extends('layouts.appAdmin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="card">
        <div class="card-header">
          patient: {{ $patient->name }}
        </div>
        <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Title</td>
              <td>{{ $patient->user->name }}</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>{{ $patient->phone }}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{{ $patient->user->email }}</td>
            </tr>
            <tr>
              <td>Address</td>
              <td>{{ $patient->address }}</td>
            </tr>
          </tbody>
        </table>

        <a href="{{ route('admin.patients.index') }}" class="btn btn-default">Back</a>
        <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
        <form style="display:inline-block" method="POST" action ="{{ route('admin.patients.destroy', $patient->user_id) }}">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="form-control btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
@endsection
