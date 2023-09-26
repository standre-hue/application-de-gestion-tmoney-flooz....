<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type_id',
        'transaction_operation_type_id',
        'log_id',
        'compte_id',
        'user_id',
        'montant',
        'numero',
        'deleted',
        'motif'
    ];
    public function transaction_type(){
        return $this->belongsTo(TransactionType::class);
    }
    public function transaction_operation_type(){
        return $this->belongsTo(TransactionOperationType::class);
    }

    public function log(){
        return $this->belongsTo(Log::class);
    }
    public function compte(){
        return $this->belongsTo(Compte::class);
    }
}
