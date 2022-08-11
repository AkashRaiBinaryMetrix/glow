$("#banner-slider").owlCarousel({
	items : 1,
	nav:true,
	dots:false,
	loop:true,
	autoplay:true,
	mouseDrag:true,
	autoplayHoverPause:true,
	navText : ["<span><i class='las la-angle-left'></i></span>","<span><i class='las la-angle-right'></i></span>"]
  });


 $("#trending-slider").owlCarousel({
		nav:true,
		dots:false,
		loop:true,
		autoplay:true,
		mouseDrag:true,
		autoplayHoverPause:true,
		navText : ["<span><i class='las la-angle-left'></i></span>","<span><i class='las la-angle-right'></i></span>"],
		responsiveClass: true,
		responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 2
		
	  },
	  700: {
		items: 3,
		loop: true,
		margin:20
	  },
	  1100: {
		items: 4,
		loop: true,
		margin:20
	  }		
	}
});


$('.owl-carousel').owlCarousel({
loop: true,
responsiveClass: true,
responsive: {
  0: {
	items: 1,
	nav: true
  },
  600: {
	items: 3,
	nav: false
  },
  1000: {
	items: 3,
	nav: false,
	loop: true,
	margin:30
  }
}
});

jQuery(window).scroll(function(){ 
	var scroll = jQuery(window).scrollTop();
	if (scroll>=50){ 
		jQuery('header').addClass('fixed-nav');
	}
	else{
		jQuery('header').removeClass('fixed-nav');
	}
});




$(document).ready(function() {
	$('#msg').fadeOut(5000);
	$('#msgContact').fadeOut(8000);
});


function changePagingSubmitForm(pageLimitForm) {
	$('#' + pageLimitForm).submit();
}
$('.pager-link-next').find('a').eq(1).hide();
// search record
function searchRecord(searchForm) {
	$('#' + searchForm).submit();
}
// search record

// perform batch operation active,inactive and delete
var arrID = [];

function checkUncheckAllCheckbox(checkId) {
	if ($('#' + checkId).prop("checked") == true) {
			$('.slc_checkbox_news').prop("checked", true);
			$(".slc_checkbox_news").each(function() {
					var u_id = $(this).val();
					if (u_id == "on") {
							$('#' + checkId).prop("checked", false);
							$('input:checkbox').prop('checked', false);
					} else {
							arrID.push(u_id);
							console.log(u_id);
					}

			});
	} else if ($('#' + checkId).prop("checked") == false) {
			$('.slc_checkbox_news').prop("checked", false);
			arrID = [];

	}
	console.log(arrID);
	$('#batch_operation_id').val(arrID);
}

function checkUncheckCheckbox(singleCheckId) {
	var count = 0;
	var total_record = $('#total_record').val();
	$(".slc_checkbox_news").each(function() {
			var checkId = this.id;
			if ($("#" + checkId).prop('checked') == true) {
					count++;
			}

	});
	if (total_record == count) {
			$('#slc_checkbox_all').prop('checked', true);
	} else {
			$('#slc_checkbox_all').prop('checked', false);
	}
	console.log(count);

	if ($('#' + singleCheckId).is(":checked")) {
			var id = singleCheckId.split('_');
			var uid = id[3];
			arrID.push(uid);
	} else {
			var id = singleCheckId.split('_');
			var uid = id[3];
			for (var i = 0; i < arrID.length; i++) {
					if (arrID[i] == uid) {
							arrID.splice(i, 1);
					}
			}
	}
	console.log(arrID);
	$('#batch_operation_id').val(arrID);
}

function batchAction(batchFormId) {
	let check_id = $('#batch_operation_id').val();
	if (check_id == '') {
			alert('Please select checkbox');
			$('#' + batchFormId).find('#select2-batch_action-container').attr('title', 'Select Batch Action');
			$('#' + batchFormId).find('#select2-batch_action-container').text('Select Batch Action');

			return false;
	} else {
			let crm = confirm('Are you sure you want to perform action ?');
			if (crm == true) {
					$('#' + batchFormId).submit();
			} else {
					$('input:checkbox').prop('checked', false);
					$('#batch_operation_id').val('');
					$('#' + batchFormId).find('#select2-batch_action-container').attr('title', 'Select Batch Action');
					$('#' + batchFormId).find('#select2-batch_action-container').text('Select Batch Action');
					return false;
			}

	}
}
// perform batch operation active,inactive and delete

