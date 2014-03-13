function TokenHelper () {

		this.options = {
			container: '#token-input',
			theme: 'facebook',
			searchingText: 'Buscando',
			hintText: 'Digite um nome',
			minChars: 1,
			url: '/sipesq/index.php/pessoa/json',
			form: 'pessoa-form',
			preventDuplicates: true,

			onAdd: function(item){ return; },
			onDelete: function(item){ return; },
			prePopulate: Array()

		}; 

		/*
	[
                    {id: 123, name: "Slurms MacKenzie"},
                    {id: 555, name: "Bob Hoskins"},
                    {id: 9000, name: "Kriss Akabusi"}
                ]
		*/

		this.numTokens = 0; 
	
				
		
		this.init = function(options){
			var opt = this.options;
			
			console.log(this.options['prePopulate']);
			
			jQuery.map(options, function(value, index){      			
      			if(opt[index] != undefined)
      				opt[index] = value;



    		});

    		$(this.options.container).tokenInput(this.options.url, this.options);
    		
		}
					
}