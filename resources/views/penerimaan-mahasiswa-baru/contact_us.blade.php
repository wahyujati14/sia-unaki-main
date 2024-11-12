<div class="row">
    <div class="col-sm card-hubungi-kami mt-5">
        <h2 class="text-light contact-us"><img src="{{asset('assets/images/icons/hubungi-kami.png')}}"> Hubungi Kami</h2>
        <p class="text-light">
            Jika ada hal yang kurang jelas, silakan langsung menghubungi kami di <strong>{{\App\Models\InformationService::find(1)->whatsapp}}</strong> (Whatsapp / Call) atau telepon ke nomor <strong>{{\App\Models\InformationService::find(1)->phone}}</strong> atau email <strong>{{\App\Models\InformationService::find(1)->email}}</strong>
        </p>
    </div>
</div>
