function Rubrica () {
		this.selector = {
				container: '#campos-adicionais'	
				,chave: '#rubricaCampoChave'
				,tipo: '#rubricaCampoTipo'
				,form: '#rubrica-form'
		};
		
		this.index = 0;
		
		//hash com os campos
		this.fields = {};
		
		/**
		 * @param container
		 * @param form 
		 * @param campo
		 * @param tipo
		 */
		this.setSelectors = function(form, container, campo, tipo){
			this.selector.form = form;
			this.selector.container = container;
			this.selector.campo = campo;
			this.selector.tipo = tipo;
		};
		
		/**
		 * Cria um campo oculto
		 */
		this.createHiddenInput = function(selector, name){
			
			var input = document.createElement('input');
			input.type = 'hidden';
			input.form = $(this.selector.form);
			input.value = $(selector).val();
			input.name = name;
			return input;
		};
		
		
		/**
		 * Cria um campo
		 */
		
		this.createField = function(){
			
			var button = document.createElement('button');
			$(button).addClass('close');
			$(button).attr('type','button');
			$(button).attr('data-dismiss','alert');
			$(button).attr('data-target', this.index);
			$(button).append('&times;');
			
			$(button).click(function(){ //trigger para delecao do cmapo
				var target = $(this).attr('data-target');
				console.log('Deletando campo: ' + target );
				rubrica.deleteField('campo-' + target);
			});
			
			var campo = document.createElement('li');
			$(campo).addClass('alert alert-success');
			$(campo).append('<b>' + $(this.selector.chave).val() + '</b> <i>(' + $(this.selector.tipo + ' option:selected').text() + ')</i>');
			$(campo).append(button);
			
			
			var inputType = this.createHiddenInput(this.selector.tipo, 'Campo['+ this.index +'][tipo]');
			var inputKey = this.createHiddenInput(this.selector.chave, 'Campo['+ this.index +'][chave]');

			var newField = {
				  domElement: campo
				, id: 'campo-' + this.length
				, inputKey: inputKey
				, inputType: inputType
				, index: this.index
			};
			
			//Adiciona os campos no documento
			$(this.selector.container).append(newField.domElement); //DOM
			$(this.selector.form).append(newField.inputKey); //chave
			$(this.selector.form).append(newField.inputType); //tipo
			
			//Adiciona Campo
			this.fields[newField.id] = newField;
			
			//atualiza numero de campos
			this.index++;
			
		};
		
		/**
		 * deleta um campo
		 */
		this.deleteField = function(id){
			
			//Remove do documento
			$(this.fields[id].inputKey).remove();
			$(this.fields[id].inputType).remove();
			$(this.fields[id].domElement).remove();
			//remove do array
			delete(this.fields[id]);
			
		};
		
		
}
