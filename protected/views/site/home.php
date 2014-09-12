
<?php
$this->breadcrumbs=array(
	$title
	
);

Yii::app()->clientScript->registerScript('carousel', "

$('.carousel').carousel({
  interval: 5000,
  pause: 'hover',
  
});
");

Yii::app()->clientScript->registerScript('semi-carousel',"
/*
	$('#semi-carousel').carousel({
  		interval: 4000,
		pause: false
	})
*/
			
");

?>

<?php $noticias = Noticia::model()->findAll(array('order'=>'cod_noticia DESC, titulo', 'limit'=>5))?>
<div id="myCarousel" class="carousel slide hidden-phone" >
  
  <div class="carousel-inner ">
  
  <div class="active item ">
  	<div class="row-fluid">
  		<div class="span12">
  			<?php $this->renderPartial('/new/_view_carousel', array('data'=>$noticias[0]))?>
  		</div>
  	</div>
  </div>
  <?php for($i=1; $i < count($noticias); $i++):?>
  <div class="item">
  	<div class="row-fluid">
  		<div class="span12">
  		<?php $this->renderPartial('/new/_view_carousel', array('data'=>$noticias[$i]))?>
  		</div>
  	</div>
  </div>
  <?php endfor;?>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>


<div class="row-fluid">
	<ul class="thumbnails">
	 	<li class="span4">
		    <div class="thumbnail scroll">
		    	<?php echo CHtml::image(Yii::app()->baseUrl .'/images/site/noticias.jpg', 'Imagem das Notícias')?>
		      	<div class="titulo">
		      		<h3><?php echo CHtml::link(Yii::t('default', 'noticias'), array('/new'))?></h3>
		  		</div>
			    <?php $news = Noticia::model()->findAll(array('order'=>'cod_noticia DESC, titulo', 'condition'=>'eh_evento=false', 'limit'=>4))?>
				<?php foreach($news as $new):?>
					<div class="pub-list" >
						<?php echo CHtml::link($new->titulo, array('/new/view', 'id'=>$new->cod_noticia));?>
					</div>
				<?php endforeach;?>
					    
		    </div>
	  	</li>
	  	<li class="span4">
		    <div class="thumbnail scroll">
		    	<?php echo CHtml::image(Yii::app()->baseUrl .'/images/site/eventos.jpg', 'Imagem das Eventos')?>
		      	<div class="titulo">
		      		<h3><?php echo CHtml::link(Yii::t('default', 'eventos'), array('/new/events'))?></h3>
		  		</div>
		      	<?php $eventos = Noticia::model()->findAll(array('order'=>'cod_noticia DESC, titulo', 'condition'=>'eh_evento=true', 'limit'=>4))?>
				<?php foreach($eventos as $event):?>
					<div class="pub-list" >
						<?php echo CHtml::link($event->titulo, array('/new/view', 'id'=>$event->cod_noticia));?>
					</div>
				<?php endforeach;?>
		    </div>
	  	</li>
	  	<li class="span4">
		    <div class="thumbnail scroll">
		      	<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl .'/images/site/mds_banner5.png', 'Logo do Ciclo de Capacitação do MDS', array('width'=>'289')), 'http://www.ufrgs.br/cegov/new/n/218?n=Orienta%C3%A7%C3%B5es_de_acesso_ao_Moodle_para_o_curso_em_Diagn%C3%B3stico_do_MDS')?>
		       <!--	<div class="titulo">
		      		<h3><?php echo CHtml::link(Yii::t('default', 'publicacoes'), array('/publicacao'))?></h3>
		  		</div>
		      	<?php $pubs = Publicacao::model()->findAll(array('order'=>'cod_publicacao DESC, titulo', 'condition'=>'pessoal=false', 'limit'=>5))?>
				<?php foreach($pubs as $pub):?>
					<div class="pub-list">
						<?php echo CHtml::link($pub->titulo, array('/publicacao/view', 'id'=>$pub->cod_publicacao));?>
					</div>
				<?php endforeach;?> -->
		    </div>
	  	</li>
	</ul>
</div> <!-- /thumbnail -->




<div class="row-fluid vagas">
	<div class="span6">
		<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/site/desenvolvedorWeb2.png', 'Vagas de Desenvolvedor'), 'http://www.ufrgs.br/cegov/new/n/261?n=CEGOV_abre_sele%C3%A7%C3%A3o_para_Desenvolvedores_Web') ?>
	</div>
	<div class="span6">
		<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/site/ic.png', 'Resultado do Processo Seletivo de IC'), 'http://www.ufrgs.br/cegov/new/n/280?n=Divulgado_resultado_da_sele%C3%A7%C3%A3o_para_bolsista_de_Inicia%C3%A7%C3%A3o_Cient%C3%ADfica') ?>
	</div>
</div>




<!--
<div id="semi-carousel" class="carousel slide">


  <div class="carousel-inner">
  
   
  	<div class="item active">
		<a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">
			<img src="<?php echo Yii::app()->baseUrl?>/img/sem1.JPG" alt="" width="1024">
		</a>
		<div class="carousel-caption">
		<h4><?php echo CHtml::link(CHtml::encode('titulo'), array('data'=>$noticias[0])); ?></h4>
		<p><a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">Assista ao vivo</a></p>
		</div>
    </div>
    
    <div class="item">
		<a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">
			<img src="<?php echo Yii::app()->baseUrl?>/img/sem2.JPG" alt="" width="1024">
		</a>
		<div class="carousel-caption">
		<h4>IV Seminário do CEGOV - Estado e Democracia no Brasil</h4>
		<p><a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">Assista ao vivo</a></p>
		</div>
    </div>
    
    <div class="item">
		<a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">
			<img src="<?php echo Yii::app()->baseUrl?>/img/sem3.JPG" alt="" width="1024">
		</a>
		<div class="carousel-caption">
		<h4>IV Seminário do CEGOV - Estado e Democracia no Brasil</h4>
		<p><a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">Assista ao vivo</a></p>
		</div>
    </div>
    
    <div class="item">
		<a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">
			<img src="<?php echo Yii::app()->baseUrl?>/img/sem4.JPG" alt="" width="1024">
		</a>
		<div class="carousel-caption">
		<h4>IV Seminário do CEGOV - Estado e Democracia no Brasil</h4>
		<p><a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov">Assista ao vivo</a></p>
		</div>
    </div>
   
    
  </div>

  
</div>
-->


