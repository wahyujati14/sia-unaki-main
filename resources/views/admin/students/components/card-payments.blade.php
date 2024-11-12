<div class="card profile-widget">
    <div class="card-header">
      <h4>Informasi Detail Pembayaran</h4>
    </div>
    <div class="profile-widget-header">
      <div class="profile-widget-items">
        <div class="card-body">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label>Pembayaran Uang Pangkal </label>
              <div class="input-group">
                <input type="text" class="form-control" name="initial_payment" value="@rupiah($student->certificate_receive->user_initial_payment->nominal)" disabled>
              </div>
            </div>
            <div class="form-group">
              <label>Iuran Kemahasiswaan</label>
              <input type="text" class="form-control" name="kemahasiswaan_contribution" value="@rupiah($student->certificate_receive->kemahasiswaan_contribution->nominal)" disabled>
            </div>
            <div class="form-group">
              <label>Iuran Perpustakaan</label>
              <input type="text" class="form-control" name="library_contribution" value="@rupiah($student->certificate_receive->library_contribution->nominal)" disabled>
            </div>
            <div class="form-group">
              <label>Iuran Kesehatan</label>
              <input type="text" class="form-control" name="health_payment" value="@rupiah($student->certificate_receive->health_payment->nominal)" disabled>
            </div>
            <div class="form-group">
              <label>Discount (Potongan)</label>
              <input type="text" class="form-control" name="discount" value="@rupiah(@$student->certificate_receive->discount->nominal??0)" disabled>
            </div>
            <label for=""><h1>@rupiah(\App\Models\InformationService::re_registration_price())</h1></label>
        </div>
      </div>
    </div>
  </div>