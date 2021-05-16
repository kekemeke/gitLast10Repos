<?php
declare(strict_types=1);

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '10 last updated git users repos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="git-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'link',
            'updated_at',
        ],
    ]); ?>

</div>
