@extends('admin.layouts.master')
@section('title','Edit Banner')
@section('content')       
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-9">
                <h4 class="card-title">Edit Banner | enter banner details and submit</h4>
              </div>
              <div class="col-md-3"><a href="{{url('admin/banners-list')}}">Back To List</a></div>
            </div>
            
            <form action="{{ url('admin/addUpdateBanner') }}" enctype="multipart/form-data" method="post" class="forms-sample">
              @csrf
              <input type="hidden" name="id" value="{{!empty($aDetail->id) ? $aDetail->id : old('id')}}">
              <div class="form-group row">
                <label for="Image" class="col-sm-3 col-form-label">Image<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="Image" name="Image">
                  <input type="hidden" class="form-control" id="old_image" name="old_image" value="{{!empty($aDetail->image) ? $aDetail->image : old('old_image')}}">
                  @error('Image')
                   <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Short Description<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Short Description">{{!empty($aDetail->short_description) ? $aDetail->short_description : old('description')}}</textarea>
                  @error('description')
                   <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <select name="status" id="status" class="form-control">
                       <option value="<?=ACTIVE?>" {{  ($aDetail->status == ACTIVE ? 'selected' : old('status') == ACTIVE)  ?  'selected' : '' }}>Active</option>
                       <option value="<?=INACTIVE?>" {{ ($aDetail->status == INACTIVE ? 'selected' : old('status') == INACTIVE) ?  'selected' : '' }}>Inactive</option>
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