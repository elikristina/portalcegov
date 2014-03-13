<?php $this->pageTitle=Yii::app()->name; ?>
<h4>Acervo Digital da Equipe Cepik</h4>
<p>
<b>Usuário: </b>E_CEPIK<br/>
<b>Senha: </b>Equipe#2010<br/>
</p>
<?php $files = $ftp->listFiles($ftp->currentDir());?>
<p><b>Pasta: <?php echo CHtml::encode($ftp->currentDir())?></b>
<?php if($ftp->currentDir() != '/ACERVO DIGITAL'):?>
<br><br><b><?php echo CHtml::link(CHtml::encode('Voltar'), array('/site/acervodigital', 'f'=>$lastDir)); ?><br><br></b>
<?php endif;?>
</p>

<ul style="list-style-type: none;">
<?php foreach($files as $f):?>
	<?php if(($ftp->directory_exists($f))):?>
		<?php $f = utf8_encode($f);?>
		<li><?php echo CHtml::link(CHtml::encode($f), array('/site/acervodigital', 'f'=>$ftp->currentDir().'/'.$f)); ?><br></li>
	<?php else:?>
		<?php $f = utf8_encode($f);?>
		<li>
			<b><?php echo CHtml::link(CHtml::encode($f), array('/site/acervodigital', 'download'=>$ftp->currentDir().'/'.$f)); ?><br></b>
			
		</li>
	<?php endif;?>
<?php endforeach;?>
</ul>

