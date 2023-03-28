<?php

namespace Modules\Contact\Repositories;

use Omaicode\Repository\Eloquent\BaseRepository;
use Omaicode\Repository\Criteria\RequestCriteria;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Validators\ContactValidator;

/**
 * Class ContactRepositoryEloquent.
 *
 * @package namespace Modules\Contact\Repositories;
 */
class ContactRepositoryEloquent extends BaseRepository implements ContactRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contact::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
