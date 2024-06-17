<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Book extends Model
{
    use HasFactory, 
        SoftDeletes,
        LogsActivity;

    protected $fillable = ['title', 'author', 'image',];
    protected static $logAttributes = ['title', 'author', 'image',];
    protected static $recordEvents = ['inserted', 'updated', 'deleted'];
    
    #[\Override]
    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()->logOnly( self::$logAttributes );
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
