<form class="navbar-form pull-right form-search" action="<?php echo $this->createUrl('/site/search')?>">
<div class="input-append">
<input 
	class="span2 search-query"
	type="text"
	placeholder="Busca"
	name="q"
	value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''?>"
>
<button type="submit" class="btn ">Buscar</button>
</div>
</form>