// change status
function getCurrentStatus(statusId, hiddenFiledId) {
	if ($('#' + statusId).hasClass('inactive')) {
			$('#' + statusId).addClass('active');
			$('#' + statusId).removeClass('inactive');
			$('#' + hiddenFiledId).val('1');
	} else {
			$('#' + statusId).addClass('inactive');
			$('#' + statusId).removeClass('active');
			$('#' + hiddenFiledId).val('0');
	}
}
var curr_status = $('#curr_status').val();
if (curr_status == '1') {
	$('#status').click();
}
$('#chat_aside_mobile_toggle').click(function() {
	$('#chat_aside').addClass('app_aside--on');
	$('#chat-close').addClass('app_aside--on');

});
$('#chat_aside_close').click(function() {
	$('#chat_aside').removeClass('app_aside--on');
	$('#chat-close').removeClass('app_aside--on');
});


function removeImage() {
	$(".remove_img").hide();
	$(".remove_img").find('img').attr('src','');
	$(".img").val('');
}

function removeAndValImage(sId,sClass) {
	$(`.${sClass}`).hide();
	$(`.${sClass}`).find('img').attr('src','');
	$(`#${sId}`).val('');
}

function readURL(input) {
	if (input.files && input.files[0]) {
			let filename = input.files[0].name;
			let ext = filename.substring(filename.lastIndexOf('.') + 1);

			var reader = new FileReader();
			reader.onload = function(e) {
					if (ext != '' && ext == 'pdf') {
							$('.show_image').hide();
					} else {
							$('.image').show();
							if($('.show_image').find('a')){
									$('.show_image').find('a').attr({
											'href':"javascript:void(0)",
											'target':"",
											'pointer-events':"none"
									});
							}
							
							$('.show_image').show();
							$('.show_image img').attr('src', e.target.result);
					}

			}
			reader.readAsDataURL(input.files[0]);

	}
}
function readURL0(input,type='add') {
	if (input.files && input.files[0]) {
			let filename = input.files[0].name;
			let ext = filename.substring(filename.lastIndexOf('.') + 1);

			var reader = new FileReader();
			reader.onload = function(e) {
					if (ext != '' && ext == 'pdf') {
							$('.show_image').hide();
					} else {
							$('.image').show();
							$('.show_image').show();
							$('.show_image img').attr('src', e.target.result);
					}

			}
			reader.readAsDataURL(input.files[0]);

	}
}

function readURL1(input,type='add') {
	if (input.files && input.files[0]) {
			let filename = input.files[0].name;
			let ext = filename.substring(filename.lastIndexOf('.') + 1);

			var reader = new FileReader();
			reader.onload = function(e) {
					if (ext != '' && ext == 'pdf') {
							$('.show_image1').hide();
					} else {
							$('.image1').show();
							$('.show_image1').show();
							$('.show_image1 img').attr('src', e.target.result);
					}

			}
			reader.readAsDataURL(input.files[0]);

	}
}

function readProfileURL(input) {
	let filename = input.files[0].name;
	let ext = filename.substring(filename.lastIndexOf('.') + 1);
	let myarray = ['jpg', 'png', 'jpeg']
	if ($.inArray(myarray, ext) == -1) {
			alert('Invalid image! Only .jpg, .png and .jpeg images are allowed.');
			$('.show_image').attr('src', '');
			$(".img").val('');
			return false;
	} else {

			if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
							$('.image').show();
							$('.show_image').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
			}
	}
}

// $("#profile_image").change(function() {
//     readProfileURL(this);
// });
// $("#image").change(function() {
//     readURL(this);
// });
// $("#image1").change(function() {
//     readURL(this);
// });
$("#event_image").change(function() {
	readURL(this);
});
$("#wall_post_image").change(function() {
	readURL(this);
});
$("#notification_image").change(function() {
	readURL(this);
});


