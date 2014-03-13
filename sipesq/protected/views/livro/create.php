<?php
$this->breadcrumbs=array(
	'Livros'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Listar Livros', 'url'=>array('index')),
	array('label'=>'Gerenciar Livro', 'url'=>array('admin')),
);
?>
<script type="text/javascript">
function beginSearch(query) {
    // Dynamically load the search results in JavaScript,
    // using the Books API
    // Once loaded, handleResults is automatically called with
    // the result set
    var script = document.createElement('script');
    // We might need to supply a key for this or else we might run into
    // quota limits.
    script.src = 'https://www.googleapis.com/books/v1/volumes?q='
      + encodeURIComponent(query) // + '&filter=partial'
      + '&callback=handleResults';
    script.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(script);
  }

  function handleResults(root) {
    // Find the identifier of the first embeddable match
    // If none found, report an error
    var entries = root.items || [];

      
		var entry = entries[0];
	if(entries.length > 0){
		$('#erro').html('<b>Resultados encontrados pelo Google: ' + entries.length);
		 volumeInfo = entry.volumeInfo;
	     var identifier = entry.id;
		
      $('#Livro_titulo').val(volumeInfo.title);
      $('#Livro_autor').val(volumeInfo.authors);
      $('#Livro_subtitulo').val(volumeInfo.subtitle);
      $('#Livro_editora').val(volumeInfo.publisher);
      $('#Livro_ano').val(volumeInfo.publishedDate);
      $('#Livro_nro_paginas').val(volumeInfo.pageCount);
      $('#Livro_edicao').val(volumeInfo.contentVersion);
	}else{
		$('#erro').html('<b>Resultados encontrados pelo Google: ' + entries.length);
	}
  }

  
</script>

<h1>Adicionar Livro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>