<!-- jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- bootstraps -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<!-- bootstraps -->

<!-- jquery mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<!-- jquery mask -->

<!-- sweetalert 2 -->
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- sweetalert 2 -->

<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <!-- select -->
<script>

// masking
$(document).ready(function () {
        $('.money').mask('000,000,000,000,000', {reverse: true});
        $('.phone').mask('0000000000000', {reverse: true});
        $('.number').mask('0000000000000', {reverse: true});
        $('.nik').mask('0000000000000000', {reverse: true});
});
// end masking

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});

// copy text
function copy_rekening() {
  /* Get the text field */
  var copyText = document.getElementById("norek-bca");
  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */
   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  /* Alert the copied text */
  Swal.fire('Rekening '+copyText.value,'Berhasil disalin ke clipboard','info')
}

/*indicator file choose*/
$('.file-upload').change(function(event) {
  var last = $(this).prev('label').html()
  var file = event.target.files[0].name;
  $(this).prev('label').html(last + '<p class="mb-0 mt-2">File selected : ' + file + '</p>');
})
/*indicator file choose*/

// tost seweet alert
var toast = Swal.mixin({
        toast: true,
        title: 'General Title',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
// tost seweet alert
</script>
