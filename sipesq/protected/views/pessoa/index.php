<?php
$this->breadcrumbs=array(
        'Pessoas',
);

$this->menu=array(
        array('label'=>'Adicionar', 'url'=>array('create')),
        array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Pessoas</h1>

<?php
         $form=$this->beginWidget('CActiveForm', array(
                'id'=>'pessoa-form',
                'enableAjaxValidation'=>false,
                'action'=>array('/pessoa/search/'),
                'method'=>'GET',
                'htmlOptions'=>array('class'=>'form-search')
)); ?>

        <?php echo $form->errorSummary($model); ?>

                <?php //echo $form->textField($model,'nome'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 'name'=>'Pessoa[nome]',
         'source'=>Pessoa::toArray(),

         //'sourceUrl'=>'/index.php/pessoa/json',
                 'htmlOptions'=>array('class'=>'input-medium search-query', 'submit' => '',),
                ));
                ?>
                <?php echo $form->error($model,'nome'); ?>
                <?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-info btn-medium')); ?>

<?php $this->endWidget(); ?>

<?php  /*
                        Yii::app()->clientScript->registerScript('financeiro', "

                        $('.financeiro-show-button').toggle(

                function(){
                        $(this).text('Ocultar Informações Financeiras');
                                a = $(this).parent();
                                pessid = $(a).attr('id');
                                container = a.children('div');
                                $(container).show('fast');

                        $.get('/sipesq/index.php/pessoa/ajaxpessoa'     ,

                                {id: pessid},function (data){
                                                $(container).html(data);
                                                $(container).focus();
                                        },
                                        \"html\");

                },

                function(){
                                a = $(this).parent();
                                $(this).text('Mostrar Informações Financeiras');
                                b = a.children('div');
                                b.hide('fast');
                                return false;
                        }
                );



                $('#all-financeiro-button').toggle(
                        function(){
                                $(this).text('Ocultar Informações Financeiras');
                                containers = $('.financeiro-div');
                                $.each(containers,
                                        function(key,value)
                                        {
                                                $.get('/sipesq/index.php/pessoa/ajaxpessoa'     ,

                                                {id:  $(value).parent().attr('id')},function (data){
                                                                $(value).html(data);
                                                                $(value).focus();
                                                        },
                                                        \"html\");
                                        }
                                );

                                $('.financeiro-div').show();
                                return false;
                        },
                        function(){
                                $(this).text('Mostrar Informações Financeiras');
                                $('.financeiro-div').hide('fast');
                                return false;
                        }

                );
                ");
?>
        <?php if(!Yii::app()->user->isGuest):?>
                <br><?php echo CHtml::link('Mostrar Informações Financeiras','#',array('id'=>'all-financeiro-button')); ?>
        <?php endif;?>

        */
?>

<div class="view">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_view',
        )); ?>
</div>
