<?php

namespace application\services\image;


class ResizeImageWatermark
{
    const FILTER_TYPE = 'Lanczos';
    const BLUR = 1;

    public function resizeImage($imagePath, $width, $height){
        $imagick = new \Imagick(realpath($imagePath));

        $imagick->resizeImage($width, $height, self::FILTER_TYPE, self::BLUR);

        header("Content-Type: image/jpg");
        echo $imagick->getImageBlob();
    }
}
