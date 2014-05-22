<?php 
/**
 * Layout da pÃ¡gina de publicaÃ§Ãµes.
 */

//Registra os scripts para o scroll
$baseUrl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/jquery.jscrollpane.min.js");
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/jquery.mousewheel.js");
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/mwheelIntent.js");
Yii::app()->clientScript->registerCssFile($baseUrl ."/jScrollPane/jquery.jscrollpane.css");

Yii::app()->clientScript->registerScript("scroll", "
	$(function()
	{
		$('.scroll').jScrollPane();
	});
");


?> 


<?php $this->beginContent('//layouts/main'); ?>
	
<div class="container-fluid">

	<div class="row-fluid">
        <div class="span12 default-container">
        	<?php echo $content?>
		</div>
	</div><!--carousel-->

	<!--
	<div id="banner" class="row-fluid">
		<a href="http://www.ufrgs.br/cegov/index.php/curso">
			<?php echo CHtml::image(Yii::app()->baseUrl . '/images/site/banner_ppa.jpg', 'Thumbnail', array('id'=>'event'))?>
		</a>
	</div>
	-->

	
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

</div> <!-- /container -->
<?php $this->endContent(); ?>
