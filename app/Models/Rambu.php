<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;          
use Spatie\Activitylog\LogOptions;                  
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $nama_rambu
 * @property string $jenis
 * @property string $lokasi
 * @property string $kondisi
 * @property string|null $koordinat_gps
 * @property string|null $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereKondisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereKoordinatGps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereNamaRambu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rambu withoutTrashed()
 * @mixin \Eloquent
 */
class Rambu extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;     

    protected $fillable = [
        'nama_rambu', 'jenis', 'lokasi', 'koordinat_gps',
        'kondisi', 'foto', 'user_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama_rambu', 'jenis', 'lokasi', 'kondisi', 'koordinat_gps'])
            ->logOnlyDirty() // hanya simpan field yang berubah
            ->setDescriptionForEvent(fn(string $eventName) => "Rambu telah {$eventName}")
            ->useLogName('rambu');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}