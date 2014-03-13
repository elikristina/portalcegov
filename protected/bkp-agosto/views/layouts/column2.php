<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<?php if(!Yii::app()->user->isGuest):?>
		<div class="span-5 last">
			<div id="sidebar">
			<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Operações',
					'htmlOptions'=>array('visible'=>!Yii::app()->user->isGuest),
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
				));
				$this->endWidget();
			?>
			</div><!-- sidebar -->
		</div>
		<?php endif;?>
</div>
<?php $this->endContent(); ?>
