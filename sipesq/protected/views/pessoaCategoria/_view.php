	<b><?php echo CHtml::encode($data->nome); ?></b>
	<?php echo CHtml::imageButton(Yii::app()->request->baseUrl ."/images/update.png",array('submit'=>array('update','id'=>$data->cod_categoria,)) );?>
	<?php echo CHtml::imageButton(Yii::app()->request->baseUrl ."/images/delete.png",array('submit'=>array('delete','id'=>$data->cod_categoria,'returnUrl'=>array($this->route)) ,'confirm'=>'Deseja remover a categoria ' .$data->nome .'?') );?>
	<br /> <br />

