@extends('admin.layouts.master')
@section('title','Add Banner')
@section('content')       
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-9">
                <h4 class="card-title">Add Banner | enter banner details and submit</h4>
              </div>
              <div class="col-md-3"><a href="{{url('admin/banners-list')}}">Back To List</a></div>
            </div>
            
            <form action="{{ url('admin/addUpdateBanner') }}" enctype="multipart/form-data" method="post" class="forms-sample">
              @csrf
              <div class="form-group row">
                <label for="Image" class="col-sm-3 col-form-label">Image<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="Image" name="Image" accept="image/jpg, image/png, image/jpeg">
                  
                  @error('Image')
                   <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Short Description<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Short Description">{{old('description')}}</textarea>
                  @error('description')
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
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="{{url('admin/banners-list')}}" class="btn btn-light">Cancel</a>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <!-- content-wrapper ends -->
@endsection