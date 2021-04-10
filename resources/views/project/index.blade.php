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
          <div class="card-title float-left"><h5>All Projects</h5></div>
          <a  data-toggle="modal" data-target="#addModal" role="button"  class="float-right btn btn-primary">Add New</a>
      </div>
      <div class="card-body">
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $key => $row)
                  <tr>
                      <td>
                          <img src="{{URL::to($row->image)}}" style="width: 55px; height: 55px;" alt="{{$row->title}}">
                      </td>
                      <td>{{$row->title}}</td>
                      <td>{{$row->type}}</td>
                      <td>{{Str::limit($row->sort_des,50,'...')}}</td>
                      <td class="text-center">
                          <a href="{{route('project.edit',$row->id)}}" class="btn btn-info btn-sm">Edt</a>

                          <form id="delete-form{{ $row->id }}" method="post" action="{{ route('project.destroy',$row->id) }}" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                          <a  onclick="
                              if (confirm('Are You Sure To Delete This?')){
                              event.preventDefault();
                              document.getElementById('delete-form{{ $row->id }}').submit();
                              }else {
                              event.preventDefault();
                              }
                              " class="btn btn-danger btn-sm">Delete</a>
                      </td>
                  </tr>
              @endforeach
              </tbody>
          </table>
      </div>
  </div>
  <!-- The Modal -->
  <div class="modal" id="addModal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Add New Project</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <!-- Modal body -->
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="title">Project Title: <span class="required">*</span></label>
                          <input name="title" required type="text" class="form-control" placeholder="Project Title" id="title">
                      </div>
                      <div class="form-group">
                          <label for="type">Type: <span class="required">*</span></label>
                          <select required name="type" class="form-control" id="type">
                              <option value="" disabled selected>Pls Select One </option>
                              <option value="Web">Web</option>
                              <option value="Graphics">Graphics</option>
                              <option value="Mobile Application">Mobile Application</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="image">Image: <span class="required">*</span></label>
                          <input required type="file" class="form-control-file border" name="image" id="image">
                      </div>
                      <div class="form-group">
                          <label for="sort_des">Description:</label>
                          <textarea name="sort_des" class="form-control" rows="5" id="sort_des"></textarea>
                      </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

@endsection
