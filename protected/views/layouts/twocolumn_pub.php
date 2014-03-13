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
										$pub->t('nome') ." (" .count($pub->publicacoes_cegov) .")",
										array('/publicacao/index', 't'=>$pub->cod_tipo)
										); ?>
					</div>
				<?php endif;?>
			<?php endforeach;?>
			</div>
		</div>
	</div><!-- Sidebar -->
   </div> <!--  /span2 -->
	
</div><!-- /row -->
</div> <!-- /container -->
<?php $this->endContent(); ?>
