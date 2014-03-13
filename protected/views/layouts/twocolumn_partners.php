<?php 
/**
 * Layout da página de publicações.
 */
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container-fluid">
	<div class="row-fluid">
	
        <div class="span9 default-container">
		<?php echo $content; ?>
		</div><!-- /span -->
	  
		<div class="span3 hidden-phone">
		<div class="well well-small">
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
			<?php $pubs = Publicacao::model()->findAll(array('order'=>'titulo','condition'=>'pessoal=false' , 'limit'=>5))?>
			<?php foreach($pubs as $pub):?>
				<div class="pub-list" >
					<div style="float:left" >
					<?php echo CHtml::image($pub->imageLink,'image' ,array('width'=>'20px'));?>
					</div>
					<div style="float:right" >
					<?php echo CHtml::link($pub->titulo, array('/publicacao/view', 'id'=>$pub->cod_publicacao));?>
					</div>
					<div class="clearfix"></div>
									
				
				</div>
			<?php endforeach;?>
		</div>
		</div><!-- Sidebar -->
	</div><!-- well -->
   </div> <!--  span2 -->
	
</div><!-- /row -->
</div> <!-- /container -->
<?php $this->endContent(); ?>
