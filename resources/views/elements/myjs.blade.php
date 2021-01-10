
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
{{--    For Sweet Aleart  --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    function newWindow(url) {
        window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=970,height=890");
    }
</script>
<script>
  $('.datepickerDB').datepicker({
      format:"yyyy-mm-dd",
      autoclose: true,
      todayHighlight: true,
  });
  $('.datepickerRange').datepicker({
      startDate: '-0d',
      format:"yyyy-mm-dd",
      autoClose: false,
      todayHighlight: true,
  });
  $('.datepicker').datepicker({
      startDate: '-0d',
      format:"dd-mm-yyyy",
      autoclose: true,
      todayHighlight: true,
  });
  $('.datepickerNexDayOnly').datepicker({
      startDate: '-0d',
      format:"yyyy-mm-dd",
      autoclose: true,
      todayHighlight: true,
  });
  $('.datepickerPreviousOnly').datepicker({
      endDate: '-0d',
      showOn:'both',
      format:"yyyy-mm-dd",
      autoclose: true,
      todayHighlight: true,
      changeMonth:true,
      changeYear:true,
  });

  $('.datepickers').datepicker({
      format:"dd-mm-yyyy",
      autoclose: true,
      todayHighlight: true,
  });
  //https://bootstrap-datepicker.readthedocs.io/en/stable/index.html


$(document).ready(function(){
  // toastr.success('The process has been saved.', 'Success');
  // $(".form").validate({
  //   rules: {
  //       field: {
  //           required: true,
  //           step: 10
  //       },
  //   }, highlight: function (element) {
  //       $(element).closest('.form-group').addClass('has-danger');
  //       // $(element).closest('.form-control').addClass('form-control-danger');
  //   },
  //   unhighlight: function (element) {
  //       $(element).closest('.form-group').removeClass('has-danger');
  //       // $(element).closest('.form-group').addClass('has-success');
  //   },
  //   errorElement: 'div',
  //   errorClass: 'form-control-feedback',
  //   errorPlacement: function (error, element) {
  //       if (element.parent('.input-group').length) {
  //           error.insertAfter(element.parent());
  //       } else {
  //           error.insertAfter(element);
  //       }
  //   }
  // });
});

$('.updateNotification').click(function(){
  const id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: "<?php echo url('notification/"+id+"/update')?>",
        success: function(data){
          console.log(data);
        }
      });
});

function makeApproveRequest(event, id) {
  event.preventDefault();
  Swal.fire({
      title: 'Are you sure?',
      text: "You want to approve this customer!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, approve it!'
  }).then((result) => {
      if (result.value) {
          Swal.fire(
              'Approve!',
              'Approve action processed successfully.',
              'success'
          );
          $("#approveButton"+id).submit();
      }
  })
}

function makeRejectRequest(event, id) {
  event.preventDefault();
  Swal.fire({
      title: 'Are you sure?',
      text: "You want to reject this customer!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, reject it!'
  }).then((result) => {
      if (result.value) {
          Swal.fire(
              'Reject!',
              'Reject action processed successfully.',
              'success'
          );
          $("#rejectButton"+id).submit();
      }
  })
}

function makeDeleteRequest(event, id) {
  event.preventDefault();
  Swal.fire({
      title: 'Are you sure?',
      text: "You will not be able to recover!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.value) {
          Swal.fire(
              'Deleted!',
              'Delete action processed successfully.',
              'success'
          );
          $("#deleteButton"+id).submit();
      }
  })
}


function sweetalertDelete(id) {
    event.preventDefault();
    swal({
      title: "Are you sure?",
      text: "To continue this action!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Your action has been done! :)", {
          icon: "success",
          buttons: false,
          timer: 1000
        });
          $("#deleteButton"+id).submit();
      }
    });
}
//https://sweetalert2.github.io/

</script>
