@extends('admin.layouts.master')
@section('title','Edit CMS Page')
@section('content')       
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row" >
              <div class="col-md-9">
                <h4 class="card-title">Edit CMS Page | enter cms page details and submit</h4>
              </div>
              <div class="col-md-3"> <a href="{{url('admin/cms-page-list')}}">Back To List</a></div>
            </div>
            
            <form action="{{ url('admin/addUpdateCMSPage') }}" enctype="multipart/form-data" method="post" class="forms-sample">
              @csrf
              <input type="hidden" name="id" value="{{!empty($aDetail->id) ? $aDetail->id : old('id')}}">
              <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Title<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="title" name="title" onkeyup="convertToSlug(this.value)" placeholder="Title" value="{{!empty($aDetail->title) ? $aDetail->title : old('title')}}">
                  @error('title')
                    <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="slug" class="col-sm-3 col-form-label">Slug<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="slug" name="slug" readonly placeholder="Slug" value="{{!empty($aDetail->slug) ? $aDetail->slug : old('slug')}}">
                  @error('slug')
                    <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="short_description" class="col-sm-3 col-form-label">Short Description<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description" value="{{!empty($aDetail->short_description) ? $aDetail->short_description : old('short_description')}}">
                  @error('short_description')
                   <div class="invalid-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="long_description" class="col-sm-3 col-form-label">Long Description<span style="color:red">*</span></label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="long_description" name="long_description" placeholder="Long Description">{{!empty($aDetail->long_description) ? $aDetail->long_description : old('long_description')}}</textarea>
                  @error('long_description')
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
              <a href="{{url('admin/cms-page-list')}}" class="btn btn-light">Cancel</a>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
  <script type="text/javascript">
    CKEDITOR.replace('long_description', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    function convertToSlug(Text) {
        let slug = Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        $('#slug').val(slug);
    }
  </script>
@endsection