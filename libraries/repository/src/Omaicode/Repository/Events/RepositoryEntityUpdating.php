<?php
namespace Omaicode\Repository\Events;

/**
 * Class RepositoryEntityUpdated
 * @package Omaicode\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityUpdating extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "updating";
}
