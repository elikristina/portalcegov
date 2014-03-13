<?php
$this->breadcrumbs=array(
	Yii::t('default', 'publicacoes')=>array('index'),
	Yii::t('Publicacao', 'add'),
);

$this->menu=array(
	array('label'=>Yii::t('Publicacao', 'admin'), 'url'=>array('admin')),
	array('label'=>Yii::t('Publicacao', 'types'), 'url'=>array('/publicacaoTipo/index')),
);
?>


<?php
	
	Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({
								mode : 'textareas',
								theme : 'simple',
								width: '500',
        						height: '150'
							});
		$('#detalhamento').hide();
	");
	
	$loadDetailUri = $this->createUrl('/publicacao/loadDetail');
	Yii::app()->clientScript->registerScript('load-form',"
	$('#Publicacao_cod_tipo').change(
		function(){
			$('#detalhamento').hide('fast');
			if($(this).val() != ''){
				$.get('{$loadDetailUri}' + '/' + $(this).val(),
							function(response){
								tinyMCE.getInstanceById('Publicacao_detalhamento').setContent(response);
								$('#detalhamento').show('slow');
							}
					);
			}
			
			
		}
		
	);
");
?>

<h2><?php echo Yii::t('Publicacao', 'add')?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
