<?php
use application\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model application\forms\auth\LoginForm */

$this->title = 'Sign In';

?>

<div class="login-box">

    <div class="login-box-body">


        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p class="login-box-msg">Sign in to start your session</p>

                <?= Alert::widget() ?>
            </div>

            <div class="col-md-6 col-md-offset-3">
                <?= $form
                    ->field($model, 'username')
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <?= $form
                    ->field($model, 'password')
                    ->label(false)
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <div class="col-xs-8">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                    </div>
                    <!-- /.col -->
                </div>

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
