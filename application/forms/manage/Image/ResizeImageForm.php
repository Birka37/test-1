<?php

namespace application\forms\manage\Image;

use yii\base\Model;

class ResizeImageForm extends Model
{
    public $width;
    public $height;
    public $image;
    public $marka;

    public function rules(): array
    {
        return [
            [['width', 'height', ], 'required'],
            [['height', 'width',], 'integer'],
            [['marka', ], 'string'],
        ];
    }
}
