<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language;?>">
<head>
    <meta charset="<?=Yii::$app->charset;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags();?>
    <title><?=Html::encode($this->title);?></title>
    <?php $this->head();?>
</head>
<body>
<?php $this->beginBody();?>

<div class="wrap">
    <?php
NavBar::begin([
    'brandLabel' => 'Test application',
    'brandUrl'   => Yii::$app->homeUrl,
    'options'    => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

if (!Yii::$app->user->isGuest) {
    echo Html::tag('p', 'Welcome, ' . Yii::$app->user->identity->name . '!', ['class' => 'navbar-text']);
    echo Html::tag('p', 'Your balance: ' . Yii::$app->user->identity->balance, ['class' => 'navbar-text']);
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items'   => [
        ['label' => 'Home', 'url' => ['/site/index']],
        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            Html::tag('li', Html::a('My account', ['/site/account']), [])
            . '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->name . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>'
        ),
    ],
]);
NavBar::end();
?>

    <div class="container">
        <?=Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);?>
        <?=$content;?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?=date('Y');?></p>

        <p class="pull-right"><?=Yii::powered();?></p>
    </div>
</footer>

<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>