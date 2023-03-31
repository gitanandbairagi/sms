<?php

namespace App\Models;

use App\Models\Scopes\AncientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    use HasFactory;

    public static function booted(): void {
        static::addGlobalScope(new AncientScope);
    }
}
