@if (!empty($aLists))
     @foreach ($aLists as $aList)
          <tr id="tr_{{$aList->id}}">
            <td>{{ !empty($aList->name) ? Str::replace('_*_',' ',$aList->name): ''}}</td>
            <td>{{ !empty($aList->email) ? $aList->email: ''}}</td>
            <td>{{ !empty($aList->zip_code) ? $aList->zip_code: ''}}</td>
            <td>{{ !empty($aList->denomination) ? $aList->denomination: ''}}</td>
            <td>{{ !empty($aList->church) ? $aList->church : ''}}</td>
            <td>
               <form id="changeStatus{{$aList->id}}" method="post" onsubmit="return ajax_change_status('changeStatus{{$aList->id}}','{{url('admin/changeStatus')}}','',{{$aList->id}})">
                 @csrf
                 <input type="hidden" name="table" id="table{{$aList->id}}" value="users">
                 <input type="hidden" name="status" id="status{{$aList->id}}" value="{{$aList->status}}">
                 <input type="hidden" name="id" id="id{{$aList->id}}" value="{{$aList->id}}">
                 <div id="statusChange{{$aList->id}}" onclick="submitUpdateStatus('changeStatus{{$aList->id}}')">
                  <a href="javascript:void(0)" class="badge badge-{{ !empty($aList->status) ? 'success' : 'danger'}}">{{ !empty($aList->status) ? 'Active' : 'Inactive'}}</a>
                 </div>
              </form>
            </td>
            <td>
               <div class="row">
                <form  class
                ="icons-list" id="delete{{$aList->id}}" method="post" onsubmit="return ajax_delete_record('delete{{$aList->id}}','{{url('admin/delete')}}','',{{$aList->id}})">
                    @csrf
                    <input type="hidden" name="table" id="table{{$aList->id}}" value="users">
                    <input type="hidden" name="id" id="id{{$aList->id}}" value="{{$aList->id}}">
                    <div class="col-md-12">
                        <i class="mdi mdi-delete" onclick="submitForm('{{$aList->id}}')" title="Delete"></i>
                    </div>
                  </form>
               </div>
            </td>
          </tr>
     @endforeach
@endif
@if ($aLists && $aLists->hasPages())
{{-- <tr>
    <td colspan="8" style="border:0px;">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                Showing {{ ($aLists->currentpage() - 1) * $aLists->perpage() + 1 }} to
                {{ $aLists->currentpage() != $aLists->lastpage() ? $aLists->currentpage() * $aLists->perpage() : $aTotalData }}
                of {{ $aTotalData }} Records
           
            <div class="">{!! $aLists->links() !!} </div>
            </ul>

        </div>
    </td>
</tr> --}}

@endif
