<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-5 last">
		<div id="sidebar">
		
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operações',
				'htmlOptions'=>array('visible'=>!Yii::app()->user->isGuest),
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		
		<div id="feedBlog"></div>
		
		<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAwtW6REnoXPwabzosDJ1ZbxSf6zeDUL0NX_-81yZ_3MTVk-1i4xQ4nST236nGieybG_Uiv9EE12qxDg"></script>
		<script type="text/javascript">google.load("feeds", "1");</script>
		<script type="text/javascript">

			var feedcontainer = document.getElementById("feedBlog");
			var feedlimit=5;
			var rssoutput = '<h4 align="center">Últimas Notícias</h4>';
			var feedurl = "https://news.google.com.br/news/feeds?pz=1&cf=all&ned=pt-BR_br&hl=pt-BR&output=rss";
			
			function rssfeedsetup(){
			var feedpointer=new google.feeds.Feed(feedurl); //Google Feed API method
			//document.write(feed);
			feedpointer.setNumEntries(feedlimit); //Google Feed API method
			
			feedpointer.load(displayfeed); //Google Feed API method
			}
			
			function displayfeed(result){
				if (!result.error){
					var thefeeds=result.feed.entries;
					rssoutput += '<ul class="ul-list-item">';
					for (var i=0; i<thefeeds.length; i++){
							rssoutput+="<li class=\"listItem\"><a href='" + thefeeds[i].link + "' target='_blank'> " + thefeeds[i].title + "</a></li>";	
					}
					
					//	rssoutput+="<p>" + thefeeds[i].author + "</p>";
					feedcontainer.innerHTML=rssoutput + "</ul>";
				}
				else
					feedcontainer.innerHTML="<a href='http://isape.wordpress.com' target='_blank' ><h3>Blog ISAPE</h3></a><p>Veja as notícias do blog</p>";
			}
			
			window.onload=function(){
				rssfeedsetup();
			};
</script>
	  </div>
	</div><!-- Sidebar -->
</div>
<?php $this->endContent(); ?>
