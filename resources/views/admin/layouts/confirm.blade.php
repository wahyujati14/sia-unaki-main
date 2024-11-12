<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

     $('.approve').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          new swal({
              title: `Are you sure you want to approve this record?`,
              icon: "warning",
              showCancelButton: true,
          })
          .then((willApprove) => {
            if (willApprove.isConfirmed) {
              form.submit();
            }
          });
      });
     $('.decline').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          new swal({
              title: `Are you sure you want to decline this record?`,
              icon: "warning",
              showCancelButton: true,
          })
          .then((willDecline) => {
            if (willDecline.isConfirmed) {
              form.submit();
            }
          });
      });

      //confirm delete
    $(document).on('click', '.btn-delete', function(e) {
        var form = $("#"+e.target.dataset.id);
        Swal.fire({
        title: 'Delete Confirmation ?',
        text: 'Are you sure want to delete this data ???',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: 'success',
        cancelButtonColor: 'primary',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
        }).then((res) => {
            if(res.isConfirmed){
                form.submit();
            }else{
                return false;
            }
        });
        return false;
    })

</script>
