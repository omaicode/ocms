<?php
namespace Omaicode\Repository\Events;

/**
 * Class RepositoryEntityDeleted
 * @package Omaicode\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityDeleted extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "deleted";
}
