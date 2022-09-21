<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Group extends Controller
{
    public function index() { 
         /*---------------------- get per page paging record show ------------------------------*/
         $iPerPagePagination  = perPagePaging();
         /*---------------------- get per page paging record show ------------------------------*/

         /*-------------- count data------------------*/
         $aTotalData = DB::table('groups')
         ->where('is_deleted',N)
         ->orderBy('id','desc')
         ->count();
         /*-------------- count data------------------*/

         /*-------------- get data------------------*/
         $aLists = DB::table('groups')
            ->where('is_deleted',N)
            ->orderBy('id','desc')
            ->paginate($iPerPagePagination);
         /*-------------- get data------------------*/
        return view('admin.groups.index',['aTotalData'=>$aTotalData,'aLists'=>$aLists]);
     }

     public function fetchGroupsData(Request $request) {
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

           $groupCategory = array("Prayer","Exercise","Dancing","Foodie","Pets","Travel","Others");
           print_r($filterStatus);
           if(in_array( $filterStatus,$groupCategory)){
            $groupCategoryType = [$filterStatus];
           }else{
            $groupCategoryType = $groupCategory;
           }

           
           
          /*------------------- filter ----------------------*/
          /*---------------------- get per page paging record show ------------------------------*/
            $iPerPagePagination  = perPagePaging();
         /*---------------------- get per page paging record show ------------------------------*/

         /*------------ get paginate data ------------------*/
         DB::enableQueryLog();

         if(is_numeric(strtotime($filterStatus))){
                $filterDate = [$filterStatus];
                $sListQuery = DB::table('groups')
             ->select('groups.*')
             ->where('groups.is_deleted', N)
             ->whereIn('groups.status',$filterStatusType)
             ->whereIn('groups.group_category',$groupCategoryType)
             ->whereDate('groups.created_at', '=', $filterDate)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('groups.name', 'LIKE', '%' . $search . '%');
               }
             })
             ->orderBy('groups.'.$sort_by, $sort_type);
         }elseif(empty($filterStatus)){
                $sListQuery = DB::table('groups')
             ->select('groups.*')
             ->where('groups.is_deleted', N)
             ->whereIn('groups.status',$filterStatusType)
             ->whereIn('groups.group_category',$groupCategoryType)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('groups.name', 'LIKE', '%' . $search . '%');
               }
             })
             ->orderBy('groups.'.$sort_by, $sort_type);
         }else{
$sListQuery = DB::table('groups')
             ->select('groups.*')
             ->where('groups.is_deleted', N)
             ->whereIn('groups.status',$filterStatusType)
             ->whereIn('groups.group_category',$groupCategoryType)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('groups.name', 'LIKE', '%' . $search . '%');
               }
             })
             ->orderBy('groups.'.$sort_by, $sort_type);
         }

         
             
             $aLists  = $sListQuery->paginate($iPerPagePagination);
            
         /*------------ get paginate data ------------------*/

         /*------------ get total data ------------------*/

         $sTotalDataQuery = DB::table('groups')
             ->select('groups.*')
             ->where('groups.is_deleted', N)
             ->whereIn('groups.status',$filterStatusType)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('groups.name', 'LIKE', '%' . $search . '%');
               }    
             })
             ->orderBy('groups.'.$sort_by, $sort_type);
            
             $aTotalData = $sTotalDataQuery->count();

         /*------------ get total data ------------------*/
         return view('admin.groups.list', ['aLists' => $aLists, 'aTotalData' => $aTotalData])->render();
        }
     }

    public function addGroup() {
        return view('admin.groups.add');
    }

    public function addUpdateGroup(Request $request) {
            $request->validate(
               [
                  'name'=>'required',
                  'Image'=>'required_without:old_image|max:2048|mimes:jpg,png,jpeg',
               ],
               [
                  'name.required'=>'Name is required',
                  'Image.required_without'=>'Image is required',
                  'Image.max'=>'You should upload only 2MB image',
                  'Image.mimes'=>'Only jpg, jpeg and png images are allowed',
               ]
           );

           $post = $request->input();

           $id = !empty($post['id'])  ? $post['id'] : '';

           $name = $post['name'];
           $description = $post['description'];
           $status = $post['status'];
           $privacy = $post['privacy'];
           $group_type = $post['group_type'];
           
           /*------------------- get current date time -------------------*/
            $sCurrentDateTime = getCurrentLocalDateTime();
           /*------------------- get current date time -------------------*/
           
           $aData = [
              'name'=>$name,
              'description'=>$description,
              'status'=>$status,
              'created_at'=>$sCurrentDateTime,
              'group_type' => ($privacy == 6)? "Public" : "Private",
              'group_category' => $group_type
           ];

           if($request->file('Image')){
                  $file= $request->file('Image');
                  $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                  $file->move(public_path('public/images/groups'), $filename);
                  $aData['image']= $filename;
           }
           
           if(!empty($id)) {
                 $update = DB::table('groups')->where('id',$id)->update($aData);
                 if($update) {
                      $request->session()->flash('status', 'success');
                      $request->session()->flash('successMsg','Group has been updated successfully');
                 } else {
                      $request->session()->flash('failureMsg','Groups has not been updated');
                 }
           } else {
                $insert = DB::table('groups')->insertGetId($aData);
                if($insert) {
                     $request->session()->flash('status', 'success');
                     $request->session()->flash('successMsg','Group has been updated successfully');
                } else {
                     $request->session()->flash('failureMsg','Group has not been updated');
                }
           }
           
           return redirect('admin/groups-list');
     }

    public function editGroup($id) {
        /*-------------------- get events details -------------*/
         $aDetail = DB::table('groups')->where('id',$id)->first();
        /*-------------------- get events details -------------*/
        return view('admin.groups.edit',['aDetail'=>$aDetail]);
    }
}
