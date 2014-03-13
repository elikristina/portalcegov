<?php 
/**
 * Layout da página de publicações.
 */
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-5 last">
		<div id="sidebar">
		<?php if(!Yii::app()->user->isGuest):?>
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
		<?php endif;?>
		
		<div id="gts">
			<h4>Grupos de Trabalho</h4>
			
			<?php $gts = GrupoTrabalho::model()->findAll(array('order'=>'nome', 'condition'=>'visible = true', 'limit'=>5))?>
			<?php foreach($gts as $gt):?>
				<div class="pub-list">
				<?php echo CHtml::link($gt->nome, array('/gt/view', 'id'=>$gt->cod_gt));?>
				</div>
			<?php endforeach;?>
		</div>
		<br>
		<div id="pubs">
			<h4>Últimas Publicações</h4>
			<?php $pubs = Publicacao::model()->findAll(array('order'=>'titulo', 'limit'=>5))?>
			<?php foreach($pubs as $pub):?>
				<div class="pub-list" >
				<?php echo CHtml::link($pub->titulo, array('/publicacao/view', 'id'=>$pub->cod_publicacao));?>
				</div>
			<?php endforeach;?>
		</div>
	</div><!-- Sidebar -->
   </div> <!--  Span last5 -->
</div>
<?php $this->endContent(); ?>
