<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public static function allFromUser(User $user) {
        return Note::query()
            ->where('user_id', '=', $user->id)
            ->get();
    }
}
