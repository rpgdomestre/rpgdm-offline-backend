<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SourceTwitter
 *
 * @package App
 *
 * @method void truncate
 */
class SourceTwitter extends Model
{
    protected $fillable = [
        'source',
        'twitter'
    ];
}
