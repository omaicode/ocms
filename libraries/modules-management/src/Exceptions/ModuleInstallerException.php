

<?php
namespace Omaicode\Modules\Exceptions;

use Exception;

class ModuleInstallerException extends Exception
{
    public static function fromInvalidPackage(string $invalidPackageName): self
    {
        return new self(
            "Ensure your package's name ({$invalidPackageName}) is in the format <vendor>/<ocms>-<name>"
        );
    }
}