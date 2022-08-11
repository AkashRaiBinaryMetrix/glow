<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Events extends Controller
{
     public function index() { 
         /*---------------------- get per page paging record show ------------------------------*/
         $iPerPagePagination  = perPagePaging();
         /*---------------------- get per page paging record show ------------------------------*/

         /*-------------- count data------------------*/
         $aTotalData = DB::table('events')
         ->where('is_deleted',N)
         ->orderBy('id','desc')
         ->count();
         /*-------------- count data------------------*/

         /*-------------- get data------------------*/
         $aLists = DB::table('events')
            ->where('is_deleted',N)
            ->orderBy('id','desc')
            ->paginate($iPerPagePagination);
         /*-------------- get data------------------*/
        return view('admin.events.index',['aTotalData'=>$aTotalData,'aLists'=>$aLists]);
     }
     public function addEvent() {
        return view('admin.events.add');
     }
     public function editEvent($id) {
        /*-------------------- get events details -------------*/
         $aDetail = DB::table('events')->where('id',$id)->first();
        /*-------------------- get events details -------------*/
        return view('admin.events.edit',['aDetail'=>$aDetail]);
     }
     public function addUpdateEvent(Request $request) {
            $request->validate(
               [
                  'name'=>'required',
                  'description'=>'required',
                  'Image'=>'required_without:old_image|max:2048|mimes:jpg,png,jpeg',
                  'eventStartDateTime'=>'required',
                  'eventEndDateTime'=>'required',
               ],
               [
                  'name.required'=>'Name is required',
                  'description.required'=>'Description is required',
                  'Image.required_without'=>'Image is required',
                  'Image.max'=>'You should upload only 2MB image',
                  'Image.mimes'=>'Only jpg, jpeg and png images are allowed',
                  'eventStartDateTime.required'=>'Event start date time is required',
                  'eventEndDateTime.required'=>'Event end date time is required',
               ]
           );
           $post = $request->input();
           $id = !empty($post['id'])  ? $post['id'] : '';
           $name = $post['name'];
           $description = $post['description'];
           $status = $post['status'];
           $eventStartDateTime = !empty($post['eventStartDateTime']) ? getCurrentLocalDateTime(TIME_ZONE_NAME,$post['eventStartDateTime']) : '';
           $sEventStartDateTime = !empty($eventStartDateTime) ? strtotime($eventStartDateTime) : '';
           $eventEndDateTime = !empty($post['eventEndDateTime']) ? getCurrentLocalDateTime(TIME_ZONE_NAME,$post['eventEndDateTime']) : '';
           $sEventEndDateTime = !empty($eventEndDateTime) ? strtotime($eventEndDateTime) : '';
           if($sEventStartDateTime >= $sEventEndDateTime) {
               $request->session()->flash('failureMsg','Event end date time can not be greater than the start date time');
               if(empty($id)) {
                   return redirect('admin/add-event');
               } else {
                   return redirect('admin/edit-event/'.$id); 
               }
           }
           /*------------------- get current date time -------------------*/
            $sCurrentDateTime = getCurrentLocalDateTime();
           /*------------------- get current date time -------------------*/
           $aData = [
              'name'=>$name,
              'long_description'=>$description,
              'status'=>$status,
              'created_at'=>$sCurrentDateTime,
              'start_date_time'=>$eventStartDateTime,
              'end_date_time'=>$eventEndDateTime,
           ];
           if($request->file('Image')){
                  $file= $request->file('Image');
                  $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                  $file->move(public_path('public/images/events'), $filename);
                  $aData['image']= $filename;
           }
           if(!empty($id)) {
                 $update = DB::table('events')->where('id',$id)->update($aData);
                 if($update) {
                      $request->session()->flash('status', 'success');
                      $request->session()->flash('successMsg','Events has been updated successfully');
                 } else {
                      $request->session()->flash('failureMsg','Events has not been updated');
                 }
           } else {
                $insert = DB::table('events')->insertGetId($aData);
                if($insert) {
                     $request->session()->flash('status', 'success');
                     $request->session()->flash('successMsg','Events has been updated successfully');
                } else {
                     $request->session()->flash('failureMsg','Events has not been updated');
                }
           }
           return redirect('admin/events-list');
     }
     public function fetchEventsData(Request $request) {
      if($request->ajax()) {
         $sort_by = $request->get('sortby');
         $sort_type = $request->get('sorttype');
         $search = $request->get('search');
         $filterStatus = $request->get('filterStatus');
         

          /*------------------- filter ----------------------*/
           if($filterStatus == ACTIVE) {
              $filterStatusType  = [ACTIVE];
           } else if($filterStatus == INACTIVE) {
              $filterStatusType  = [INACTIVE];
           } else {
              $filterStatusType  = [ACTIVE,INACTIVE];
           }
           

          /*------------------- filter ----------------------*/
          /*---------------------- get per page paging record show ------------------------------*/
            $iPerPagePagination  = perPagePaging();
        /*---------------------- get per page paging record show ------------------------------*/

         /*------------ get paginate data ------------------*/
         DB::enableQueryLog();
         $sListQuery = DB::table('events')
             ->select('events.*')
             ->where('events.is_deleted', N)
             ->whereIn('events.status',$filterStatusType)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('events.name', 'LIKE', '%' . $search . '%');
               }
                 
                     

             })
             ->orderBy('events.'.$sort_by, $sort_type);
             
             $aLists  = $sListQuery->paginate($iPerPagePagination);
            
         /*------------ get paginate data ------------------*/

         /*------------ get total data ------------------*/

         $sTotalDataQuery = DB::table('events')
             ->select('events.*')
             ->where('events.is_deleted', N)
             ->whereIn('events.status',$filterStatusType)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('events.name', 'LIKE', '%' . $search . '%');
               }
                      
             })
             ->orderBy('events.'.$sort_by, $sort_type);
            
             $aTotalData = $sTotalDataQuery->count();

         /*------------ get total data ------------------*/
         return view('admin.events.list', ['aLists' => $aLists, 'aTotalData' => $aTotalData])->render();
        }
     }
}
