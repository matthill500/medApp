@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="card">
        <div class="card-header">
          Doctor: {{ $doctors->name }}
        </div>
        <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Title</td>
              <td>{{ $doctors->name }}</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>{{ $doctors->phone }}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{{ $doctors->email }}</td>
            </tr>
            <tr>
              <td>Eircode</td>
              <td>{{ $doctors->eircode }}</td>
            </tr>
            <tr>
              <td>Start Date</td>
              <td>{{ $doctors->dateStart }}</td>
            </tr>

          </tbody>
        </table>

        <a href="{{ route('admin.doctors.index') }}" class="btn btn-default">Back</a>
        <a href="{{ route('admin.doctors.edit', $doctors->id) }}" class="btn btn-warning">Edit</a>
        <form style="display:inline-block" method="POST" action ="{{ route('admin.doctors.destroy', $doctors->user_id) }}">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="form-control btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
@endsection