function isEmail(email) {
	if (/^[a-zA-Z]([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email) == false)
			return false;
	else
			return true
}

function checkImageExt(filename) {
	var ext = /[^.]+$/.exec(filename);
	ext = ext.toString();
	ext = ext.toLowerCase();
	exts = new Array('jpg', 'jpeg', 'png','JPG','JPEG','PNG');
	if (exts.indexOf(ext) != -1)
			return true;

	return false;
} 
function checkImageExtWithGIF(filename) {
	var ext = /[^.]+$/.exec(filename);
	ext = ext.toString();
	ext = ext.toLowerCase();
	exts = new Array('jpg', 'jpeg', 'png','gif','JPG','JPEG','PNG','GIF');
	if (exts.indexOf(ext) != -1)
			return true;

	return false;
} 

function checkVedioExt(filename) {
	var ext = /[^.]+$/.exec(filename);
	ext = ext.toString();
	ext = ext.toLowerCase();
	exts = new Array('mp4');
	if (exts.indexOf(ext) != -1)
			return true;

	return false;
}
function checkVideoImageExt(filename) {
	var ext = /[^.]+$/.exec(filename);
	ext = ext.toString();
	ext = ext.toLowerCase();
	exts = new Array('mp4');
	if (exts.indexOf(ext) != -1)
			return true;

	return false;
}

function checkFileExt(filename) {
	var ext = /[^.]+$/.exec(filename);
	ext = ext.toString();
	ext = ext.toLowerCase();
	exts = new Array('jpg', 'jpeg', 'gif', 'png', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf');
	if (exts.indexOf(ext) != -1)
			return true;

	return false;
}

function checkFilePdfExt(filename) {
	var ext = /[^.]+$/.exec(filename);
	ext = ext.toString();
	ext = ext.toLowerCase();
	exts = new Array('pdf');
	if (exts.indexOf(ext) != -1)
			return true;

	return false;
}

function check_image(ob) {
	var obj = $(ob);
	var err = false;
	if (!checkImageExt(obj.val())) {
			err = true;
			alert('Invalid image! Only jpg, png and jpeg images are allowed.');
	}

	if (!err) {
			var file = obj[0];
			var size = file.files[0].size / 1024;
			//alert(size);
			//1048576 byte = 1mb
			if (size > 2048) {
					err = true;
					alert('Cant upload! This image is larger than 2 MB');
			}
	}

	if (err) {
			obj.val('');
	}
	return !err;
}
function check_image_with_gif(ob) {
	var obj = $(ob);
	var err = false;
	if (!checkImageExtWithGIF(obj.val())) {
			err = true;
			alert('Invalid image! Only jpg, png and jpeg images are allowed.');
	}

	if (!err) {
			var file = obj[0];
			var size = file.files[0].size / 1024;
			//alert(size);
			//1048576 byte = 1mb
			if (size > 2048) {
					err = true;
					alert('Cant upload! This image is larger than 2 MB');
			}
	}

	if (err) {
			obj.val('');
	}
	return !err;
}

function check_vedio(ob) {
	var obj = $(ob);
	var err = false;
	if (!checkVedioExt(obj.val())) {
			err = true;
			alert('Invalid video! Only .mp4  videos are allowed.');
	}

	if (!err) {
			var file = obj[0];
			var size = file.files[0].size / 1024;
			if (size > 1024 * 2) {
					err = true;
					alert("Can't upload! This video is larger than 2 MB");
			}
	}

	if (err) {
			obj.val('');
	}
	return !err;
}



function check_vedio_maximum_upload_twenty_mb(ob) {

	var obj = $(ob);
	var err = false;
	if (!checkVedioExt(obj.val())) {
			err = true;
			alert('Invalid video! Only .mp4  videos are allowed.');
	}

	if (!err) {
			var file = obj[0];
			var size = file.files[0].size / 1024;
			if (size > 1024 * 20) {
					err = true;
					alert("Can't upload! This video is larger than 20 MB");
			}
	}

	if (err) {
			obj.val('');
	}
	return !err;
}

function check_file(ob) {
	var obj = $(ob);
	var err = false;
	if (!checkFileExt(obj.val())) {
			err = true;
			open_modal('defaultModal', 'File Error!', 'Invalid file! Only images (.jpg, .png, .gif), word, excel, pdf and ppt files are allowed.');
	}

	if (!err) {
			var file = obj[0];
			var size = file.files[0].size / 1024;
			if (size > 2048) {
					err = true;
					open_modal('defaultModal', 'File Size Error!', "Can't upload! This file is larger than 2 MB");
			}
	}

	if (err) {
			obj.val('');
	}
	return !err;
}

function check_file_pdf(ob) {
	var obj = $(ob);
	var err = false;
	if (!checkFilePdfExt(obj.val())) {
			err = true;
			alert('Invalid file! Only pdf files are allowed.');

			//open_modal('defaultModal', 'File Error!', 'Invalid file! Only pdf files are allowed.');
	}

	if (!err) {
			var file = obj[0];
			var size = file.files[0].size / 1024;
			if (size > 1024 * 5) {
					err = true;
					alert('Cant not upload! This file is larger than 5 MB');
					//open_modal('defaultModal', 'File Size Error!', "Can't upload! This file is larger than 5 MB");
			}
	}

	if (err) {
			obj.val('');

	}

	return !err;
}

function set_numeric_input() {
	/** Int **/
	$("html,body").find('[valid="int"]').each(function() {
			$(this).keydown(function(e) {
					var allowed = false;
					if (e.ctrlKey === true && (e.keyCode == 65 || e.keyCode == 88 || e.keyCode == 86))
							allowed = true;
					if ($.inArray(e.keyCode, [8, 9, 37, 38, 39, 40, 46]) !== -1)
							allowed = true;

					if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && !allowed) {
							e.preventDefault();
					}
			});

			$(this).change(function(e) {
					$(this).val($(this).val().replace(/\D/g, ''));
			});
	});

	/** Float **/
	$("html,body").find('[valid="num"]').each(function() {
			$(this).keydown(function(e) {
					var allowed = false;
					if (e.ctrlKey === true && (e.keyCode == 65 || e.keyCode == 88 || e.keyCode == 86))
							allowed = true;
					if ($.inArray(e.keyCode, [8, 9, 37, 38, 39, 40, 46]) !== -1)
							allowed = true;

					if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && !allowed && e.keyCode != 190) {
							e.preventDefault();
					}
			});

			$(this).change(function(e) {
					if ($(this).val()) {
							$(this).val(parseFloat($(this).val().replace(/[^\d.-]/g, '')));
					}
			});
	});
}

