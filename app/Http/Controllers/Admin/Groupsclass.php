<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Groupclass extends Controller
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
     
}
