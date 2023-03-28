<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;
use Omaicode\Repository\Contracts\Transformable;
use Omaicode\Repository\Traits\TransformableTrait;

/**
 * Class Contact.
 *
 * @package namespace Modules\Contact\Entities;
 */
class Contact extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'content',
        'company_name'
    ];
}
