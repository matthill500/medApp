@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="card">
        <div class="card-header">
          Edit Doctor
        </div>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form method="POST" action="{{route('admin.doctors.update', $doctors->id)}}">

            <input type="hidden" name="_method" value ="PUT">
            <input type="hidden" name="_token">
                {{ csrf_field() }}

            <div class="form-group">
              <label for="title">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{old('name', $doctors->name)}}" />
            </div>

            <div class="form-group">
              <label for="publisher">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone', $doctors->phone)}}" />
            </div>

            <div class="form-group">
              <label for="author">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="{{old('email', $doctors->email)}}" />
            </div>

            <div class="form-group">
              <label for="year">Eircode</label>
              <input type="text" class="form-control" id="eircode" name="eircode" value="{{old('eircode', $doctors->eircode)}}" />
            </div>

            <div class="form-group">
              <label for="isbn">Date Start</label>
              <input type="text" class="form-control" id="dateStart" name="dateStart" value="{{old('dateStart', $doctors->dateStart)}}" />
            </div>


            <a href="{{route('admin.doctors.index')}}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary float-right">Submit</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
