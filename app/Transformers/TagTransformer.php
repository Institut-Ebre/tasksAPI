<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 11/01/16
 * Time: 18:25
 */

namespace App\Transformers;


class TagTransformer extends Transformer
{
    public function transform($item)
    {
        return [
            //'id'    => $tag['id'],
            'title' => $item['name'],
            //'created'    => $tag['created_at'],
            //'updated_at'    => $tag['updated_at']
        ];
    }
}