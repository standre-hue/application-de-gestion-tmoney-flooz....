<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Approvisionnement extends Model
{
    use  HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'montant',
        'user_id',
        'compte_id'
    ];

    protected $table_name  = 'approvisionnements';

    public function compte(){
        return $this->belongsTo(Compte::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


}
