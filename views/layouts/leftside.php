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
        <?= Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 
                            'url' => ['/'], 
                            'active' => $this->context->route == 'site/index',
                        ],

                        [
                            'label' => 'Members Profile',
                            'icon' => 'fa fa-users',
                            'visible'=> Yii::$app->user->can('admin-permission'),
                            'url' => ['/profile/index'],
                            'active' => Yii::$app->controller->id == 'profile'
                               
                        ],

                        [
                            'label' => 'Account',
                            'icon' => 'fa fa-bank',
                            'visible'=> Yii::$app->user->can('admin-permission'),
                            'url' => ['/account/accounts'],
                            'active' => Yii::$app->controller->id == 'account'
                               
                        ],

                        [
                            'label' => 'Accounting',
                            'icon' => 'fa fa-calculator',
                            'visible'=> Yii::$app->user->can('admin-permission'),
                            'url' => '#',
                            'items' => [
                                   [
                                        'label' => 'General Ledger',
                                        'icon' => 'fa fa-file-pdf-o',
                                        'url' => ['/chart-of-account/general-ledger'],
                                        'active' => Yii::$app->controller->id == 'chart-of-account'
                               
                                    ],
                                    [
                                        'label' => 'Chart of Account',
                                        'icon' => 'fa fa-bar-chart',
                                        'url' => ['/chart-of-account/index'],
                                        'active' => Yii::$app->controller->id == 'chart-of-account'
                               
                                    ],
                                ],
                        ],

                        [
                            'label' => 'System Settings',
                            'icon' => 'fa fa-gears',
                            'visible'=> Yii::$app->user->can('admin-permission'),
                            'url' => '#',
                            'items' => [
                                    [
                                        'label'=> 'Access-Control',
                                        'icon' => 'fa fa-lock',
                                        'url'=>'#',
                                        'items'=> [
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
                                                'icon' => 'fa fa-gear',
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

                                        ],

                                    ],

                                    [
                                        'label' => 'Users',
                                        'icon' => 'fa fa-users',
                                        'url' => ['/user/admin'],
                                        'active' => Yii::$app->controller->id == 'admin'
                               
                                    ],

                                    [
                                        'label'=> 'DropDown-List',
                                        'icon' => 'fa fa-level-down',
                                        'url'=>'#',
                                        'items'=> [
                                            [
                                                'label' => 'Campus',
                                                'icon' => 'fa fa-building',
                                                'url' => ['/campus/index'],
                                                'active' => Yii::$app->controller->id == 'campus'
                                            ],

                                            [
                                                'label' => 'School/College',
                                                'icon' => 'fa fa-building-o',
                                                'url' => ['/school-college/index'],
                                                'active' => Yii::$app->controller->id == 'school-college'
                                            ],

                                            [
                                                'label' => 'Department/Division',
                                                'icon' => 'fa fa-bank',
                                                'url' => ['/department-division/index'],
                                                'active' => Yii::$app->controller->id == 'department-division'
                                            ],

                                            [
                                                'label' => 'Entity Type',
                                                'icon' => 'fa fa-users',
                                                'url' => ['/entity-type/index'],
                                                'active' => Yii::$app->controller->id == 'entity-type'
                                            ],
                                            [
                                                'label' => 'Account Type',
                                                'icon' => 'fa fa-money',
                                                'url' => ['/account-type/index'],
                                                'active' => Yii::$app->controller->id == 'account-type'
                                            ],
                                            

                                        ],

                                    ],

                            ]
                        ],
                        [
                            'label' => 'My Profile',
                            'icon' => 'fa fa-users',
                            'visible'=> Yii::$app->user->can('members-permission'),
                            'url' => ['/profile/view','id'=>Yii::$app->user->id],
                            'active' => Yii::$app->controller->id == 'profile'
                               
                        ],
                        [
                            'label' => 'My Account',
                            'icon' => 'fa fa-bank',
                            'visible'=> Yii::$app->user->can('members-permission'),
                            'url' => ['/account/accounts'],
                            'active' => Yii::$app->controller->id == 'account'
                               
                        ],

                         [
                            'label' => 'My Settings',
                            'icon' => 'fa fa-gears',
                            'visible'=> Yii::$app->user->can('members-permission'),
                            'url' => '#',
                            'items' => [
                                  
                                    [
                                        'label' => 'User Info',
                                        'icon' => 'fa fa-users',
                                        'url' => ['/user/settings/account'],
                                        'active' => Yii::$app->controller->id == 'admin'
                               
                                    ],
                                ]
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