function show_form_errors(errors, frm) {
	if (typeof errors != 'object') {
			return;
	}

	$.each(errors, function(k, v) {
			frm.find('[name="' + k + '"],[ng-model*=".' + k + '"]').after('<div class="text-danger ferr">' + v + '</div>').parent().addClass('has-error');
	});
}


function hide_form_errors(frm) {
	frm.find('.ferr').remove();
	frm.find('.has-error').removeClass('has-error');
}

function checkCheckBoxIsCheckedOrUnchecked(chekboxid) {
	var checkedCount = 0;
	var total_country = $("#total_country").val();
	$('.slc_checkbox_news').each(function() {
			var checkid = this.id;
			if ($("#" + checkid).prop("checked") == true) {
					checkedCount++;
			}
	});
	//alert(total_country);
	if (total_country == checkedCount) {
			$('#slc_checkbox_all').prop("checked", true);
	} else {
			$('#slc_checkbox_all').prop("checked", false);
	}
	console.log(checkedCount);
}

function resetForm() {

	var cur_url = window.location.href;
	var url_split = cur_url.split('?');
	console.log(url_split[0]);
	window.location.href = url_split[0];
	//$location.url('product');
}



// change status

// Function to accept only alphabets start
function ValidateAlpha(evt) {
	var keyCode = (evt.which) ? evt.which : evt.keyCode
	if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

			return false;
	return true;
}
// Function to accept only alphabets end

//function accept only integer start
function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode == 46 && charCode > 31 && (charCode < 48 || charCode > 57))
			return false;

	return true;
}

function isNumberKey(evt, id) {
	try {
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (charCode == 46) {
					var txt = document.getElementById(id).value;
					if (!(txt.indexOf(".") > -1)) {
							return false;
					}
			}
			if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;

			return true;
	} catch (w) {
			//alert(w);
	}
}
//function accept only integer end


function batchActionDelete(formId, batchActionDelete, msg) {
	let check_id = $('#batch_operation_id').val();
	if (check_id == '') {
			alert('Please select checkbox');
			$('#' + formId).find('#select2-batch_action-container').attr('title', 'Select Batch Action');
			$('#' + formId).find('#select2-batch_action-container').text('Select Batch Action');
			return false;
	} else {
			var batch_operation_id = $('#batch_operation_id').val();
			let crm = confirm("Are you sure you want to delete multiple record ?");
			if (crm == true) {
					console.log("submit event");
					var fd = new FormData(document.getElementById(formId));
					fd.append("label", "WEBUPLOAD");
					$.ajax({
							url: batchActionDelete,
							type: "POST",
							data: fd,
							processData: false, // tell jQuery not to process the data
							contentType: false // tell jQuery not to set contentType
					}).done(function(data) {
							console.log("PHP Output:");
							console.log(data);
							if (data.startsWith("s")) {
									$('#batch_operation_id').val('');
									$('#msg1').html(msg + ' have deleted successfully');
									$('#msg1').show();
									let ids = batch_operation_id.split(",");
									for (let i = 0; i < ids.length; i++) {
											let id = ids[i];
											console.log("here id:" + id);
											$('#tr_' + id).remove();
									}
									$('#msg1').hide(6000);
									$('#slc_checkbox_all').prop('checked', false);
							} else if (data.startsWith("f")) {
									$('#msg1').html(msg + ' does not delete');
									$('#msg1').hide(6000);
							}
					});
					return false;
			} else {
					$('input:checkbox').prop('checked', false);
					$('#batch_operation_id').val('');
					$('#' + formId).find('#select2-batch_action-container').attr('title', 'Select Batch Action');
					$('#' + formId).find('#select2-batch_action-container').text('Select Batch Action');
					return false;
			}
	}
}
$(function() {
	$('#batchActionForm').click(function() {
			setTimeout(() => {
					$('.select2-results').find('li').each(function() {
							if ($(this).attr("aria-selected") == "true") {
									//alert("ok");
									$(this).attr("aria-selected", false);
							}
					});

			}, 100);
	});
});

