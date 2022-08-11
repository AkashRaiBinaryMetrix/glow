@if (!empty($aLists))
     @foreach ($aLists as $aList)
          <tr id="tr_{{$aList->id}}">
            <td>{{ !empty($aList->name) ? $aList->name : ''}}</td>
            <td>
               <a href="{{ url('public/images/events/'.$aList->image) }}" target="_blank"><img src="{{ asset('public/images/events/'.$aList->image) }}"></a>
            </td>
            <td>{{ !empty($aList->long_description) && Str::length($aList->long_description) > 50 ? $aList->long_description.'...' : $aList->long_description}}</td>
            <td>{{ !empty($aList->start_date_time) ? $aList->start_date_time : '' }}</td>
            <td>{{ !empty($aList->end_date_time) ? $aList->end_date_time : '' }}</td>
            <td>
               <form id="changeStatus{{$aList->id}}" method="post" onsubmit="return ajax_change_status('changeStatus{{$aList->id}}','{{url('admin/changeStatus')}}','',{{$aList->id}})">
                 @csrf
                 <input type="hidden" name="table" id="table{{$aList->id}}" value="events">
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
                    <input type="hidden" name="table" id="table{{$aList->id}}" value="events">
                    <input type="hidden" name="id" id="id{{$aList->id}}" value="{{$aList->id}}">
                    <div class="col-md-12">
                        <i class="mdi mdi-delete" onclick="submitForm('{{$aList->id}}')" title="Delete"></i>
                    </div>
                  </form>
                 </div>
                 <div class="col-md-6">
                  <form  class
                  ="icons-list" id="edit{{$aList->id}}" method="post" action="{{url('admin/edit-event/'.$aList->id.'')}}">
                      @csrf
                      <input type="hidden" name="table" id="table{{$aList->id}}" value="events">
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
