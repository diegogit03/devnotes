<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public function User() {
        $this->belongsTo(User::class);
    }

    public static function allFromUser(User $user) {
        return Note::query()
            ->whereBelongsTo($user)
            ->get();
    }
}
