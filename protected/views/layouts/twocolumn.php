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
	  
		<div class="span3 hidden-phone ">
		<!-- <div class="well well-small "> -->
		<div class="widget-side">
		<div id="sidebar">
		<div id="pubs">
			<h4>Últimas Publicações</h4>
			<?php $pubs = Publicacao::model()->findAll(array('order'=>'titulo','condition'=>'pessoal=false' , 'limit'=>20))?>
			<?php foreach($pubs as $pub):?>
				<div class="pub-list" >
					<?php echo CHtml::link($pub->titulo, array('/publicacao/view', 'id'=>$pub->cod_publicacao));?>
				</div>
			<?php endforeach;?>
		</div>
		</div><!-- Sidebar -->
	</div><!-- well -->
   </div> <!--  span2 -->
	
</div><!-- /row -->
</div> <!-- /container -->
<?php $this->endContent(); ?>
