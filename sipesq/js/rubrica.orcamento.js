/**
 * tabela: table-orcamento
*  	txtField: rubrica-valor
* 	btn: btnOrcamento
* 	dropDownList: list-rubricas
* 	Formulario: projeto-form

 * 
 * 
 */
var orcamentos = Array();


function Orcamento(){
	
	this.index = $('#orcamento').attr('data-count');
	console.log('Indice: ' + this.index);
	this.rubrica = 0;
	this.valor = 0;
	this.id = 0;
	
	this.selector = {
			valor: '#rubrica-valor'	
			,btn: '#btnOrcamento'
			,list: '#list-rubricas'
			,form: '#projeto-form'
			,tabela: '#table-orcamento'
	};
	
	//hash com os campos
	this.fields = {};
	
	
	this.createField = function(){
		
		
		this.rubrica = $(this.selector.list  + ' option:selected').text();
		this.id = $(this.selector.list +  ' option:selected').val();
		
		this.valor = $(this.selector.valor).val();
		form = $(this.selector.form).get(0);
		
		console.log(this.rubrica + ': ' + this.id);
		
		if(typeof($('.item-' + this.id).get(0)) !== "undefined"){
			alert('Você já adicionou esta rubrica.');
			return;
		};
		
		//Cria campo hidden
		var iHidden = document.createElement('input');
		$(iHidden).attr('type', "hidden");
		
		
			
		var inputId = document.createElement('input');
		inputId.type = 'hidden';
		inputId.form = form;
		inputId.value = this.id;
		inputId.name = "Orcamento[" + this.index +  "][cod_rubrica]";
		$(inputId).attr('class', 'item-' + this.id);
		$(form).append(inputId);
		console.log(inputId);
		
		var inputValor = document.createElement('input');
		inputValor.type = 'hidden';
		inputValor.form = form;
		inputValor.value = this.valor.replace('.', '').replace(',', '.');
		inputValor.name = "Orcamento[" + this.index +  "][valor]";
		$(inputValor).attr('class', 'item-' + this.id);
		$(form).append(inputValor);
		console.log(inputValor);
		
		
		//cria um item da tabela
		var item = document.createElement('tr');
		$(item).attr('class', 'item-' + this.id);
		$(item).append("<td>" + this.rubrica + "</td>");
		$(item).append("<td>" + this.valor + "</td>");
		
		
		//cria o menu do item
		var menu = document.createElement('i');
		$(menu).addClass('icon icon-trash');
		$(menu).attr('title', "Remover");
		$(menu).attr('data-remove-target', ".item-" + this.id);
		$(menu).tooltip();
		
		//Listener remove
		$(menu).click(function(){
			
			rubTarget = $(this).attr('data-remove-target'); 
			$(rubTarget).remove();
			delete(this.fields[rubTarget]);
			console.log("Removendo " + rubTarget);
		});
		
		tdMenu = document.createElement('td');
		$(tdMenu).append(menu);
		
		//coloca o menu na linha da tabela
		$(item).append(tdMenu);
		
		$('#table-orcamento').append(item);
		
		var newField = {
				  domElement: item
				, id: 'item-' + this.id
				, inputValor: inputValor
				, inputId: inputId
				, index: this.index
			};
		
		
		//Adiciona Campo na lista
		this.fields[newField.id] = newField;
		this.index++;
		
	};
	

}

