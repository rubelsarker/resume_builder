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
          <div class="card-title float-left"><h5>All Education</h5></div>
          <a  data-toggle="modal" data-target="#addModal" role="button"  class="float-right btn btn-primary">Add New</a>
      </div>
      <div class="card-body">
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>Degree</th>
                  <th>Institute</th>
                  <th>Result</th>
                  <th>Passing Year</th>
                  <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $key => $row)
                  <tr>
                      <td>{{$row->degree}}</td>
                      <td>{{$row->institute}}</td>
                      <td>{{$row->result}}</td>
                      <td>{{$row->passing_year}}</td>
                      <td class="text-center">
                          <a href="{{route('education.edit',$row->id)}}" class="btn btn-info btn-sm">Edt</a>

                          <form id="delete-form{{ $row->id }}" method="post" action="{{ route('education.destroy',$row->id) }}" style="display: none;">
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
                  <h4 class="modal-title">Add New Education</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form action="{{route('education.store')}}" method="POST" >
                  @csrf
                  <!-- Modal body -->
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="degree">Degree: <span class="required">*</span></label>
                          <input name="degree" required type="text" class="form-control" placeholder="Degree" id="degree">
                      </div>
                      <div class="form-group">
                          <label for="institute">Institute: <span class="required">*</span></label>
                          <input name="institute" required type="text" class="form-control" placeholder="Institute" id="institute">
                      </div>
                      <div class="form-group">
                          <label for="result">Result: <span class="required">*</span></label>
                          <input name="result" required type="text" class="form-control" placeholder="Result"  id="result">
                      </div>
                      <div class="form-group">
                          <label for="passing_year">Passing Year: <span class="required">*</span></label>
                          <input name="passing_year" required type="text" class="form-control" placeholder="Passing Year"  id="passing_year">
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