$("#image").change(function() {
	console.log(this);
	 if(check_image(this)) {
			readURL(this);
	 }

});
$("#image_banner").change(function() {
	let sExtension = ['mp4'];
	var sImageExtension = ['jpeg', 'jpg', 'png','gif','JPG','JPEG','PNG','GIF'];
	filename = this.value;
	let ext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
	console.log();
	if($.inArray(ext,sExtension) != -1) {
			check_vedio(this);
	} else if($.inArray(ext,sExtension) == -1 && $.inArray(ext,sImageExtension) != -1) {
			check_image_with_gif(this);
		 readURL(this);
	} else {
			 alert('Only allowed jpg, jpeg, png, gif and mp4 types images or videos');
			 $(this).val('');
	}

});

$("#image1").change(function() {
	var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
	if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Only formats are allowed : " + fileExtension.join(', '));
			$('.img').val('');
	} else {
			readURL(this);
	}
});

$("#listing_page_image").change(function() {
	var fileExtension = ['jpeg', 'jpg', 'png','JPG','JPEG','PNG'];
	if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Only formats are allowed : " + fileExtension.join(', '));
			$('#listing_page_image').val('');
	} else {
			readURL0(this);
	}
});

$("#detail_page_image").change(function() {
	var fileExtension = ['jpeg', 'jpg', 'png','JPG','JPEG','PNG'];
	if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Only formats are allowed : " + fileExtension.join(', '));
			$('#detail_page_image').val('');
	} else {
			readURL1(this);
	}
});

function seoFriendlyUrl(str) {
			var outputString = str.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '-').replace(/^(-)+|(-)+$/g, '');
			return outputString.toLowerCase();
}
function slugvalue(){
			var TitleVal=$('#title').val();
			TitleVal=seoFriendlyUrl(TitleVal);
			$('#slug').val(TitleVal);
}

function viewPassword(inputField,iconId) {
	var className = $("#"+iconId).attr('class');
	className = className.indexOf('slash') !== -1 ? 'fa fa-eye' : 'fa fa-eye-slash'

	$("#"+iconId).attr('class', className);
	var input = $("#"+inputField);

	if (input.attr("type") == "text") {
			input.attr("type", "password");
	} else {
			input.attr("type", "text");
	}
}

/*------------------- clear filter -------------------------------------*/
function clearFilter() {
	
	document.getElementById('search').value = '';
	$('body .select2-container #select2-filterStatus-container').attr('title','Filter By Status');
	$('body .select2-container #select2-filterStatus-container').text('Filter By Status');
	//setTimeout(function(){
			$('.select2-container .select2-results #select2-filterStatus-results').find('li').attr("aria-selected","false");
			$('.select2-container .select2-results #select2-filterStatus-results li:first').attr("aria-selected","true");
			$('#filterStatus option[value=""]').attr('selected','selected');
			console.log('called clear filter');
	//},0);
	
	fetchData(1, 'desc', 'id','','','','sClearFilter');
}
/*------------------- clear filter -------------------------------------*/

function isURL(str,sFieldToRenderMsg) {
	var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
	'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
	'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
	'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
	'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
	'(\\#[-a-z\\d_]*)?$','i'); // fragment locator
	if(!pattern.test(str)) {
		$('.'+sFieldToRenderMsg).html('Please enter valid url');
		return false;
	} else {
			$('.'+sFieldToRenderMsg).html('');
			return true;
	}
 
}

function validateFloatKeyPress(el, evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	var number = el.value.split('.');
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
	}
	//just one dot
	if(number.length>1 && charCode == 46){
			 return false;
	}
	//get the carat position
	var caratPos = getSelectionStart(el);
	var dotPos = el.value.indexOf(".");
	if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
			return false;
	}
	return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
if (o.createTextRange) {
	var r = document.selection.createRange().duplicate()
	r.moveEnd('character', o.value.length)
	if (r.text == '') return o.value.length
	return o.value.lastIndexOf(r.text)
} else return o.selectionStart
}
