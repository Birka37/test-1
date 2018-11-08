<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Plugin Follow on JQuery';
$this->params['breadcrumbs'][] = $this->title;

\app\assets\FollowAsset::register($this);
?>
<div class="user-index">

    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="working-area">
        <div class="box-follow">1</div>
        <div class="box-follow">2</div>
        <div class="box-follow">3</div>
        <div class="box-follow">4</div>
        <div class="box-follow">5</div>
    </div>

</div>
