<?php 
$id = $_GET['id'];
$permissao = new PermissaoProjeto();
$permissao->cod_projeto = $id;
$permissoes = PermissaoProjeto::model()->findAll(array('condition'=>"cod_projeto = " .$id));

if(isset($_POST['PermissaoProjeto']))
{
	$permissao->attributes=$_POST['PermissaoProjeto'];
	if($permissao->save())
		$this->redirect(array('/projeto/gerencial', 'id'=>$id));
}

$t = json_encode(array(
		'financeiro'=>true
	,	'info'=>false
	,	'rubricas'=>$model->getRubricas()
	,	'docs'=>true
	,	'atividades'=>true			
));

?>

<a id="gerencial"></a>
<div id="tabGerencial">
	<h2>Gerencial</h2>
	<h4>Permissões do projeto </h4>
	<table class="table table-hover table-striped">
		<tr><th>Nome</th><th>Nível de Acesso</th><th>Detalhe</th></tr>
		<tr>
			<td><?php echo $model->coordenador->nome?></td>
			<td>Admin</td>
			<td><?php echo $model->getAttributeLabel('cod_professor') ?></td>
		</tr>
		<tr>
			<td><?php echo $model->vice_coordenador->nome?></td>
			<td>Admin</td>
			<td><?php echo $model->getAttributeLabel('cod_pos_grad') ?></td>
		</tr>
		<tr>
			<td><?php echo $model->fiscal->nome?></td>
			<td>Admin</td>
			<td><?php echo $model->getAttributeLabel('cod_grad') ?></td>
		</tr>
		<tr>
			<td><?php echo $model->bolsista_responsavel->nome?></td>
			<td>Admin</td>
			<td><?php echo $model->getAttributeLabel('cod_bolsista_responsavel') ?></td>
		</tr>
		<tr><td colspan="3"><?php echo CHtml::link("Editar Projeto", array('/projeto/update','id'=>$model->cod_projeto), array('class'=>'btn btn-primary btn-small'))?> </td></tr>

	</table>
	
	<h4>Permissões Individuais</h4>
	<div class="well">
	<?php echo CHtml::link("Adicionar Permissão", array('projeto/permissoes', 'id'=>$model->cod_projeto), array('class'=>'btn btn-primary btn-small')); ?>

	<dl class="dl-horizontal">
		<?php $defaultPermitions = Grupo::defaultPermitions();
				$binaryPermitions = Grupo::binaryPermitions(); 
		?>
		<?php foreach ($permissoes as $p):?>

		<dt><b><?php echo $p->pessoa->nome?></b></dt>
			<?php $perm = json_decode($p->permissao)?>			
			<dd> <b>Informações:</b> <?php echo $defaultPermitions[$perm->informacoes]; ?> </dd>
			<dd> <b>Atividades:</b> <?php echo $defaultPermitions[$perm->atividades]; ?> </dd>
			<dd> <b>Financeiro:</b> <?php echo $defaultPermitions[$perm->financeiro]; ?> </dd>
			<dd> <b>Documentos:</b> <?php echo $defaultPermitions[$perm->documentos]; ?> </dd>
			<dd> <b>Gerencial:</b> <?php echo $binaryPermitions[$perm->gerencial]; ?> </dd>
			<dd> <b>Deleção:</b> <?php echo $binaryPermitions[$perm->deletar]; ?> </dd>
			<dd> 
				<?php echo CHtml::link("Editar", array('projeto/updatepermissao', 'pessoa'=>$p->cod_pessoa, 'id'=>$p->cod_projeto), array('class'=>'btn btn-primary btn-small')); ?>
				<?php echo CHtml::submitButton("Remover", array('submit'=>array('deletePermissao','id'=>$p->cod_projeto, 'cod_pessoa'=>$p->cod_pessoa,'returnUrl'=>array($this->route, 'id'=>$p->cod_projeto)) ,'confirm'=>'Deseja remover esta permissão?', 'class'=>'btn btn-small btn-danger')); ?>
			</dd>
			<hr>

		<?php endforeach;?>
	</dl>
</div>
</div><!-- /tab -->