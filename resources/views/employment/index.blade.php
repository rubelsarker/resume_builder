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
          <div class="card-title float-left"><h5>All Employment</h5></div>
          <a  data-toggle="modal" data-target="#addModal" role="button"  class="float-right btn btn-primary">Add New</a>
      </div>
      <div class="card-body">
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>Company</th>
                  <th>Designation</th>
                  <th>From</th>
                  <th>TO</th>
                  <th>Description</th>
                  <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $key => $row)
                  <tr>
                      <td>{{$row->company}}</td>
                      <td>{{$row->designation}}</td>
                      <td>{{date('d M Y',strtotime($row->from_year))}}</td>
                      <td>{{date('d M Y',strtotime($row->to_year))}}</td>
                      <td>{{Str::limit($row->desc,50,'...')}}</td>
                      <td class="text-center">
                          <a href="{{route('employment.edit',$row->id)}}" class="btn btn-info btn-sm">Edt</a>

                          <form id="delete-form{{ $row->id }}" method="post" action="{{ route('employment.destroy',$row->id) }}" style="display: none;">
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
                  <h4 class="modal-title">Add New Employment</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form action="{{route('employment.store')}}" method="POST" >
                  @csrf
                  <!-- Modal body -->
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="company">Company: <span class="required">*</span></label>
                          <input name="company" required type="text" class="form-control" placeholder="Company" id="company">
                      </div>
                      <div class="form-group">
                          <label for="designation">Designation: <span class="required">*</span></label>
                          <input name="designation" required type="text" class="form-control" placeholder="Designation" id="designation">
                      </div>
                      <div class="form-group">
                          <label for="from_year">From: <span class="required">*</span></label>
                          <input name="from_year" required type="date" class="form-control"  id="from_year">
                      </div>
                      <div class="form-group">
                          <label for="to_year">From: <span class="required">*</span></label>
                          <input name="to_year" required type="date" class="form-control"  id="to_year">
                      </div>

                      <div class="form-group">
                          <label for="desc">Description:</label>
                          <textarea name="desc" class="form-control" rows="5" id="desc"></textarea>
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
