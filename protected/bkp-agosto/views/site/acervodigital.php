<?php $this->pageTitle=Yii::app()->name; ?>

<?php 
			Yii::app()->clientScript->registerScript('download', "
		$('.detalhe_link').toggle(
			function(){
				a = $(this).parent();
				b = a.children('div');
				b.show('fast');
				return false;
			},
			function(){
				a = $(this).parent();
				b = a.children('div');
				b.hide('fast');
				return false;
			}
			
		);	
		
");
?>		

<h4>Acervo Digital da Equipe Cepik</h4>
<a href="ftp://143.54.64.51/ACERVO%20DIGITAL/" target="_blank">Servidor FTP</a>
<?php $files = $ftp->listFiles($ftp->currentDir());?>
<p><?php echo CHtml::encode($ftp->currentDir())?>
<?php if($ftp->currentDir() != '/ACERVO DIGITAL'):?>
<br><br><b><?php echo CHtml::link(CHtml::encode('Voltar'), array('/site/acervodigital', 'f'=>$lastDir)); ?><br><br></b>
<?php endif;?>
</p>

<ul style="list-style-type: none;">
<?php foreach($files as $f):?>
	<?php $f = utf8_encode($f);?>
	<?php if(!$ftp->size($f) && ($ftp->directory_exists($f))):?>
		<li><?php echo CHtml::link(CHtml::encode($f), array('/site/acervodigital', 'f'=>$ftp->currentDir().'/'.$f)); ?><br></li>
	<?php else:?>
		<li>
			<?php echo CHtml::link(CHtml::encode($f),'#',array('class'=>'detalhe_link')); ?><br>
			<div class="detalhe_acervo view">
				<h4><u>Atenção</u></h4>
				<p>Para baixar este arquivo você deve usar as seguintes informações de usuário:</p>
				<p>Login: <b>E_CEPIK</b><br>
				Senha: <b>Equipe#2010</b></p>
				<p>Tamanho do Arquivo: <?php echo CHtml::encode(number_format(($ftp->size($f)/(1024*1024)),2,',','.'));?> MB</p>
			<b><?php echo CHtml::link(CHtml::encode('Baixar Arquivo'), array('/site/acervodigital', 'download'=>$ftp->currentDir().'/'.$f)); ?><br></b>
			</div>
		</li>
	<?php endif;?>
<?php endforeach;?>
</ul>

