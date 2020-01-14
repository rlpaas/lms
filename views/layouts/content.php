<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\AlertLte;

?>
	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
			Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="box">
				<div class="box-body">
					<?= $content ?>
				</div>
			</div>
			
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
