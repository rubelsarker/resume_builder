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
          <div class="card-title float-left"><h5>Personal Info</h5></div>
      </div>
      <div class="card-body">
        <form action="{{route('personal.update','test')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="rowId" value="{{$row?$row->id:''}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="f_name">First Name: <span class="required">*</span></label>
                        <input value="{{$row?$row->f_name:''}}" name="f_name" required type="text" class="form-control" placeholder="First Name" id="f_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="l_name">Last Name: <span class="required">*</span></label>
                        <input value="{{$row?$row->l_name:''}}" name="l_name" required type="text" class="form-control" placeholder="Last Name" id="l_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Mobile: <span class="required">*</span></label>
                        <input value="{{$row?$row->mobile:''}}" name="mobile" required type="text" class="form-control" placeholder="Mobile" id="mobile">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email: <span class="required">*</span></label>
                        <input value="{{$row?$row->email:''}}" name="email" required type="email" class="form-control" placeholder="Email" id="email">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="designation">Designation: <span class="required">*</span></label>
                        <input  value="{{$row?$row->designation:''}}" name="designation" required type="text" class="form-control" placeholder="Designation" id="designation">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="image">Image:</label>
                                <input  type="file" class="form-control-file border" name="image" id="image">
                            </div>
                            <div class="col">
                                <img src="{{$row?URL::to($row->photo):"'https://ui-avatars.com/api/?background=1C88FD&color=ffffff&name='.Auth::user()->name"}}" style="height: 150px; width: 150px;" alt="User Photo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="about">About:</label>
                        <textarea name="about" class="form-control" rows="5" id="about">{{$row?$row->about:''}}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right" >Submit</button>
        </form>

      </div>
  </div>
    <div class="card mt-2">
        <div class="card-header">
            <div class="card-title float-left"><h5>Social Link</h5></div>
        </div>
        <div class="card-body">
            <form action="{{route('social.update','test')}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="rowId" value="{{$social?$social->id:''}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook">Facebook:</label>
                            <input value="{{$social?$social->facebook:''}}" name="facebook"  type="text" class="form-control" placeholder="Facebook" id="facebook">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitter">Twitter:</label>
                            <input value="{{$social?$social->twitter:''}}" name="twitter"  type="text" class="form-control" placeholder="Twitter" id="twitter">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linked_in">LinkedIn:</label>
                            <input value="{{$social?$social->linked_in:''}}" name="linked_in"  type="text" class="form-control" placeholder="LinkedIn" id="linked_in">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website">Website:</label>
                            <input value="{{$social?$social->website:''}}" name="website"  type="text" class="form-control" placeholder="Website" id="website">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right" >Submit</button>
            </form>

        </div>
    </div>
@endsection
