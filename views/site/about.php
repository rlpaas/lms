<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Time Line';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
<ul class="timeline">

<?php $a = array(['date'=> ' 12 Feb. 2014', 'name'=> 'Audit Commitee', 'remarks'=> 'your loan approved by one of the audit committee','status'=> 'accept'],['date'=> ' 11 Feb. 2014', 'name'=> 'CEU-CC', 'remarks'=> 'your loan accept by the cc incharge','status'=> 'pending'],['date'=> ' 10 Feb. 2014', 'name'=> 'Roden L. Paas', 'remarks'=> 'thank you for applying Bday loan','status'=> 'pending']); ?>

<?php foreach($a as $k => $v): ?>
    <!-- timeline time label -->
    <li class="time-label">
    	<?php if($v['status'] == 'accept'): ?>
        	<span class="bg-green">
        <?php else: ?>
        	<span class="bg-red">
        <?php endif; ?>
           <?= $v['date'] ?>
        </span>
    </li>

    <!-- /.timeline-label -->

    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-envelope bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

            <h3 class="timeline-header"><a href="#"><?= $v['name'] ?></a></h3>

            <div class="timeline-body">
                <?= $v['remarks'] ?>
            </div>
        </div>
    </li>
    <!-- END timeline item -->
<?php endforeach; ?>
</ul>
</div>
