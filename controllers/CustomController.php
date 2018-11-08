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
    private $service;

    public function __construct($id, $module, ResizeImageWatermark $service, array $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

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

            //go...
            $this->service->resizeImage(Yii::getAlias('@app').'/web/images/example.gif',$form->width,$form->height);
        }
        //var_dump(Yii::getAlias('@app').'/web/images/example.gif');exit;

        return $this->render('pr-image', [
            'pathImage' => Yii::getAlias('@web').'/images/example.gif',
            'model' => $form
        ]);
    }
}
