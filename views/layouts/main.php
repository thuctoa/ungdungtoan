<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
//            NavBar::begin([
//                'brandLabel' => Yii::t('app','My Company'),
//                'brandUrl' => Yii::$app->homeUrl,
//                'options' => [
//                    'class' => 'navbar-inverse navbar-fixed-top',
//                ],
//            ]);
//            
//            $items = [
//                    ['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
//                    ['label' => Yii::t('app','About'), 'url' => ['/site/about']],
//                    ['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']],
//                    ['label' => Yii::t('app','Books'), 'url' => ['/book/index']],
//                     ['label' => Yii::t('app','Authors'), 'url' => ['/author/index']],
//                    Yii::$app->user->isGuest ?
//                        ['label' => Yii::t('app','Login'), 'url' => ['/site/login']] :
//                        ['label' => Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')',
//                            'url' => ['/site/logout'],
//                            'linkOptions' => ['data-method' => 'post']],
//                ];
//            if(Yii::$app->user->isGuest){
//                $items[] = ['label' => Yii::t('app','Signup'), 'url' => ['/site/signup']];
//            }
//            if ( Yii::$app->user->can('permission_admin') )
//                $items[] = ['label' => Yii::t('app','Permissions'), 'url' => ['/admin/assignment']];
//            
//            echo Nav::widget([
//                'options' => ['class' => 'navbar-nav navbar-right'],
//                'items' => $items,
//            ]);
//            NavBar::end();
        ?>
        
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div  id="language-selector" class="pull-right" style="position: relative;">
            <?= \app\components\widgets\LanguageSelector::widget(); ?>
        </div>
        <div class="container">
            <p class="pull-left">&copy; <?=Yii::t('app','My Company')?> <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::ngongu() ?></p>
        </div>
         
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
