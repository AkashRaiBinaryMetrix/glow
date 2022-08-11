<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Common extends Controller
{
     public function changeStatus(Request $request) {
           $post = $request->input();
           if(!empty($post)) {
                $id = $post['id'] ?? '';
                $status = $post['status'] ?? '';
                $table = $post['table'] ?? '';
                $iNewStatus = !empty($status) ? INACTIVE : ACTIVE;
                if(!empty($table) && !empty($id)) {
                    $iUpdate =  DB::table($table)->where('id',$id)->update(['status'=>$iNewStatus]);
                    if($iUpdate) {
                        echo json_encode(['status'=>'success']);
                    } else {
                        echo json_encode(['status'=>'failure']);
                    }
                } else { 
                      echo json_encode(['status'=>'failure']);
                }
           } else {
                echo json_encode(['status'=>'failure']);
           }
      }
     public function delete(Request $request) {
          $post = $request->input();
          if(!empty($post)) {
               $id = $post['id'] ?? '';
               $table = $post['table'] ?? '';
               if(!empty($table) && !empty($id)) {
                   $iUpdate =  DB::table($table)->where('id',$id)->update(['is_deleted'=>Y]);
                   if($iUpdate) {
                       echo json_encode(['status'=>'success']);
                   } else {
                       echo json_encode(['status'=>'failure']);
                   }
               } else { 
                     echo json_encode(['status'=>'failure']);
               }
          } else {
               echo json_encode(['status'=>'failure']);
          }
     }
}
