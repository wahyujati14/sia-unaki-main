<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPayment extends Model
{
    use HasFactory;
    const TYPE_REGISTRATION = 'REGISTRATION';
    const TYPE_REREGISTRATION = 'REREGISTRATION';

    const STATUS_PAID = 'PAID';

    public static function getType()
    {
        return [
            self::TYPE_REGISTRATION,
        ];
    }
    protected $fillable = [
        'user_id',
        'type',
        'is_validate',
        'status',
        'external_id',
        'xendit_id',
        'payment_type_id',
        'nominal'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($user) { 
            $user->nominal = self::getAmount($user->type, User::find($user->user_id));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public static function getInvoiceNumber($type = '', User $user)
    {
        $user_payment = DB::table('user_payments')
        ->select('*', DB::raw("SPLIT_PART(external_id,  '/', 4 ) AS nomor"), DB::raw("SPLIT_PART(external_id,  '/', 2 ) AS year"))
        ->orderBy('year', 'desc')
        ->orderBy('nomor', 'desc')
        ->whereNotNull('external_id')
        ->first();
        $year = $user_payment?->year??date('Y');
        $number = $user_payment?->nomor + 1;
        $code = Auth::user()->user_information->registration_path->code;
        switch ($type) {
            case UserPayment::TYPE_REGISTRATION:
                $user_payment = $user->user_payments->where('type', UserPayment::TYPE_REGISTRATION)->last();
                return $code.'/'.$year.'/'.date('m').'/'.$number??1;
                break;
            case UserPayment::TYPE_REREGISTRATION:
                $user_payment = $user->user_payments->where('type', UserPayment::TYPE_REREGISTRATION)->last();
                return 'DFTR-'.$code.'/'.$year.'/'.date('m').'/'.$number??1;
                break;
            default:
                $user_payment = $user->user_payments->last();
                return 'INV/'.$year.'/'.date('m').'/'.$number??1;
                break;
        }
    }

    public static function getAmount($type = '', $user = null)
    {
        switch ($type) {
            case UserPayment::TYPE_REGISTRATION:
                return InformationService::find(1)->payment_registrations;
                break;
            case UserPayment::TYPE_REREGISTRATION:
                // Biaya semeter pertama
                return CertificateReceive::getTotalPrice($user?->certificate_receive?->id);
                break;
            default:
                return 0;
                break;
        }
    }
}
