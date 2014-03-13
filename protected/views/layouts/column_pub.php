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
		
		<div id="pubs">
			<h4><?php echo Yii::t('default', 'categorias')?></h4>
			<?php 
			$criteria = new CDbCriteria();
			$criteria->with = array('publicacoes'); 
			$criteria->order = 'nome ASC';
			
			$pubs = PublicacaoTipo::model()->findAll($criteria)?>
			
			<div class="pub-list <?php echo isset($_GET['t']) ? '' : 'pub-list-active'?>">
			<?php echo CHtml::link(Yii::t('default', 'todos') ." (" .Publicacao::model()->count('pessoal = false') .")",	array('/publicacao/index'));?>
			</div>
			<?php foreach($pubs as $pub):?>
				<?php if(count($pub->publicacoes_cegov) > 0):?>
					<div class="pub-list <?php echo (isset($_GET['t']) && $_GET['t'] == $pub->cod_tipo) ? 'pub-list-active' : ''?>">
						<?php  echo CHtml::link(
										$pub->nome ." (" .count($pub->publicacoes_cegov) .")",
										array('/publicacao/index', 't'=>$pub->cod_tipo)
										); ?>
					</div>
				<?php endif;?>
			<?php endforeach;?>
		</div>
	</div><!-- Sidebar -->
   </div> <!--  Span last5 -->
</div>
<?php $this->endContent(); ?>
