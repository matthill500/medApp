@extends('layouts.appAdmin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          patients
          <a href="{{route('admin.patients.create')}}" class="btn btn-primary float-right">Add</a>
        </div>
        @if (count($patients) === 0)
        <p> There are no patients</p>
        @else
        <table id="table-patients" class="table table-hover">
          <thead>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Medical Insurance</th>

          </thead>

          <tbody>

            @foreach ($patients as $patient)
              <tr data-id="{{$patient->user_id}}">
                <td>{{ $patient->user->name }}</td>
                <td>{{ $patient->phone }}</td>
                <td>{{ $patient->user->email }}</td>
                <td>{{ $patient->address }}</td>
                <td>{{ $patient->medInsurance->companyName }}</td>


                <td>
                  <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-default" >View</a>
                  <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning" value="edit" >Edit</a>

                  <form style="display:inline-block" method="POST" action ="{{ route('admin.patients.destroy', $patient->user_id) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div *ngIf="response" class="btn-group">
                    <button type="submit" class="form-control btn btn-danger">Delete</a>
                    </div>
                  </form>
                </td>
              </tr>

            @endforeach

          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
