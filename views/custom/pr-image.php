<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $pathImage string  */
/* @var $model application\forms\manage\Image\ResizeImageForm  */

$this->title = 'Resize Image + Watermark';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="control-panel">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'width')->textInput() ?>
                <?= $form->field($model, 'height')->textInput() ?>
                <div class="form-group">
                    <?= Html::submitButton( 'Update', ['class' => 'btn btn-primary']) ?>
                </div>
                <?$form::end()?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="working-area" style="text-align: center">
                <img style="border:4px solid #d9534f" src="<?=$pathImage?>" />
            </div>
        </div>
    </div>

</div>
