<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Users extends Controller
{
     public function index() {
        /*---------------------- get per page paging record show ------------------------------*/
           $iPerPagePagination  = perPagePaging();
        /*---------------------- get per page paging record show ------------------------------*/

         /*-------------- count data------------------*/
           $aListCount = DB::table('users')
                            ->where('is_deleted',N)
                            ->orderBy('id','desc')
                            ->count();
         /*-------------- count data------------------*/

         /*-------------- get data------------------*/
           $aListData = DB::table('users')
                        ->where('is_deleted',N)
                        ->orderBy('id','desc')
                        ->paginate($iPerPagePagination);
         /*-------------- get data------------------*/
         return view('admin.users.index',['aTotalData'=>$aListCount,'aLists'=>$aListData]);
     }
     public function fetchUserData(Request $request) 
     {
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
           
            $sListQuery = DB::table('users')
                ->select('users.*')
                ->where('users.is_deleted', N)
                ->whereIn('users.status',$filterStatusType)
                ->where(function ($query) use ($search) {
                    $query->where('users.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('users.email', 'LIKE', '%' . $search . '%');
                        

                })
                ->orderBy('users.'.$sort_by, $sort_type);
                
                $aLists  = $sListQuery->paginate($iPerPagePagination);
            /*------------ get paginate data ------------------*/

            /*------------ get total data ------------------*/

            $sTotalDataQuery = DB::table('users')
                ->select('users.*')
                ->where('users.is_deleted', N)
                ->whereIn('users.status',$filterStatusType)
                ->where(function ($query) use ($search) {
                     $query->where('users.name', 'LIKE', '%' . $search . '%')
                         ->orWhere('users.email', 'LIKE', '%' . $search . '%');
                         
                })
                ->orderBy('users.'.$sort_by, $sort_type);
               
                $aTotalData = $sTotalDataQuery->count();

            /*------------ get total data ------------------*/
            return view('admin.users.list', ['aLists' => $aLists, 'aTotalData' => $aTotalData])->render();
           }
     }
}
