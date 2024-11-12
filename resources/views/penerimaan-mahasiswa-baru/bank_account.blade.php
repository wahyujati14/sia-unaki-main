<div class="card-norek p-4">
    <div class="row">
        <div class="col-sm-5 m-auto">
            <img class="img img-fluid" src="{{asset('assets/images/icons/bca.png')}}">
        </div>
    </div>
    <p class="norek-bca mb-0">{{\App\Models\InformationService::find(1)->account_number}}</p>
    <p class="text-center mt-0 p-0">
        Yayasan Universitas AKI
    </p>
    <div class="row">
        <div class="col-auto m-auto">
            <input type="text" hidden value="{{\App\Models\InformationService::find(1)->account_number}}" id="norek-bca" >
            <button onclick="copy_rekening()" class="btn btn-lg btn-outline-primary btn-bca">Salin Rekening</button>
        </div>
    </div>
</div>
