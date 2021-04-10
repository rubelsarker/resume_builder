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
          <div class="card-title float-left"><h5>Update Education</h5></div>
          <a href="{{route('education.index')}}"   class="float-right btn btn-primary">Back</a>
      </div>
      <div class="card-body">
          <form action="{{route('education.update',$row->id)}}" method="POST" >
              @csrf
              @method('PUT')
              <div class="form-group">
                  <label for="degree">Degree: <span class="required">*</span></label>
                  <input value="{{$row->degree}}" name="degree" required type="text" class="form-control" placeholder="Degree" id="degree">
              </div>
              <div class="form-group">
                  <label for="institute">Institute: <span class="required">*</span></label>
                  <input value="{{$row->institute}}" name="institute" required type="text" class="form-control" placeholder="Institute" id="institute">
              </div>
              <div class="form-group">
                  <label for="result">Result: <span class="required">*</span></label>
                  <input value="{{$row->result}}" name="result" required type="text" class="form-control" placeholder="Result"  id="result">
              </div>
              <div class="form-group">
                  <label for="passing_year">Passing Year: <span class="required">*</span></label>
                  <input value="{{$row->passing_year}}" name="passing_year" required type="text" class="form-control" placeholder="Passing Year"  id="passing_year">
              </div>
              <button type="submit" class="btn btn-primary float-right" >Submit</button>
          </form>
      </div>
  </div>

@endsection
