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
          <div class="card-title float-left"><h5>Update Skill</h5></div>
          <a href="{{route('skill.index')}}"   class="float-right btn btn-primary">Back</a>
      </div>
      <div class="card-body">
          <form action="{{route('skill.update',$row->id)}}" method="POST" >
              @csrf
              @method('PUT')
              <div class="form-group">
                  <label for="skill">Skill: <span class="required">*</span></label>
                  <input value="{{$row->skill}}" name="skill" required type="text" class="form-control" placeholder="Skill" id="skill">
              </div>
              <div class="form-group">
                  <label for="skill_label">Skill Level: <span class="required">*</span></label>
                  <input value="{{$row->skill_label}}" name="skill_label" required type="text" class="form-control" placeholder="Skill Level" id="skill_label">
              </div>
              <button type="submit" class="btn btn-primary float-right" >Submit</button>
          </form>
      </div>
  </div>

@endsection
