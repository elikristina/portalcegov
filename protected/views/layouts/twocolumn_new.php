<?php 
/**
 * Layout da página de publicações.
 */

Yii::app()->clientScript->registerScript('carousel', "

$('.carousel').carousel({
  interval: 5000
})
");
?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="container-fluid">
	<div class="row-fluid">
	
        <div class="span9 default-container">
        
        <?php $noticias = Noticia::model()->findAll(array('order'=>'data_postagem, titulo', 'limit'=>5))?>
        <div id="myCarousel" class="carousel slide" >
		  <!-- Carousel items -->
		  <div class="carousel-inner">
		  
		  <div class="active item ">
		  	<div class="row-fluid">
		  		<div class="span10 offset1">
		  			<?php $this->renderPartial('/new/_view', array('data'=>$noticias[0]))?>
		  		</div>
		  	</div>
		  </div>
		  <?php for($i=1; $i < count($noticias); $i++):?>
		  <div class="item">
		  	<div class="row-fluid">
		  		<div class="span10 offset1">
		  		<?php $this->renderPartial('/new/_view', array('data'=>$noticias[$i]))?>
		  		</div>
		  	</div>
		  </div>
		  <?php endfor;?>
		  </div>
		  <!-- Carousel nav -->
		  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
		
		</div><!-- /span -->
		
		<!-- Lateral -->
		<div class="span3">
		<div class="widget-side">
			<!-- Publicações -->
				<div id="pubs">
					<h4>Publicações</h4>
					<?php $pubs = Publicacao::model()->findAll(array('order'=>'titulo','condition'=>'pessoal=false' , 'limit'=>5))?>
					<?php foreach($pubs as $pub):?>
						<div class="pub-list" >
							<?php echo CHtml::link($pub->titulo, array('/publicacao/view', 'id'=>$pub->cod_publicacao));?>
						</div>
					<?php endforeach;?>
				</div>
				<br><?php echo CHtml::link('Mais Publicações', array('/publicacao'), array('class'=>'button'))?>
			</div><!-- well -->

		<!-- Notícias -->
			<div class="widget-side">
			<div id="pubs">
				<h4>Notícias</h4>
				<?php $news = Noticia::model()->findAll(array('order'=>'data_postagem, titulo', 'condition'=>'eh_evento=false', 'limit'=>5))?>
				<?php foreach($news as $new):?>
					<div class="pub-list" >
						<?php echo CHtml::link($new->titulo, array('/new/view', 'id'=>$new->cod_noticia));?>
					</div>
				<?php endforeach;?>
			</div>
			<br><?php echo CHtml::link('Mais Notícias', array('/new'), array('class'=>'button'))?>
			</div><!-- well -->
			
			<!-- Eventos -->
			<div class="widget-side">
		<div id="pubs">
			<h4>Eventos</h4>
			<?php $eventos = Noticia::model()->findAll(array('order'=>'data_postagem, titulo', 'condition'=>'eh_evento=true', 'limit'=>5))?>
			<?php foreach($eventos as $event):?>
				<div class="pub-list" >
					<?php echo CHtml::link($event->titulo, array('/new/view', 'id'=>$event->cod_noticia));?>
				</div>
			<?php endforeach;?>
		</div>
		<br><?php echo CHtml::link('Mais Eventos', array('/new/events'), array('class'=>'button'))?>
	</div><!-- well -->
			
		 </div> 
</div><!-- /row -->
</div> <!-- /container -->

<?php $this->endContent(); ?>
