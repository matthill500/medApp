@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          doctors
          <a href="{{route('admin.doctors.create')}}" class="btn btn-primary float-right">Add</a>
        </div>
        @if (count($doctors) === 0)
        <p> There are no doctors</p>
        @else
        <table id="table-doctors" class="table table-hover">
          <thead>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Eircode</th>
            <th>Date Start</th>
          </thead>

          <tbody>

            @foreach ($doctors as $doctor)
              <tr data-id="{{$doctor->user_id}}">
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->eircode }}</td>
                <td>{{ $doctor->dateStart }}</td>

                <td>
                  <a href="{{ route('admin.doctors.show', $doctor->id) }}" class="btn btn-default" >View</a>
                  <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-warning" value="edit" >Edit</a>

                  <form style="display:inline-block" method="POST" action ="{{ route('admin.doctors.destroy', $doctor->user_id) }}">
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
