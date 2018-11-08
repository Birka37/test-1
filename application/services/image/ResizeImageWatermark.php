<?php

namespace application\services\image;


use yii\web\NotFoundHttpException;

class ResizeImageWatermark
{
    const FILTER_TYPE = 'Lanczos';
    const BLUR = 1;
    const FONT_SIZE = 15;


    private $sourceX = 0;
    private $sourceY = 0;

    private $destW = 0;
    private $destH = 0;
    private $destX = 0;
    private $destY = 0;

    private $sourceW = 0;
    private $sourceH = 0;

    private $originalW = 0;
    private $originalH = 0;
    private $sourceType;
    private $sourceImage;

    private $text = 'watermark';

    public function __construct($filename)
    {
        if ($filename === null || empty($filename)) {
            throw new NotFoundHttpException('File does not exist');
        }

        $image_info = getimagesize($filename);
        list(
            $this->originalW,
            $this->originalH,
            $this->sourceType
            ) = $image_info;

        $this->sourceImage = imagecreatefromgif($filename);
        return $this->resize($this->getSourceWidth(), $this->getSourceHeight());
    }

    public function getSourceWidth()
    {
        return $this->originalW;
    }

    public function getSourceHeight()
    {
        return $this->originalH;
    }

    public function getDestWidth()
    {
        return $this->destW;
    }

    public function getDestHeight()
    {
        return $this->destH;
    }

    public function resize($width, $height){
        $this->sourceX = 0;
        $this->sourceY = 0;

        $this->destW = $width;
        $this->destH = $height;

        $this->sourceW = $this->getSourceWidth();
        $this->sourceH = $this->getSourceHeight();

        return $this;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function save($filename, $type = null){


        $destImage = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());
        $background = imagecolorallocatealpha($destImage, 255, 255, 255, 1);
        imagecolortransparent($destImage, $background);
        imagefill($destImage, 0, 0, $background);
        imagesavealpha($destImage, true);

        imagegammacorrect($this->sourceImage, 2.2, 1.0);
        imagecopyresampled(
            $destImage,
            $this->sourceImage,
            $this->destX,
            $this->destY,
            $this->sourceX,
            $this->sourceY,
            $this->getDestWidth(),
            $this->getDestHeight(),
            $this->sourceW,
            $this->sourceH
        );

        imagegammacorrect($destImage, 1.0, 2.2);
        imagettftext($destImage,self::FONT_SIZE,0,$this->getDestWidth() -  mb_strlen($this->text) * self::FONT_SIZE , $this->getDestHeight() - self::FONT_SIZE,000,__DIR__.'/fonts/Arial.ttf',$this->text);

        imagegif($destImage,$filename);

        imagedestroy($destImage);
        return $this;
    }
}
