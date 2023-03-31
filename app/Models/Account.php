<?php

namespace App\Models;

use App\Models\Scopes\AncientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public static function booted(): void {
        static::addGlobalScope(new AncientScope);
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'order_id', 'order_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
