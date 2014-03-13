<?php 
/**
 * Layout da página de publicações.
 */

Yii::app()->clientScript->registerScript('carousel', "

$('.carousel').carousel({
  interval: false
})
");
?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="container-fluid">


	<div class="row-fluid">
	
        <div class="span12 default-container">
        <?php echo $content?>
		</div><!-- /span -->
	</div>
	

   
   <?php $news = Noticia::model()->findAll(array('order'=>'data_postagem, titulo', 'limit'=>6))?>
	<?php if(count($news) > 0):?>
		<div class="row-fluid">
   			<div class="span12">
   				<h4>Notícias</h4>
   			</div>
   		</div>
	<?php endif;?>
   
   
   <div class="row-fluid">
		<?php for($i=0; $i < count($news); $i+=3):?>
		<div class="row-fluid">
			<?php if($i < count($news)):?>
			<div class="span4 news-text">
			<h5><?php echo CHtml::link($news[$i]->titulo, array('/new/view', 'id'=>$news[$i]->cod_noticia))?></h5>
			<p><?php echo $news[$i]->texto?></p>
			</div>
			<?php endif;?>
			
			<?php if($i+1 < count($news)):?>
			<div class="span4 news-text">
			<h5><?php echo CHtml::link($news[$i+1]->titulo, array('/new/view', 'id'=>$news[$i+1]->cod_noticia))?></h5>
			<p><?php echo $news[$i+1]->texto?></p>
			</div>
			<?php endif;?>
			
			<?php if($i+2 < count($news)):?>
			<div class="span4 news-text">
			<h5><?php echo CHtml::link($news[$i+2]->titulo, array('/new/view', 'id'=>$news[$i+2]->cod_noticia))?></h5>
			<p><?php echo $news[$i+2]->texto?></p>
			</div>
			<?php endif;?>
		</div>
		<hr>
		<?php endfor;?>
   </div>
   
   
   	 <div class="row-fluid">
   		<div class="span12">
   			<h4>Notícias</h4>
   		</div>
   	</div> 
   
	<div class="row-fluid">
	   <!-- Notícias -->
	   <div class="span4">
			<div class="widget-side">
			<div id="pubs">
				<h4>Notícias</h4>
				<?php $news = Noticia::model()->findAll(array('order'=>'data_postagem, titulo', 'limit'=>6))?>
				<?php foreach($news as $new):?>
					<div class="pub-list" >
						<?php echo CHtml::link($new->titulo, array('/new/view', 'id'=>$new->cod_noticia));?>
					</div>
				<?php endforeach;?>
			</div>
			<br><?php echo CHtml::link('Mais Notícias', array('/new'), array('class'=>'button'))?>
		</div><!-- well -->
	   </div> <!--  span2 -->
   </div><!-- /row -->
	

</div> <!-- /container -->
<?php $this->endContent(); ?>
