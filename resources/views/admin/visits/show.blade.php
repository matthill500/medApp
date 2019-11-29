@extends('layouts.appAdmin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="card">
        <div class="card-header">
          Visit: {{ $visit->patient->user->name }}
        </div>
        <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Visit Time</td>
              <td>{{ $visit->visitTime }}</td>
            </tr>
            <tr>
              <td>Visit Date</td>
              <td>{{ $visit->visitDate  }}</td>
            </tr>
            <tr>
              <td>Duration</td>
              <td>{{ $visit->duration }}</td>
            </tr>
            <tr>
              <td>Cost</td>
              <td>{{ $visit->cost }}</td>
            </tr>
            <tr>
              <td>Doctor</td>
              <td>{{ $visit->doctor->user->name  }}</td>
            </tr>
            <tr>
              <td>Patient</td>
              <td>{{ $visit->patient->user->name }}</td>
            </tr>
          </tbody>
        </table>

        <a href="{{ route('admin.visits.index') }}" class="btn btn-default">Back</a>
        <a href="{{ route('admin.visits.edit', $visit->id) }}" class="btn btn-warning">Edit</a>
        <form style="display:inline-block" method="POST" action ="{{ route('admin.visits.destroy', $visit->user_id) }}">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="form-control btn btn-danger">Delete</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
