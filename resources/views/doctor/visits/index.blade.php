@extends('layouts.appDoctor')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          My Patient Visits
          <a href="{{route('doctor.visits.create')}}" class="btn btn-primary float-right">Add</a>
        </div>
        @if (count($visits) === 0)
        <p> There are no visits</p>
        @else
        <table id="table-visits" class="table table-hover">
          <thead>
            <th>Visit Time</th>
            <th>Visit Date</th>
            <th>Duration</th>
            <th>Cost</th>
            <th>Doctor</th>
            <th>Patient</th>

          </thead>

          <tbody>

            @foreach ($visits as $visit)
            @if($visit->doctor_id === Auth::User()->doctor->id)

              <tr data-id="{{$visit->id}}">
                <td>{{ $visit->visitTime }}</td>
                <td>{{ $visit->visitDate }}</td>
                <td>{{ $visit->duration }}</td>
                <td>{{ $visit->cost }}</td>
                <td>{{ $visit->doctor->user->name }}</td>
                <td>{{ $visit->patient->user->name }}</td>
                <td>

                  <a href="{{ route('doctor.visits.edit', $visit->id) }}" class="btn btn-warning" value="edit" >Edit</a>

                  <form style="display:inline-block" method="POST" action ="{{ route('doctor.visits.destroy', $visit->id) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div *ngIf="response" class="btn-group">
                    <button type="submit" class="form-control btn btn-danger">Cancel Visit</a>
                    </div>
                  </form>
                </td>
              </tr>
              @endif
            @endforeach

          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
