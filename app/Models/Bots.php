<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bots
 *
 *
 * @property int $id ID
 * @property string $provider Имя бота
 * @property string $token Токен доступа
 * @property int $active Флаг доступа
 */
class Bots extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'provider',
        'token',
        'active'
    ];
}
