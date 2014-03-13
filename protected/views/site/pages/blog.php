<?php $this->pageTitle="Instituto Sul-Americano de Política e Estratégia"; ?>
<h1><a href="http://isape.wordpress.com/" target="_blank">isape.wordpress.com</a></h1>
<h3>Tópicos Recentes</h3>
<?php 

	$content = file_get_contents("http://isape.wordpress.com/feed/");
	
	$x = new SimpleXmlElement($content);
	
	echo "<ul>";
	
	foreach($x->channel->item as $entry) {
		echo "
		<li>
		  <a href='$entry->link' title='$entry->title'>" . $entry->title . "</a>
		  <br> $entry->pubDate;
		</li>";
		}
	echo "</ul>"; ?>
	<h3>Artigos Recentes</h3>
	<?php 
	echo "<ul>";
	foreach($x->channel->item as $entry) {
		echo "
		<li>
		  <a href='$entry->link' title='$entry->title'>" . $entry->title . "</a>
		</li>";
		}
	echo "</ul>"; 
	
?>




