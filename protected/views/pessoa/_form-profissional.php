<div class="form well well-large">

<div class="row-fluid">
	<div class="span2">
		<h4>Dados Profissionais</h4>
	</div>
	<div class="span10">
		<div class="row-fluid">
			<div class="span4">
				<?php echo $form->labelEx($model,'instituicao'); ?>
				<?php echo $form->textField($model,'instituicao', array('size'=>65, 'class'=>'span12')); ?>
				<?php echo $form->error($model,'instituicao'); ?>
			</div>
			<div class="span4">
				<?php echo $form->labelEx($model,'orgao_departamento'); ?>
				<?php echo $form->textField($model,'orgao_departamento', array('size'=>65, 'class'=>'span12')); ?>
				<?php echo $form->error($model,'orgao_departamento'); ?>
			</div>
			<div class="span4">
				<?php echo $form->labelEx($model,'curso'); ?>
				<?php echo $form->textField($model,'curso', array('size'=>65, 'class'=>'span12')); ?>
				<?php echo $form->error($model,'curso'); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3">
				<?php echo $form->labelEx($model,'siape'); ?>
				<?php echo $form->textField($model,'siape', array('pattern'=>"\d+", 'class'=>'span12')); ?>
				<?php echo $form->error($model,'siape'); ?>
			</div>	
			<div class="span3">
				<?php echo $form->labelEx($model,'cartao_ufrgs'); ?>
				<?php echo $form->textField($model,'cartao_ufrgs', array('pattern'=>"\d+", 'class'=>'span12')); ?>
				<?php echo $form->error($model,'cartao_ufrgs'); ?>
			</div>	
			<div class="span6">
				<?php echo $form->labelEx($model,'lattes'); ?>
				<?php echo $form->textField($model,'lattes', array('size'=>65, 'type'=>'url', 'class'=>'span12')); ?>
				<?php echo $form->error($model,'lattes'); ?>
			</div>
					
		</div>
	</div>
</div>

<hr>


<div class="row-fluid" >
	<div class="span2">
		<h4>Função CEGOV</h4>
	</div>
	<div class="span10">
			<?php 
			$categoriasComFilhos = CHtml::listData(Categoria::model()->findAll(array('with'=>'categoriaPai', 'order'=>'t.ordem', 'condition'=>'t.cod_categoria_pai is not null')), 'cod_categoria', 'nome', 'categoriaPai.nome');
			$categoriasSemFilhos = CHtml::listData(Categoria::model()->findAll(array('with'=>'secundarias',  'condition'=>'secundarias is null AND t.cod_categoria_pai is null')), 'cod_categoria', 'nome', 'secundarias.nome');
			?>
			<?php if (Yii::app()->user->name == 'admin'):?>
				<?php  echo $form->listBox($model,'categorias', array_merge($categoriasComFilhos, $categoriasSemFilhos), array("multiple"=>"multiple", "size"=>Categoria::model()->count(), 'class'=>'span12')); ?>
				<?php echo $form->error($model,'categorias'); ?>
			<?php else:?>
				<?php echo $form->checkBoxList($model,'categorias', CHtml::listData(Categoria::model()->findAll(array('with'=>'secundarias', 'order'=>'t.ordem', 'condition'=>'secundarias is null AND t.cod_categoria_pai is null')), 'cod_categoria', 'nome'), array('separator'=>'', 'template'=>'<div class="checkBoxList">{input}{label}</div>'));?>
				<?php echo $form->error($model,'categorias'); ?>
			<?php endif; ?>
	</div>
</div>

<hr>

<div class="row-fluid">
	<div class="span2">
		<h4>Grupos de Trabalho</h4>
	</div>
	<div class="span10">
		<?php if (Yii::app()->user->name == 'admin'):?>
			<?php  echo $form->listBox($model,'grupos', CHtml::listData(GrupoTrabalho::model()->findAll(array('order'=>'nome')), 'cod_gt', 'nome'), array("multiple"=>"multiple", "size"=>GrupoTrabalho::model()->count(), 'class'=>'span12')); ?>
			<?php echo $form->error($model,'grupos'); ?>
		<?php else:?>
			<?php echo $form->checkBoxList($model,'grupos', CHtml::listData(GrupoTrabalho::model()->findAll(array('order'=>'nome', 'condition'=>'cod_gt <> 12')), 'cod_gt', 'nome'), array('separator'=>'', 'template'=>'<div class="checkBoxList">{input}{label}</div>'));?>
			<?php echo $form->error($model,'grupos'); ?>
		<?php endif; ?>
	</div>
</div>
	

</div>

