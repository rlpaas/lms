<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 
                            'url' => ['/'], 
                            'active' => $this->context->route == 'site/index',
                        ],

                        [
                            'label' => 'Access-Control',
                            'icon' => 'fa fa-lock',
                            'visible'=> Yii::$app->user->can('admin-permission'),
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Assignment',
                                    'icon' => 'fa fa-pencil-square-o',
                                    'url' => ['/admin'],
                                    'active' => Yii::$app->controller->id == 'assignment'
                                ],
                                [
                                    'label' => 'Role',
                                    'icon' => 'fa  fa-user-plus',
                                    'url' => ['/admin/role'],
                                    'active' => Yii::$app->controller->id == 'role'
                                ],
                                [
                                    'label' => 'Permission',
                                    'icon' => 'fa fa-gears',
                                    'url' => ['/admin/permission'],
                                    'active' => Yii::$app->controller->id == 'permission'
                                ],
                                [
                                    'label' => 'Route',
                                    'icon' => 'fa fa-map',
                                    'url' => ['/admin/route'],
                                    'active' => Yii::$app->controller->id == 'route'
                                ],
                                [
                                    'label' => 'Rule',
                                    'icon' => 'fa fa-street-view',
                                    'url' => ['/admin/rule'],
                                    'active' => Yii::$app->controller->id == 'rule'
                                ],

                            ]
                        ],
                        [
                            'label' => 'Users',
                            'icon' => 'fa fa-users',
                            'visible'=> Yii::$app->user->can('admin-permission'),
                            'url' => ['/user/admin'],
                            'active' => Yii::$app->controller->id == 'admin'
                   
                        ],

                        //['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                        //['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>
