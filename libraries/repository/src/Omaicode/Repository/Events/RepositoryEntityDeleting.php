<?php
namespace Omaicode\Repository\Events;

/**
 * Class RepositoryEntityDeleted
 * @package Omaicode\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityDeleting extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "deleting";
}
