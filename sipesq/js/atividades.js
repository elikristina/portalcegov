function Atividade(container, opt){
	
	var container = container;
	
	var urlOptions = {
		
			count: 0
		,	responsavel: ''
		,	pessoa: ''
		,	status: ''
		,	projeto: ''
		,	categoria: ''

	};

	
	var url = '/sipesq/index.php/atividade/json';

	for(i in opt) urlOptions[i] = opt[i];

	var load = function(options){
		
			for(i in options){
				urlOptions[i] = options[i];
			}
			
			var formatDate = function(date){
				var d = new Date(date);
				return [d.getDate(), d.getUTCMonth()+1, d.getFullYear()].join("/");
			};

			$.getJSON(url,urlOptions, function(data){

				if(data.length < 1){
					
					$('#atv-load-more').hide('slow').remove();
					var alert = document.createElement('div');
					$(alert).addClass('alert alert-warning')
					.html('<h4> Não há mais atividades</h4>');
	
					$(container).append(alert);
					setTimeout(function(){$(alert).remove();}, 3000);
	
				}
				
				var hasMore = false;
				if(urlOptions.count == 0) hasMore = true; 
				
				for(i in data){
						var atv = document.createElement('div');
						$(atv).addClass("view atividade");
						var link = document.createElement('a');		
						$(link).attr('href', data[i].url);
						$(link).html("<h5>" + data[i].nome + "</h5>");
						$(atv).append(link);
						$(atv).append("<b>Responsável: </b>" + data[i].responsavel + "<br/>");
						$(atv).append("<b>Categoria: </b>" + data[i].categoria + "<br/>");
						$(atv).append("<b>Prazo: </b>" + formatDate(data[i].data_fim) + "<br/>");
						$(atv).append("<b>Status: </b>" + data[i].status + "<br/>");
						
						$(container).append(atv);
						urlOptions.count++;
					}
			
				if(hasMore){
					var link = document.createElement("button");
					$(link).addClass("btn btn-small btn-block")
					.attr('id', "atv-load-more")
					.html("Mais Atividades")
					.click(function(){
						load();
					});
					$("#more-atv").html(link);
			}
				
		});
	};


	this.formatDate = function(date){
		var d = new Date(date);
		return [d.getDate(), d.getUTCMonth()+1, d.getFullYear()].join("/");
	};
	
	this.load = function(options){
		load(options);
	};


	//Verifica se a data já expirou
	this.isExpired = function(date){
		var target = new Date(date);
		var today = new Date();

		return (today > target);
	};


	
}