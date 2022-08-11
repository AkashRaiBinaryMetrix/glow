let clg = console.log.bind(document);
/*---------------------- show hide password ---------------*/
$('.show-pass').on('click', function () {
  let type = $('#password').attr('type');
  if (type && type == 'password') {
    $('#password').attr('type', 'text');
    $(this).text(`Hide Password`);
  } else {
    $('#password').attr('type', 'password');
    $(this).text(`Show Password`);
  }
});
/*---------------------- show hide password ---------------*/