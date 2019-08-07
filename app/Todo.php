<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
        'user_id_created',
        'user_id_lastupdate',
        'user_id_worker',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->user_id_create = $user->id;
            $model->user_id_lastupdate = $user->id;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->user_id_lastupdate = $user->id;
        });
    }
    public function worker(){
        return $this->belongsTo(User::class, 'user_id_worker', 'id');
    }
    public function boss(){
        return $this->belongsTo(User::class, 'user_id_create', 'id');
    }
}
