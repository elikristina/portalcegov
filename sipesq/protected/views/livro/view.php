<?php Yii::app()->clientScript->registerScript('table_livro',"

$('.livro').hover(
 function(){
 	$(this).addClass('table-line-over');
 }, 
 
 function(){
 	$(this).removeClass('table-line-over');
 }
);

")?>

<?php
$this->breadcrumbs=array(
	'Livros'=>array('index'),
	$model->titulo,
);

$this->menu=array(
	array('label'=>'Listar Livros', 'url'=>array('index')),
	array('label'=>'Adicionar Livro', 'url'=>array('create')),
	array('label'=>'Editar Livro', 'url'=>array('update', 'id'=>$model->cod_livro)),
	array('label'=>'Deletar Livro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_livro),'confirm'=>'Tem certeza que deseja deletar este livro?')),
	array('label'=>'Gerenciar Livros', 'url'=>array('admin')),
);
?>

<?php
 	$emprestimo_atual = EmprestimoLivro::model()->findAll('cod_livro = '.$model->cod_livro .'AND data_devolucao is NULL');
 	$historico_emprestimos = EmprestimoLivro::model()->findAll('cod_livro = '.$model->cod_livro .' ORDER BY data_retirada DESC');
 ?>
 	
<h1><?php echo $model->titulo; ?></h1>

<?php if(count($emprestimo_atual) > 0):?>
	<h4><label><b>Emprestado a: </b></label><?php echo CHtml::encode($emprestimo_atual[0]->pessoa->nome);?></h4>
<?php endif;?>
	


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'autor',
		'ano',
		'volume',
		'titulo_abnt',
		'subtitulo',
		'editora',
		'cidade_publicacao',
		'nro_edicao',
		'nro_patrimonio',
		array('label'=>'Projeto','type'=>'raw','value'=>CHtml::link(CHtml::encode($model->projeto->nome),
                                 array('projeto/view','id'=>$model->projeto->cod_projeto))),
		'valor',
		'local_compra',
		'nro_nota_fiscal',
		'isbn',
		'nro_exemplares',
        'nro_paginas',
        'localizacao_sabi',
	),
)); ?>
<?php if($model->estaEmprestado()):?>
	<?php echo CHtml::submitButton('Devolver', array('submit'=>array('devolucao','id'=>$model->cod_livro),'confirm'=>'Deseja devolver este livro?')); ?>
<?php else:?>
	<?php echo CHtml::submitButton('Emprestar', array('submit'=>array('emprestimo','id'=>$model->cod_livro))); ?>
<?php endif;?>
	
	<?php if(count($historico_emprestimos) > 0):?>
		<br><br>
		<h4 align="center"><b>Histórico de Empréstimos</b></h4>
		<table id="tbl_livros">
		<tr><th>Nome</th><th>Retirada</th><th>Devolução</th></tr>
		<?php foreach($historico_emprestimos as $emprestimo):?>
			<tr class="livro <?php if($emprestimo->data_devolucao == null) echo "livro-emprestado";?>">
			<td><?php echo $emprestimo->pessoa->nome?></td>
			<td><?php echo date("d/m/Y \a\s H:m",strtotime($emprestimo->data_retirada) )?></td>
			<?php if($emprestimo->data_devolucao != null):?>
			<td><?php echo date("d/m/Y",strtotime($emprestimo->data_devolucao) )?></td>
			<?php else:?>
			<td>Emprestado</td>
			<?php endif;?>
			
			</tr> 
	 	<?php endforeach;?>
	 	</table>
 	<?php endif;?>
