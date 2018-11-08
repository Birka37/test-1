<?php

namespace app\controllers;

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
        return $this->render('follow', [

        ]);
    }

}
