
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


