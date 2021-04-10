@extends('layouts.app')
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif
  <div class="card">
      <div class="card-header">
          <div class="card-title float-left"><h5>Update Employment</h5></div>
          <a href="{{route('employment.index')}}"   class="float-right btn btn-primary">Back</a>
      </div>
      <div class="card-body">
          <form action="{{route('employment.update',$row->id)}}" method="POST" >
              @csrf
              @method('PUT')
              <div class="form-group">
                  <label for="company">Company: <span class="required">*</span></label>
                  <input value="{{$row->company}}" name="company" required type="text" class="form-control" placeholder="Company" id="company">
              </div>
              <div class="form-group">
                  <label for="designation">Designation: <span class="required">*</span></label>
                  <input value="{{$row->designation}}" name="designation" required type="text" class="form-control" placeholder="Designation" id="designation">
              </div>
              <div class="form-group">
                  <label for="from_year">From: <span class="required">*</span></label>
                  <input value="{{$row->from_year}}" name="from_year" required type="date" class="form-control"  id="from_year">
              </div>
              <div class="form-group">
                  <label for="to_year">From: <span class="required">*</span></label>
                  <input value="{{$row->to_year}}" name="to_year" required type="date" class="form-control"  id="to_year">
              </div>

              <div class="form-group">
                  <label for="desc">Description:</label>
                  <textarea name="desc" class="form-control" rows="5" id="desc">{{$row->desc}}</textarea>
              </div>
              <button type="submit" class="btn btn-primary float-right" >Submit</button>
          </form>
      </div>
  </div>

@endsection
