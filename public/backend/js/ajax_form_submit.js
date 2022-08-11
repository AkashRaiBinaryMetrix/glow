
function submitUpdateStatus(sChangeStatusId) {
     $('#'+sChangeStatusId).submit();
}

function submitForm(id) {
    ajax_delete_record('delete' + id, 'admin/delete', 'tr_' + id);
}

 function ajax_delete_record(formId,urlPath,uniqueId) {
  let crm = confirm('Are you sure you want to delete record ?');
  if(crm == true)
  {
     console.log("submit event");
     var fd = new FormData(document.getElementById(formId));
     fd.append("label", "WEBUPLOAD");
     $.ajax({
       url: BASE_URL+urlPath,
       type: "POST",
       data: fd,
       processData: false,  // tell jQuery not to process the data
       contentType: false   // tell jQuery not to set contentType
     }).done(function( data ) {
         console.log("PHP Output:");
         let result = JSON.parse(data);
         if(result.status == 'success')
         {
               $('#'+uniqueId).remove();
               $('#msg1').show();
               $('#msg1').html(`Record has been deleted successfully`);
               $('#msg1').fadeOut(3000);
         }
         else
         {
            $('#msg1').show();
            $('#msg1').html(`Record has not been deleted. Please try again later`);
            $('#msg1').fadeOut(3000);
         }
     });
  }
   return false;
}
function ajax_form_submit(formId,urlPath,location) {
     console.log("submit event");
     var fd = new FormData(document.getElementById(formId));
     fd.append("label", "WEBUPLOAD");
     $.ajax({
       url: urlPath,
       type: "POST",
       data: fd,
       processData: false,  // tell jQuery not to process the data
       contentType: false   // tell jQuery not to set contentType
     }).done(function( data ) {
         console.log("PHP Output:");
         console.log( data );

         if(location!=''){
            window.location = location;
         }

     });
    return false;
}

function ajax_change_status(formId,urlPath,location,uniqueId) {
      let crm = confirm('Are you sure you want to change status?');
      if(crm == true) {
       var status = $('#'+formId).find('#status'+uniqueId).val();
       console.log("submit event");
       var fd = new FormData(document.getElementById(formId));
       fd.append("label", "WEBUPLOAD");
       $.ajax({
         url: urlPath,
         type: "POST",
         data: fd,
         processData: false,  // tell jQuery not to process the data
         contentType: false   // tell jQuery not to set contentType
       }).done(function( data ) {
         let result = JSON.parse(data);
         if(result.status == 'success')
         {

             if(status == 1)
             {

               $('#'+formId).find('#status'+uniqueId).val('0');
               $('#'+formId).find('#statusChange'+uniqueId).html('<a href="javascript:void(0)" class="badge badge-danger">Inactive</a>');
             }
             else if(status == 0)
             {

               $('#'+formId).find('#status'+uniqueId).val('1');
               $('#'+formId).find('#statusChange'+uniqueId).html('<a href="javascript:void(0)" class="badge badge-success">Active</a>');
             } else if(status == 'not_approved') {
               $('#'+formId).find('#status').val('approved');
               $('#'+formId).find('#statusChangeAppUser'+uniqueId).html('<input type="submit" class="btn btn-label-success active-btn" value="Approved">');
               $('#'+formId).find('#statusChangeAppUser'+uniqueId).attr('disabled',true);
             } else if(status == 'approved') {
               $('#'+formId).find('#status').val('disapproved');
               $('#'+formId).find('#statusChange'+uniqueId).html('<input type="submit" class="btn btn-label-danger active-btn" value="Disapproved">');

             } else if(status == 'disapproved') {
               $('#'+formId).find('#status').val('approved');
               $('#'+formId).find('#statusChange'+uniqueId).html('<input type="submit" class="btn btn-label-success active-btn" value="Approved">');
             }
         }
         else
         {
           alert('Status has not been updated. Please try again');
         }
       });
       return false;
    }
    return false;
}

