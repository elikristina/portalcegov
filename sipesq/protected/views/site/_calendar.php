<?php
$baseUrl = Yii::app()->baseUrl;
$url = $this->createUrl('/atividade/calendar');
$url_tmpl = Yii::app()->baseUrl .'/js/calendar/tmpls/';
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/underscore-min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/calendar/language/pt-BR.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/calendar/calendar.js');
Yii::app()->clientScript->registerCssFile($baseUrl ."/css/calendar/calendar.css");
Yii::app()->clientScript->registerScript("calendar", "
		(function() {
			var calendar = $('#calendar').calendar(
			{
					events_url:'{$url}'
				,	tmpl_path: '{$url_tmpl}'
				,	onAfterViewLoad: function(view) {
						$('#curr-date').text(this.title());
						$('.view-chooser button').removeClass('active');
						$('button[data-calendar-view=\"' + view + '\"]').addClass('active');
						$('#eventlist').css('max-height', $('#calendar').height());
					}
				,	onAfterEventsLoad: function(events) {
						if(!events) {
							return;
						}
						var list = $('#eventlist');
						list.html('');
						
						events.sort(function(a,b){
						 return a.end - b.end;
						});
			
						$.each(events, function(key, val) {
						var d = new Date(val.end);
						val.date = [d.getDate(), d.getUTCMonth()+1,  d.getFullYear()].join('/');
						//
						$(document.createElement('div'))
						.html([
									'<a href=\"' + val.url + '\">'
								,	'<b>' + val.title + '</b>'
								,	'</a>'
								, 	' <i>' + val.date + '</i>'
								].join(''))
								.addClass('view ' + ' day-highlight dh-' + val.class)
								.appendTo(list);
						});
					}
			});
			
			$('.btn-group button[data-calendar-nav]').each(function() {
				$(this).click(function() {
					calendar.navigate($(this).data('calendar-nav'));
				});
			});

			$('.btn-group button[data-calendar-view]').each(function() {
				$(this).click(function() {
					calendar.view($(this).data('calendar-view'));
				});
			});
			
			$('.people-chooser').click(function(){
					var options = {};
        		options.pessoa = parseInt($(this).attr('data-cod-pessoa'));
        		fillPage(options);
			});
			
		})();
");
?>
<div class="row-fluid">
	<div class="span8">
		<div class="pull-left">
		<h3 id="curr-date"></h3>
		<ul class="unstyled inline">
			<li><span class="pull-left event event-info"></span>&nbsp;Projeto</li>
			<li><span class="pull-left event event-important"></span>&nbsp;Atividade</li>
			<li><span class="pull-left event event-special"></span>&nbsp;Passo</li>
		</ul>
		</div>
		
		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
				<button class="btn" data-calendar-nav="today">Hoje</button>
				<button class="btn btn-primary" data-calendar-nav="next">Próximo >></button>
			</div>
			<div class="btn-group view-chooser">
				<button class="btn btn-warning" data-calendar-view="year">Ano</button>
				<button class="btn btn-warning" data-calendar-view="month">Mês</button>
				<button class="btn btn-warning" data-calendar-view="week">Semana</button>
			</div>
			<br><br>
			<?php if(Sipesq::isSupport() && false):?>
				<div class="btn-group">
				  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				    Pessoa
				    <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu">
				  <?php   
				  		$pessoas = Pessoa::model()
				  		->findAll(array('order'=>'nome','select'=>'nome, cod_pessoa'));
					?>
				  		
				    <?php foreach ($pessoas as $pessoa):?>
				    	<li><a class="people-chooser" data-cod-pessoa="<?php echo $pessoa->cod_pessoa?>"><?php echo $pessoa['nome']?></a></li>
				    <?php endforeach; ?>
				  </ul>
				</div>
			<?php endif;?>
			
	</div>
</div> 
</div> <!-- /row -->
<div class="row-fluid" style="margin-top: 5px; margin-bottom: 10px;">
	<div class="span8">
		<div id="calendar"></div>
	</div>
	<div class="span4">
		<h4>Lista de Atividades</h4>
		<div id="eventlist" style="overflow: auto; min-height: 300px"></div>
	</div>
</div>

