@if (!empty($aLists))
     @foreach ($aLists as $aList)
          <tr id="tr_{{$aList->id}}">
            <td>{{ !empty($aList->name) ? $aList->name : ''}}</td>
            <td>
               <a href="{{ url('public/images/groups/'.$aList->image) }}" target="_blank"><img src="{{ asset('public/images/groups/'.$aList->image) }}"></a>
            </td>
            <td>{{ !empty($aList->description) && Str::length($aList->description) > 50 ? $aList->description.'...' : $aList->description}}</td>
            <td>
               <form id="changeStatus{{$aList->id}}" method="post" onsubmit="return ajax_change_status('changeStatus{{$aList->id}}','{{url('admin/changeStatus')}}','',{{$aList->id}})">
                 @csrf
                 <input type="hidden" name="table" id="table{{$aList->id}}" value="groups">
                 <input type="hidden" name="status" id="status{{$aList->id}}" value="{{$aList->status}}">
                 <input type="hidden" name="id" id="id{{$aList->id}}" value="{{$aList->id}}">
                 <div id="statusChange{{$aList->id}}" onclick="submitUpdateStatus('changeStatus{{$aList->id}}')">
                    <a href="javascript:void(0)" class="badge badge-{{ !empty($aList->status) ? 'success' : 'danger'}}">{{ !empty($aList->status) ? 'Active' : 'Inactive'}}</a>
                 </div>
              </form>
            </td>
            <td>
               <div class="row">
                <div class="col-md-6">
                <form  class
                ="icons-list" id="delete{{$aList->id}}" method="post" onsubmit="return ajax_delete_record('delete{{$aList->id}}','{{url('admin/delete')}}','',{{$aList->id}})">
                    @csrf
                    <input type="hidden" name="table" id="table{{$aList->id}}" value="groups">
                    <input type="hidden" name="id" id="id{{$aList->id}}" value="{{$aList->id}}">
                    <div class="col-md-12">
                        <i class="mdi mdi-delete" onclick="submitForm('{{$aList->id}}')" title="Delete"></i>
                    </div>
                  </form>
                 </div>
                 <div class="col-md-6">
                  <form  class
                  ="icons-list" id="edit{{$aList->id}}" method="post" action="{{url('admin/edit-group/'.$aList->id.'')}}">
                      @csrf
                      <input type="hidden" name="table" id="table{{$aList->id}}" value="groups">
                      <input type="hidden" name="id" id="id{{$aList->id}}" value="{{$aList->id}}">
                      <div class="col-md-12">
                          <i class="mdi mdi-table-edit" onclick="$('#edit{{$aList->id}}').submit()" title="Edit"></i>
                      </div>
                    </form>
                 </div>
               </div>
            </td>
          </tr>
     @endforeach
@endif
