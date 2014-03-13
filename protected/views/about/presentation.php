<?php
$this->breadcrumbs=array(
	Yii::t('default','sobre')=>array('/about/index'),
	$title,
);?>

<?php Yii::app()->clientScript->registerScript('hover', "

$('.quad').hover(function(){
	$(this).css('background-color', '#1b3959');
}, function(){
	$(this).css('background-color', '#4e4e4e');
});

"); ?>

<div class="row-fluid">
	<div class="span12">
		<?php echo $content?>
	
	
		<?php if(Yii::app()->user->name == 'admin'):?>
			<?php echo CHtml::link("Editar", 
				array("/about/updatePresentation"),
				array(
					'class'=>"btn btn-small btn-primary",
					)
				);?>
		<?php endif;?>
	</div>
</div>

<br />

<div class="row-fluid">
	<div class="span2">
		<a href="#">
			<div class="quad">
				<p><?php echo CHtml::encode(Yii::t('default', 'apresentacao')); ?></p>
			</div>
		</a>
	</div>
	<div class="span2">
		<a href="/cegov/about/structure">
			<div class="quad">
				<p><?php echo CHtml::encode(Yii::t('default', 'estrutura')); ?></p>
			</div>
		</a>
	</div>
	<div class="span2">
		<a href="/cegov/gt">
			<div class="quad">
				<p><?php echo CHtml::encode(Yii::t('default', 'gts')); ?></p>
			</div>
		</a>
	</div>
	<div class="span2">
		<a href="/cegov/pessoa">
			<div class="quad">
				<p><?php echo CHtml::encode(Yii::t('default', 'equipe')); ?></p>
			</div>
		</a>
	</div>
	<div class="span2">
		<a href="/cegov/about/partners">
			<div class="quad">
				<p><?php echo CHtml::encode(Yii::t('default', 'parceiros')); ?></p>
			</div>
		</a>
	</div>
	<div class="span2">
		<a href="mailto:cegov@cegov.ufrgs.br">
			<div class="quad">
				<p><?php echo CHtml::encode(Yii::t('default', 'contato')); ?></p>
			</div>
		</a>
	</div>
</div>



