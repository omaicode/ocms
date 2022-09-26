<?php namespace Omaicode\Repository\Transformer;

use League\Fractal\TransformerAbstract;
use Omaicode\Repository\Contracts\Transformable;

/**
 * Class ModelTransformer
 * @package Omaicode\Repository\Transformer
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class ModelTransformer extends TransformerAbstract
{
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}
