<?php Yii::app()->clientScript->registerScript("scroll", "
	$(function()
	{
		$('.icon').tooltip();
	});
");
?>
<h2 align="center">Pesquisa SIPESQ</h2>

<h3>Pessoas</h3>
<div class="search-results view">
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProviderPessoas,
		'itemView'=>'/pessoa/_sresult',
	)); ?>
</div>
<br>

<h3>Projetos</h3>
<div class="search-results view">
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProviderProjetos,
		'itemView'=>'/projeto/_sresult',
	)); ?>
</div>
<br>

<h3>Contatos</h3>
<div class="search-results view">
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProviderContatos,
		'itemView'=>'/contato/_sresult',
	)); ?>
</div>

<h3>Atividades</h3>
<div class="search-results view">
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProviderAtividades,
		'itemView'=>'/atividade/_sresult',
	)); ?>
</div>
<br>