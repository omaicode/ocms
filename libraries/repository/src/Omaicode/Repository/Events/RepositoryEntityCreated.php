<?php
namespace Omaicode\Repository\Events;

/**
 * Class RepositoryEntityCreated
 * @package Omaicode\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityCreated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "created";
}
