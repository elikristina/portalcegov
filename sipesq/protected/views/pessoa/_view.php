<div class="view-pessoa" id="<?php echo $data->cod_pessoa ?>">

        <b><u><?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_pessoa)); ?></u></b>
        <br />

        <b>Código SIPESQ:</b>
        <?php echo CHtml::encode($data->cod_pessoa); ?>
        <br />

        <b>Código CEGOV:</b>
        <?php echo CHtml::encode($data->old_cod_pessoa); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
        <?php echo CHtml::encode($data->email); ?>
        <br />

        <b><?php echo CHtml::encode('Telefone'); ?>:</b>
        <?php echo CHtml::encode($data->telefone); ?>
        <br />

        <?php /*

        <b><?php echo CHtml::encode("Projetos em que atua"); ?>:</b>
        <?php foreach($data->projetos_atuante as $projeto ):?>
                <?php echo $projeto->nome;?>,
        <?php endforeach;?>
        <br />


        <?php if(isset($data->categoria)):?>
                <b><?php echo CHtml::encode($data->getAttributeLabel('categoria')); ?>:</b>
                <?php echo CHtml::encode($data->categoria->nome); ?>
                <br />
        <?php endif;?>


        <?php if(isset($data->cod_vinculo_institucional)):?>
                <b><?php echo CHtml::encode($data->getAttributeLabel('cod_vinculo_institucional')); ?>:</b>
                <?php echo CHtml::encode(VinculoInstitucional::model()->findByPk($data->cod_vinculo_institucional)->nome); ?>
        <?php endif;?>


        <div class="financeiro-div" style="display:none">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/ajax-loader.gif" alt="Carregando...">
        </div>

        <?php if(count($data->pessoa_financeiro) > 0 && !Yii::app()->user->isGuest):?>
                <br><?php echo CHtml::link('Mostrar Informações Financeiras','',array('class'=>'financeiro-show-button')); ?>
        <?php endif;?>

*/      ?>
</div>