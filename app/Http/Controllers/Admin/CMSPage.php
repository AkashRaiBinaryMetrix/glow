<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CMSPage extends Controller
{
    public function index() { 
      /*---------------------- get per page paging record show ------------------------------*/
      $iPerPagePagination  = perPagePaging();
      /*---------------------- get per page paging record show ------------------------------*/

        /*-------------- count data------------------*/
        $aTotalData = DB::table('cms')
        ->where('is_deleted',N)
        ->orderBy('id','desc')
        ->count();
        /*-------------- count data------------------*/

        /*-------------- get data------------------*/
        $aLists = DB::table('cms')
           ->where('is_deleted',N)
           ->orderBy('id','desc')
           ->paginate($iPerPagePagination);
        /*-------------- get data------------------*/
       return view('admin.cms.index',['aLists' => $aLists, 'aTotalData' => $aTotalData]);
    }
    public function addCMSPage() {
       return view('admin.cms.add');
    }
    public function editCMSPage($id) {
       /*-------------------- get cms page details -------------*/
        $aDetail = DB::table('cms')->where('id',$id)->first();
       /*-------------------- get cms page details -------------*/
       return view('admin.cms.edit',['aDetail'=>$aDetail]);
    }
    public function addUpdateCMSPage(Request $request) {
           $post = $request->input();
           $id   = !empty($post['id'])  ? $post['id'] : '';
           $request->validate(
              [
                 'title'=>'required|unique:cms,title,'.$id.',id',
                 'slug'=>'required',
                 'short_description'=>'required',
                 'long_description'=>'required',
              ],
              [
                 'title.required'=>'Title is required',
                 'slug.required'=>'Slug is required',
                 'short_description.required'=>'Short description is required',
                 'long_description.required'=>'Long description is required',
              ]
          );
          
          $title = $post['title'];
          $slug = $post['slug'];
          $short_description = $post['short_description'];
          $long_description = $post['long_description'];
          $status = $post['status'];
          $aData = [
             'title'=>$title,
             'slug'=>$slug,
             'short_description'=>$short_description,
             'long_description'=>$long_description,
             'status'=>$status
          ];
          if(!empty($id)) {
                $update = DB::table('cms')->where('id',$id)->update($aData);
                if($update) {
                     $request->session()->flash('status', 'success');
                     $request->session()->flash('successMsg','CMS page has been updated successfully');
                } else {
                     $request->session()->flash('failureMsg','CMS page has not been updated');
                }
          } else {
               $insert = DB::table('cms')->insertGetId($aData);
               if($insert) {
                    $request->session()->flash('status', 'success');
                    $request->session()->flash('successMsg','CMS page has been updated successfully');
               } else {
                    $request->session()->flash('failureMsg','CMS page has not been updated');
               }
          }
          return redirect('admin/cms-page-list');
    }
    public function fetchCMSPageData(Request $request) {
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
         
         $sListQuery = DB::table('cms')
             ->select('cms.*')
             ->where('cms.is_deleted', N)
             ->whereIn('cms.status',$filterStatusType)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('cms.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('cms.short_description', 'LIKE', '%' . $search . '%');
               }
                 
                     

             })
             ->orderBy('cms.'.$sort_by, $sort_type);
             
             $aLists  = $sListQuery->paginate($iPerPagePagination);
            
         /*------------ get paginate data ------------------*/

         /*------------ get total data ------------------*/

         $sTotalDataQuery = DB::table('cms')
             ->select('cms.*')
             ->where('cms.is_deleted', N)
             ->whereIn('cms.status',$filterStatusType)
             ->where(function ($query) use ($search) {
               if(!empty($search)) {
                  $query->where('cms.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('cms.short_description', 'LIKE', '%' . $search . '%');
               }
                      
             })
             ->orderBy('cms.'.$sort_by, $sort_type);
            
             $aTotalData = $sTotalDataQuery->count();

         /*------------ get total data ------------------*/
         return view('admin.cms.list', ['aLists' => $aLists, 'aTotalData' => $aTotalData])->render();
        }
    }    
   
    public function upload_image_cke(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