function ajax_change_status_on_condition(formId,urlPath,location,uniqueId,checkActiveInactive) {
   let crm = confirm('Are you sure you want to change status ?');
   if(crm == true)
   {
       var status               = $('#'+formId).find('#status'+uniqueId).val();
       var approved_status      = $('#statusChangeAppUserApproved'+uniqueId).find('#status'+uniqueId).val();
       var approved_status_wall = $('#statusChangeWallPostApproved'+uniqueId).find('#status'+uniqueId).val();


       if(checkActiveInactive == 'active_incative') {
           if(approved_status == 'not_approved') {
             $('#msg1').show();
             $('#msg1').html('<p style="text-align:center">Sorry ! Approval is still pending</p>').css({"width": "20%","margin-left": "37%","margin-top": "10px"});
             setTimeout(function(){
               $('#msg1').hide(2000);
             },2000);
             return false;
           }
       }

       if(checkActiveInactive == 'active_incative') {
           if(approved_status_wall == 'pending') {
             $('#msg1').show();
             $('#msg1').html('<p style="text-align:center">Sorry ! Approval is still pending</p>').css({"width": "20%","margin-left": "37%","margin-top": "10px"});
             setTimeout(function(){
               $('#msg1').hide(2000);
             },2000);
             return false;
           }
       }

       console.log("submit event");
       var fd = new FormData(document.getElementById(formId));
       fd.append("label", "WEBUPLOAD");
       $.ajax({
         url: urlPath,
         type: "POST",
         data: fd,
         processData: false,  // tell jQuery not to process the data
         contentType: false   // tell jQuery not to set contentType
       }).done(function( data ) {

         if(data == 'success')
         {
             if(status == 1)
             {
               $('#'+formId).find('#status'+uniqueId).val('0');
               $('#'+formId).find('#statusChange'+uniqueId).html('<span class="text">Status</span> <input type="submit" class="btn btn-label-danger" value="Inactive">');
             }
             else if(status == 0)
             {
               $('#'+formId).find('#status'+uniqueId).val('1');
               $('#'+formId).find('#statusChange'+uniqueId).html('<span class="text">Status</span> <input type="submit" class="btn btn-label-success active-btn" value="Active">');
             } else if(status == 'not_approved') {
               $('#'+formId).find('#status'+uniqueId).val('approved');
               $('#statusChangeUser'+uniqueId).find('#status'+uniqueId).val('1');
               $('#statusChangeUser'+uniqueId).find('#statusChange'+uniqueId).html('<span class="text">Status</span> <input type="submit" class="btn btn-label-success active-btn" value="Active">');
               $('#'+formId).find('#statusChangeAppUser'+uniqueId).html('<input type="submit" class="btn btn-label-success active-btn" value="Approved" disabled>');
               $('#'+formId).find('#statusChangeAppUser'+uniqueId).attr('disabled',true);
             }
             else if(approved_status_wall == 'pending') {
               $('#'+formId).find('#status'+uniqueId).val('approved');
               $('#statusChangeWallPost'+uniqueId).find('#status'+uniqueId).val('1');
               $('#statusChangeWallPost'+uniqueId).find('#statusChange'+uniqueId).html('<span class="text">Status</span> <input type="submit" class="btn btn-label-success active-btn" value="Active">');
               $('#'+formId).find('#statusChangeWall'+uniqueId).html('<input type="submit" class="btn btn-label-success active-btn" value="Approved" disabled>');
               $('#'+formId).find('#statusChangeWall'+uniqueId).attr('disabled',true);
             }
             else if(status == 'approved') {
               $('#'+formId).find('#status').val('disapproved');
               $('#'+formId).find('#statusChange'+uniqueId).html('<input type="submit" class="btn btn-label-danger active-btn" value="Disapproved">');

             } else if(status == 'disapproved') {
               $('#'+formId).find('#status').val('approved');
               $('#'+formId).find('#statusChange'+uniqueId).html('<input type="submit" class="btn btn-label-success active-btn" value="Approved">');
             }
         }
         else
         {
           alert('Status not updated');
         }
       });
   }
    return false;
}




function ajax_get_sub_category(cid,urlPath) {


var fd = new FormData();
fd.append("id", cid);
$.ajax({
url: 'MenuManagement/getSubCategory',
type: "POST",
data:fd,
processData: false,  // tell jQuery not to process the data
contentType: false   // tell jQuery not to set contentType
}).done(function( data ) {
$('#sub_cat_id').html(data);
});
}



function ajax_modify_status(formId,urlPath,location,uniqueId) {
let crm = confirm('Are you sure you want to change status ?');
if(crm == true)
{
var status = $('#'+formId).find('#status').val();

console.log("submit event");
var fd = new FormData(document.getElementById(formId));
fd.append("label", "WEBUPLOAD");
$.ajax({
url: urlPath,
type: "POST",
data: fd,
processData: false,  // tell jQuery not to process the data
contentType: false   // tell jQuery not to set contentType
}).done(function( data ) {

if(data.trim() == 'success')
{

   if(status == 1)
   {
     $('#'+formId).find('#status').val('0');
     $('#statusChange'+uniqueId).html('<input type="submit" class="btn btn-danger" value="Inactive">');
   }
   else
   {
     $('#'+formId).find('#status').val('1');
     $('#statusChange'+uniqueId).html('<input type="submit" class="btn btn-success" value="Active">');
   }
}
else
{
 alert('Status not updated');
}
});
}
return false;
}


// remove query string two times from url



// remove query string two times from url
