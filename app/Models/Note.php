<?php

namespace App\Models;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Note extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'status',
        'file_path'
    ];
    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getShamsiDateAttribute()
    {
        if (! $this->date) return null;
        $carbon = $this->date instanceof Carbon ? $this->date : Carbon::parse($this->date);
        return Jalalian::fromCarbon($carbon)->format('Y/m/d');
    }

    public function getFileSizeAttribute()
    {
        if ($this->file_path && Storage::disk('public')->exists($this->file_path)) {
            $sizeInBytes = Storage::disk('public')->size($this->file_path);

            if ($sizeInBytes >= 1048576) {
                return round($sizeInBytes / 1048576, 2) . ' مگابایت';
            }

            return round($sizeInBytes / 1024, 2) . ' کیلوبایت';
        }

        return null;
    }
}
