@extends('admin.layouts.master')
@section('title','Add Event')
@section('content')       
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 grid-margin stretch-card">
        
        <div class="card">
          <div class="card-body">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @include('admin.layouts.session_message') 
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
              <div class="col-md-9">
                <h4 class="card-title">Add Event | enter event details and submit</h4>
              </div>
              <div class="col-md-3"><a href="{{url('admin/events-list')}}">Back To List</a></div>
            </div>
            
            <form action="{{ url('admin/addUpdateEvent') }}" enctype="multipart/form-data" method="post" class="forms-sample">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}">
                  @error('name')
                    <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="location" class="col-sm-3 col-form-label">Location<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{{old('location')}}">
                  @error('location')
                    <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Description<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Description">{{old('description')}}</textarea>
                  @error('description')
                   <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="Image" class="col-sm-3 col-form-label">Image<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="Image" name="Image">
                  @error('Image')
                   <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Start Date/Time(YYYY-MM-DD)<span class="required" style="color:red">*</span></label>
                <div class="col-sm-9">
                <input class="form-control" id="eventStartDateTime" name="eventStartDateTime" placeholder="Select Event Start Date/Time" value="{{old('eventStartDateTime')}}">
                @error('eventStartDateTime')
                   <div class="invalid-error">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label">End Date/Time(YYYY-MM-DD)<span class="required" style="color:red">*</span></label>
              <div class="col-sm-9">
              <input class="form-control" id="eventEndDateTime" name="eventEndDateTime" placeholder="Select Event End Date/Time" value="{{old('eventEndDateTime')}}">
              @error('eventEndDateTime')
                 <div class="invalid-error">{{ $message }}</div>
              @enderror
            </div>
          </div> 
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <select name="status" id="status" class="form-control">
                       <option value="<?=ACTIVE?>">Active</option>
                       <option value="<?=INACTIVE?>">Inactive</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Privacy</label>
                <div class="col-sm-9">
                  <select name="privacy" id="privacy" class="form-control">
                     <option value="<?=6?>">Public</option>
                     <option value="<?=5?>">Private</option>
                  </select>
                </div>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="{{url('admin/events-list')}}" class="btn btn-light">Cancel</a>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
  <script>
    $('#eventStartDateTime').datetimepicker({
      format:'Y-m-d H:i',
      step:1,
      minDate: new Date()
    });
    $('#eventEndDateTime').datetimepicker({
      format:'Y-m-d H:i',
      step:1,
      minDate: new Date()
    });
  </script>
@endsection