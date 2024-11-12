<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CertificateReceive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nomor_certificate', 'study_program_id', 'submission'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function user_payment()
    {
        return $this->belongsTo(UserPayment::class);
    }

    public function user_initial_payment()
    {
        return $this->hasOne(UserInitialPayment::class);
    }

    public function kemahasiswaan_contribution()
    {
        return $this->hasOne(UserKemahasiswaanContribution::class);
    }

    public function health_payment()
    {
        return $this->hasOne(UserHealthContribution::class);
    }

    public function library_contribution()
    {
        return $this->hasOne(UserLibraryContribution::class);
    }

    public function discount()
    {
        return $this->hasOne(UserDiscountPayment::class);
    }

    public static function getNomorCertificate()
    {
        $certificate_receive = DB::table('certificate_receives')
            ->select(DB::raw("SPLIT_PART(nomor_certificate,  '/', 3 ) AS nomor_certificates"))
            ->orderBy('nomor_certificates', 'desc')->first();
        if ($certificate_receive && (int)$certificate_receive->nomor_certificates) {
            $number = $certificate_receive->nomor_certificates + 1;
        } else {
            $number = 1;
        }
        return 'SKD/' . date('Y') . '/' . str_pad($number, 4, "0", STR_PAD_LEFT);
    }

    public static function getTotalPrice($certificate_receive_id)
    {
        return self::find($certificate_receive_id)?->user_initial_payment()?->first()->nominal +
            self::find($certificate_receive_id)?->kemahasiswaan_contribution()?->first()->nominal +
            self::find($certificate_receive_id)?->library_contribution()?->first()->nominal +
            self::find($certificate_receive_id)?->health_payment()?->first()->nominal +
            InformationService::find(1)->ematerai -
            @self::find($certificate_receive_id)?->discount()?->first()->nominal ?? 0;
    }
}
