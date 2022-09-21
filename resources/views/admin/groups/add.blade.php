@extends('admin.layouts.master')
@section('title','Add Group')
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
                <h4 class="card-title">Add Group | enter group details and submit</h4>
              </div>
              <div class="col-md-3"><a href="{{url('admin/groups-list')}}">Back To List</a></div>
            </div>
            
            <form action="{{ url('admin/addUpdateGroup') }}" enctype="multipart/form-data" method="post" class="forms-sample">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Group Name<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}">
                  @error('name')
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

              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Group Type</label>
                <div class="col-sm-9">
                  <select name="group_type" id="group_type" class="form-control">
                      <option value="Prayer">Prayer</option>
                      <option value="Exercise">Exercise</option>
                      <option value="Dancing">Dancing</option>
                      <option value="Foodie">Foodie</option>
                      <option value="Pets">Pets</option>
                      <option value="Travel">Travel</option>
                      <option value="Others">Others</option>
                  </select>
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
                <label for="description" class="col-sm-3 col-form-label">Description(Optional)<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Description">{{old('description')}}</textarea>
                  @error('description')
                   <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
           
            
          
             

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="{{url('admin/groups-list')}}" class="btn btn-light">Cancel</a>
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