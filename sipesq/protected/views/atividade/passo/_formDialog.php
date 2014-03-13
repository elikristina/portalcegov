<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'passoDialog',
                'options'=>array(
                    'title'=>"Adicionar Passo",
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('/atividade/passo/_form', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>