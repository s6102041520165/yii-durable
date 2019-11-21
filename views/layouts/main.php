<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

class MyDev extends Yii {

    public static function powered() {
        echo "Powered by Business Computer";
    }

}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            .nav-right{
                margin-left: auto;
            }
            footer{
                bottom: 0px;
                display: block;
                width: 100%;
            }

        </style>
    </head>
    <body>
        <div class="wrap">
            <?php $this->beginBody() ?>       
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'fixed-top navbar-expand-md navbar-dark bg-dark',
                ],
            ]);
            echo Nav::widget([
                'items' => [
                        [
                        'label' => 'หน้าแรก',
                        //'options' => ['class' => 'active'],
                        'url' => ['/site/index'],
                    ],
                    /**
                        ['label' => 'ผู้ใช้', 'url' => ['/users'], 'visible' => Yii::$app->user->can('manageUser') ? TRUE : FALSE],
                        ['label' => 'คำนำหน้า', 'url' => ['/prefix'], 'visible' => Yii::$app->user->can('managePrefix') ? TRUE : FALSE],
                        ['label' => 'ครู', 'url' => ['/teachers'], 'visible' => Yii::$app->user->can('manageTeacher') ? TRUE : FALSE],
                        ['label' => 'ประเภทพัสดุ', 'url' => ['/types'], 'visible' => Yii::$app->user->can('manageType') ? TRUE : FALSE],
                        ['label' => 'หน่วย', 'url' => ['/units'], 'visible' => Yii::$app->user->can('manageUnit') ? TRUE : FALSE],
                        ['label' => 'แบรนด์', 'url' => ['/brand'], 'visible' => Yii::$app->user->can('manageBrand') ? TRUE : FALSE],
                        ['label' => 'พัสดุ', 'url' => ['/materials'], 'visible' => Yii::$app->user->can('manageMaterial') ? TRUE : FALSE],
                        ['label' => 'ออเดอร์', 'url' => ['/orders'], 'visible' => !Yii::$app->user->isGuest ? TRUE : FALSE],
                    /*                     * */
                        [
                        'label' => 'จัดการข้อมูล',
                        'items' => [
                                ['label' => 'ผู้ใช้', 'url' => ['/users'], 'visible' => Yii::$app->user->can('manageUser') ? TRUE : FALSE],
                                ['label' => 'คำนำหน้า', 'url' => ['/prefix'], 'visible' => Yii::$app->user->can('managePrefix') ? TRUE : FALSE],
                                ['label' => 'ครู', 'url' => ['/teachers'], 'visible' => Yii::$app->user->can('manageTeacher') ? TRUE : FALSE],
                                ['label' => 'ประเภทพัสดุ', 'url' => ['/types'], 'visible' => Yii::$app->user->can('manageType') ? TRUE : FALSE],
                                ['label' => 'หน่วย', 'url' => ['/units'], 'visible' => Yii::$app->user->can('manageUnit') ? TRUE : FALSE],
                                ['label' => 'แบรนด์', 'url' => ['/brand'], 'visible' => Yii::$app->user->can('manageBrand') ? TRUE : FALSE],
                                ['label' => 'พัสดุ', 'url' => ['/materials'], 'visible' => Yii::$app->user->can('manageMaterial') ? TRUE : FALSE],
                                ['label' => 'การเบิก', 'url' => ['/orders'], 'visible' => !Yii::$app->user->isGuest ? TRUE : FALSE],
                        ],
                    ],
                    /*                     * ** */
                    Yii::$app->user->isGuest ? (
                                ['label' => 'Login', 'url' => ['/site/login']]
                            ) : (
                            '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-danger']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                ],
                'options' => ['class' => 'navbar-nav nav-right'], // set this to nav-tab to get tab-styled navigation
            ]);
            NavBar::end();
            ?>

            <div class="container">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="float-left">&copy; Phatthalung Technical College <?= date('Y') ?></p>

                <p class="float-right"><?= MyDev::powered() ?></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
        <?php $this->endPage() ?>
