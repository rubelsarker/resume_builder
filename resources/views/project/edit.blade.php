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
          <div class="card-title float-left"><h5>Update Project</h5></div>
          <a href="{{route('project.index')}}"   class="float-right btn btn-primary">Back</a>
      </div>
      <div class="card-body">
          <form action="{{route('project.update',$row->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                  <label for="title">Project Title: <span class="required">*</span></label>
                  <input value="{{$row->title}}" name="title" required type="text" class="form-control" placeholder="Project Title" id="title">
              </div>
              <div class="form-group">
                  <label for="type">Type: <span class="required">*</span></label>
                  <select required name="type" class="form-control" id="type">
                      <option value="" disabled selected>Pls Select One </option>
                      <option {{$row->type == 'Web' ? 'selected' : '' }} value="Web">Web</option>
                      <option {{$row->type == 'Graphics' ? 'selected' : '' }} value="Graphics">Graphics</option>
                      <option {{$row->type == 'Mobile Application' ? 'selected' : '' }} value="Mobile Application">Mobile Application</option>
                  </select>
              </div>
              <div class="form-group">
                  <div class="row">
                      <div class="col">
                          <label for="image">Image:</label>
                          <input  type="file" class="form-control-file border" name="image" id="image">
                      </div>
                      <div class="col">
                          <img src="{{URL::to($row->image)}}" style="height: 150px; width: 150px;" alt="{{$row->title}}">
                      </div>
                  </div>

              </div>
              <div class="form-group">
                  <label for="sort_des">Description:</label>
                  <textarea name="sort_des" class="form-control" rows="5" id="sort_des">{{$row->sort_des}}</textarea>
              </div>
              <button type="submit" class="btn btn-primary float-right" >Submit</button>
          </form>
      </div>
  </div>

@endsection
