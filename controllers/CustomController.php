<?php

namespace app\controllers;

use application\forms\manage\Image\ResizeImageForm;
use application\services\image\ResizeImageWatermark;
use Yii;
use yii\web\Controller;

/**
 * CustomController implements custom tasks.
 */
class CustomController extends Controller
{
    /**
     * @return mixed
     */
    public function actionFollow()
    {
        return $this->render('follow', []);
    }

    /**
     * @return mixed
     */
    public function actionPrImage()
    {
        $form = new ResizeImageForm();
        if($form->load(Yii::$app->request->post()) && $form->validate()){

            $image = new ResizeImageWatermark(Yii::getAlias('@app').'/web/images/example.gif');
            $image->setText($form->marka);
            $image->resize($form->width, $form->height);
            $randomNameFile = uniqid('test_').'_'.microtime().'.gif';
            $image->save(\Yii::getAlias('@app').'/web/images/temp/'.$randomNameFile);
            $form->image = \Yii::getAlias('@web').'/images/temp/'.$randomNameFile;
        }
        return $this->render('pr-image', [
            'pathImage' => $form->image ?: Yii::getAlias('@web').'/images/example.gif',
            'model' => $form
        ]);
    }
}
