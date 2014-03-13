<?php
 $this->breadcrumbs=array(
	'Projetos'=>array('index'),
 	$projeto->nome=>array('view', 'id'=>$projeto->cod_projeto),	
 	'Gerencial'=>array('gerencial', 'id'=>$projeto->cod_projeto),	
	$model->isNewRecord ? 'Adicionar Permissão' : 'Editar Permissão'
);

$this->menu=array(
	array('label'=>'Ver Projeto', 'url'=>array('view', 'id'=>$projeto->cod_projeto)),
);

?>
<h3><?php echo $model->isNewRecord ? 'Adicionar' : 'Editar' ?> Permissão</h3>


	<div class="form">
	<?php
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'permissao-projeto-form',
			'enableAjaxValidation'=>false,
		)); 		
			
			 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
			 $footer = "</div>";
			 
		 echo $form->errorSummary($model, $header, $footer);
		 //if($model->isNewRecord) 
		 	echo $form->dropDownList($model, 'cod_pessoa', CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome', 'equipe'), array('prompt'=>"Selecione uma Pessoa", 'class'=>"input-block-level"));
		 //else
		 	//echo $form->dropDownList($model, 'cod_pessoa', CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome', 'equipe'), array('prompt'=>"Selecione uma Pessoa", 'class'=>"input-block-level", 'disabled'=>'disabled'));
		 
		 //echo $form->dropDownList($model, 'nivel_permissao', PermissaoProjeto::listPermitionData(), array('prompt'=>"Selecione uma Permissão"));
		 
		 
	?>
	
	
	<table class="table table-condensed table-bordered table-hover table-striped" >
	 <tr>
	<th>Local</th><th>Nível de Informação</th>		
	 </tr>
	  <tr>
	  <td>Acesso a Informações</td>
	  <td><?php echo $form->dropDownList($model->permissao, 'informacoes', Grupo::defaultPermitions());?></td>
	  </tr>
	  
	  <tr>
	  <td>Acesso ao Financeiro</td>
	  <td><?php echo $form->dropDownList($model->permissao, 'financeiro', Grupo::defaultPermitions());?></td>
	  </tr>
	  
	  <tr>
	  <td>Acesso aos Documentos</td>
	  <td><?php echo $form->dropDownList($model->permissao, 'documentos', Grupo::defaultPermitions());?></td>
	  </tr>
	  
	  <tr>
	  <td>Acesso as Atividades</td>
	  <td><?php echo $form->dropDownList($model->permissao, 'atividades', Grupo::defaultPermitions());?></td>
	  </tr>
	  
	  <tr>
	  <td>Acesso ao Gerencial</td>
	  <td><?php echo $form->dropDownList($model->permissao, 'gerencial', Grupo::binaryPermitions());?></td>
	  </tr>

	  <tr>
	  <td>Deleção</td>
	  <td><?php echo $form->dropDownList($model->permissao, 'deletar', Grupo::binaryPermitions());?></td>
	  </tr>
	  
	  <?php /* 
	  <?php foreach($model->getRubricas() as $key=>$rubrica):?>
	  <tr>
	  	<td><?php echo $rubrica['nome']?></td>
	  	<td>
	  		<?php echo CHtml::dropDownList('PermissaoProjeto[rubricas][]', $rubrica['cod_rubrica'], PermissaoProjeto::listPermitionData())?>
	  	</td>
	  </tr>
	  <?php endforeach;?>
	  */ ?>
	</table>
	<?php echo CHtml::submitButton( $model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-info'));
		  
		 $this->endWidget(); 
	?>
	</div>