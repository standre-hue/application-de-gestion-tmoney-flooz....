<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Compte extends Model
{
    use  HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'solde',
        'type_compte'
    ];

    protected $table_name  = 'comptes';

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function approvisionnements(){
        return $this->hasMany(Approvisionnement::class);
    }


}
