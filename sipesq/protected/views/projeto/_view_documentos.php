<?php $permition = $model->getPermition('documentos'); ?>
<a id="documentos"></a>
<div id="tabDocumentos">
<h2>Documentos</h2>
<table id="tbl-documentos" class="table table-hover table-striped">
	<tr>
		<th>Nome</th>
		<th>Data</th>
		<th>Link</th>
		<?php if($permition > 1):?> <th>Ações</th> <?php endif;?>
	</tr>
		
<?php foreach($model->documentos as $doc):?>
	<tr class="tbl-line-documento" id="doc<?php echo $doc->cod_arquivo?>" data-descricao="<?php echo $doc->descricao; ?>">
		<td><?php echo CHtml::encode($doc->nome); ?></td>
		<td><?php echo CHtml::encode(date("d/m/Y", strtotime($doc->data_inclusao))); ?></td>
		<td>
			<?php echo CHtml::link("<i title='Baixar Arquivo' class='icon icon-cloud-download tip'></i>"
				, array('/projeto/downloadFile', 'id'=>$doc->cod_projeto ,'doc'=>$doc->cod_arquivo)//array('/projeto/downloadFile', 'file'=>$doc->filename)
				, array('target'=>'_blank'))
			?>					
		</td>
		<td>
			<?php if($permition >= 2) echo CHtml::link("<i title='Editar' class='icon icon-edit tip'></i>", array('/projeto/updateFile', 'id'=>$doc->cod_arquivo))?>
			<?php if($permition >= 100) echo CHtml::link("<i title='Excluir' class='icon icon-trash tip'></i>",'',array('submit'=>array('deleteFile','id'=>$doc->cod_arquivo),'confirm'=>'Tem certeza que deseja excluir este arquivo?'))?>
		</td>
	</tr>

<?php endforeach;?>
</table>

<?php 
if($permition >= 2)
	echo CHtml::link('<i class="icon icon-cloud-upload icon-white"></i> Incluir Documento' , array('/projeto/createFile', 'id'=>$model->cod_projeto), array('class'=>'btn btn-small btn-primary', 'style'=>'text-decoration: none'))
?>

<?php Yii::app()->clientScript->registerScript('documentos', "
(function(){
	$('.tip').tooltip();
		
	var docs = $('.tbl-line-documento');
	for(i=0; i<docs.length; i++){
			$(docs[i]).popover({
		
                content: $(docs[i]).attr('data-descricao'),
                trigger: 'hover',
                placement: 'bottom',
                html: true
			})
	}
 })();		
		
");?>
</div>