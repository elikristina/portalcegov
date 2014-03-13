<?php $url = $this->createUrl('/atividade/update', array('id'=>$model->cod_atividade));?>

<?php
Yii::app()->clientScript->registerScript('form_modal_atividade', "


 
");

?>

<?php /*
<button href="#atv-edit-modal" role="button" class="btn btn-primary btn-small" data-toggle="modal">Editar</button>

<div id="atv-edit-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="modalLabel">Editar</h3>
  </div>
  <div class="modal-body">    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-primary">Salvar</button>
  </div>
</div>
*/?>



<!-- Bootstrap trigger to open modal -->
<a data-toggle="modal" href="#rating-modal">Write a Review</a>
 
<div class="hide fade modal" id="rating-modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h2>Your Review</h2>
  </div>
 
  <div class="modal-body">
    <!-- The async form to send and replace the modals content with its response -->
  <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'atividade-form',
  'enableAjaxValidation'=>true,
  'errorMessageCssClass'=>'alert',
  'htmlOptions'=>array('data-async'=>'data-async','data-target'=>'#page-main-content')
)); ?>

  <?php CHtml::$errorCss = 'control-group warning';?>

  <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Campos com <strong>*</strong> são obrigatórios.
  </div>
  
  <?php
     $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
     $footer = "</div>";
    echo $form->errorSummary($model, $header, $footer); 
  ?>
  
    <div class="input">
    <?php echo $form->labelEx($model,'nome_atividade'); ?>
    <?php echo $form->textField($model, 'nome_atividade', array('class'=>'input-xxlarge'))?>
    <?php echo $form->error($model,'nome_atividade'); ?>
  </div>
  <div class="input">
  <label><b>Categoria Primária</b></label>
  <?php $cPai = ''?>
  <?php if(is_object($model->categoria) && is_object($model->categoria->categoriaPai)) $cPai = $model->categoria->categoriaPai->cod_categoria?>
  <?php  echo CHtml::dropDownList('drop_categoria_pai',$cPai, CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai = cod_categoria')), 'cod_categoria', 'nome'), array('class'=>'input-xxlarge')); ?><br>
  <label><b>Categoria Secundária</b></label>
  <?php  echo $form->dropDownList($model,'cod_categoria', CHtml::listData(AtividadeCategoria::model()->findAll(array('condition'=>'cod_categoria = ' .$model->cod_categoria)),'cod_categoria','nome'), array('class'=>'input-xxlarge')); ?>
  </div>

  <div class="input">
    <?php echo $form->labelEx($model,'estagio');?>
    <?php  //echo $form->dropDownList($model,'estagio', array('0'=>'A Fazer', '1'=>'Finalizada')); ?>
    <?php  echo $form->checkBox($model,'estagio');?>
    <?php echo $form->error($model,'estagio'); ?>
  </div>

  <div class="input">
    <?php echo $form->labelEx($model,'cod_pessoa');?>   
    <?php  echo $form->dropDownList($model,'cod_pessoa', CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'), array('class'=>'input-xxlarge')); ?>
    <?php echo $form->error($model,'cod_pessoa'); ?>
  </div>
  

  <div class="input">
    <?php echo $form->labelEx($model,'descricao'); ?>
    <?php echo $form->textArea($model, 'descricao', array('rows'=>15))?>
    <br><?php echo $form->error($model,'descricao'); ?>
  </div>


  
  <div class="input ">
    <?php echo $form->labelEx($model,'data_inicio'); ?>
    <?php echo CHtml::tag('input', array('name'=>'Atividade[data_inicio]', 'type'=>'date', 'value'=> $model->isNewRecord ? date('Y-m-d') : $model->data_inicio))?>
    <?php echo $form->error($model,'data_inicio'); ?>
  </div>
  
  <div class="input ">
    <?php echo $form->labelEx($model,'data_fim'); ?>
    <?php echo CHtml::tag('input', array('name'=>'Atividade[data_fim]', 'type'=>'date', 'value'=> $model->isNewRecord ? date('Y-m-d') : $model->data_fim))?>
    <?php echo $form->error($model,'data_fim'); ?>
  </div>

  <div class="input buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')) ?>           
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


  </div>
 
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
  </div>
</div>