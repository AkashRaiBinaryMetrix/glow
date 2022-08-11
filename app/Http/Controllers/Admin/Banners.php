<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Banners extends Controller
{
    public function index() { 
        /*---------------------- get per page paging record show ------------------------------*/
        $iPerPagePagination  = perPagePaging();
        /*---------------------- get per page paging record show ------------------------------*/

        /*-------------- count data------------------*/
        $aTotalData = DB::table('banners')
        ->where('is_deleted',N)
        ->orderBy('id','desc')
        ->count();
        /*-------------- count data------------------*/

        /*-------------- get data------------------*/
        $aLists = DB::table('banners')
           ->where('is_deleted',N)
           ->orderBy('id','desc')
           ->paginate($iPerPagePagination);
        /*-------------- get data------------------*/
       return view('admin.banners.index',['aTotalData'=>$aTotalData,'aLists'=>$aLists]);
    }
    public function addBanner() {
       return view('admin.banners.add');
    }
    public function editBanner($id) {
       /*-------------------- get banners details -------------*/
        $aDetail = DB::table('banners')->where('id',$id)->first();
       /*-------------------- get banners details -------------*/
       return view('admin.banners.edit',['aDetail'=>$aDetail]);
    }
    public function addUpdateBanner(Request $request) {
           $post = $request->input();
           $request->validate(
              [
                 'description'=>'required',
                 'Image'=>'required_without:old_image|max:2048|mimes:jpg,png,jpeg'
              ],
              [
                 'description.required'=>'Short description is required',
                 'Image.required_without'=>'Image is required',
                 'Image.max'=>'You should upload only 2MB image',
                 'Image.mimes'=>'Only jpg, jpeg and png images are allowed',
              ]
          );
          
          $id = !empty($post['id'])  ? $post['id'] : '';
          $description = $post['description'];
          $status = $post['status'];
          /*------------------- get current date time -------------------*/
           $sCurrentDateTime = getCurrentLocalDateTime();
          /*------------------- get current date time -------------------*/
          $aData = [
             'short_description'=>$description,
             'status'=>$status,
             'created_at'=>$sCurrentDateTime
          ];
          if($request->file('Image')){
                 $file= $request->file('Image');
                 $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                 $file->move(public_path('images/banners'), $filename);
                 $aData['image']= $filename;
          }
          
          if(!empty($id)) {
                $update = DB::table('banners')->where('id',$id)->update($aData);
                if($update) {
                     $request->session()->flash('status', 'success');
                     $request->session()->flash('successMsg','Banner has been updated successfully');
                } else {
                     $request->session()->flash('failureMsg','Banner has not been updated');
                }
          } else {
               $insert = DB::table('banners')->insertGetId($aData);
               if($insert) {
                    $request->session()->flash('status', 'success');
                    $request->session()->flash('successMsg','Banner has been updated successfully');
               } else {
                    $request->session()->flash('failureMsg','Banner has not been updated');
               }
          }
          return redirect('admin/banners-list');
    }
    public function fetchBannersData(Request $request) {
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
        $sListQuery = DB::table('banners')
            ->select('banners.*')
            ->where('banners.is_deleted', N)
            ->whereIn('banners.status',$filterStatusType)
            ->orderBy('banners.'.$sort_by, $sort_type);
            
            $aLists  = $sListQuery->paginate($iPerPagePagination);
           
        /*------------ get paginate data ------------------*/

        /*------------ get total data ------------------*/

        $sTotalDataQuery = DB::table('banners')
            ->select('banners.*')
            ->where('banners.is_deleted', N)
            ->whereIn('banners.status',$filterStatusType)
            ->orderBy('banners.'.$sort_by, $sort_type);
           
            $aTotalData = $sTotalDataQuery->count();

        /*------------ get total data ------------------*/
        return view('admin.banners.list', ['aLists' => $aLists, 'aTotalData' => $aTotalData])->render();
       }
    }
}
