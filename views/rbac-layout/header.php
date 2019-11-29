<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<header class="main-header">
        <!-- Logo -->
        <a href="<?= Url::to(Yii::$app->homeUrl)?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?=$title?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?=$title?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'user-image', 'alt'=>'User Image']) ?>
                  <span class="hidden-xs"><?= Yii::$app->user->identity->username; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt'=>'User Image']) ?>
                    <p>
                     <?= Yii::$app->user->identity->username; ?>
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                 
                  <li class="user-footer">
                    <div class="pull-left">
                      <?= Html::a('Profile', ['/user/settings/account'], ['class'=>'btn btn-default btn-flat']) ?>
                    </div>
                    <div class="pull-right">
                        <?=
                          Html::a('Sign out', ["/user/security/logout"],['data-method' => 'post','class'=>'btn btn-default btn-flat'])
                        ?>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
