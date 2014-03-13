
	this.currentMarker = null;
	this.map = null;
	this.geocoder = null;
	this.latLng = new google.maps.LatLng(-27.5969039, -48.5494544);
	this.resourceUri = 'uri';
	this.markers = new Array();

  function initialize(uri) {
	    
	  this.resourceUri = uri;
	
    var myOptions = {
      zoom: 8,
      center: latLng,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      minZoom: 3
    };
    
    map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);

  	//Verifica se o navegador tem suporte a geolocalidade
  	if(navigator.geolocation){
  		//Obtem a posicao do usuário
  		navigator.geolocation.getCurrentPosition(function(position){
  			  var pos = new google.maps.LatLng(position.coords.latitude,
                                             position.coords.longitude);
            map.setCenter(pos);
            map.setZoom(6);
  		});

  	}
  	 	
  }
  
  
  /**
   * Registra os listeners para a criação / edição
   */
  function registerFormListeners(){
	  
	  //Registra listener de busca de locais
	  $('#query').click(function(){
	  		getLocation();
	  		
	  	});
	  //Listener para buscar marcadores no mapa
	  google.maps.event.addListener(map, 'idle', fetchMarkers);
	  
	  //Listener para adicionar marcador no mapa
	  google.maps.event.addListener(map, 'click', placeMarker);
	  
  }
  
  
  /**
   * Registra listeners de visualização do atlas
   */
  function registerViewListeners(){
	  //Registra listener para a área sendo exibida pelo mapa
	  google.maps.event.addListener(map, 'idle', fetchMarkers);
	  $('#query').click(findLocation);
	  //$('#query-form').change(findLocation);
	  
  }
  

  /**
  * Seta as configurações padrões do nosso mapa
  */
    function setDefaultMapProperties() {
      //Seta o tipo de mapa
      map.setMapTypeId(google.maps.MapTypeId.TERRAIN);
      //Seta o zoom padrão
      map.setZoom(5);
      
    }


/**
 * listener para colocar um marcador no lugar clicado por "event"
 * @param event
 */
  function placeMarker(event) {
  		var location = event.latLng;
  		//Remove a antig	a marcaçao
  		if(currentMarker != null){
  			currentMarker.setMap(null);
  		}

  	  //Adiciona um novo marcador no mapa
	  var marker = new google.maps.Marker({
	      position: location, 
	      map: map
	  });

	  //Atualiza o marker corrente
	  currentMarker = marker;

	  $('#Atlas_latitude').val(location.lat());

	  $('#Atlas_longitude').val(location.lng());
	  
 }
  
  
 /**
  * Captura a localização do form e busca ela no mapa. 
  */
 function getLocation() {
 		
 		var location = $('#Atlas_local').val();
    
       if(!geocoder) {
          geocoder = new google.maps.Geocoder();	
        }
        
        var geocoderRequest = {
          address: location
        };
        
        geocoder.geocode(geocoderRequest,
         function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {

              var locationResult = results[0].geometry.location;
              	//Restaura configurações do mapa.
              	setDefaultMapProperties();
              	//Centra mapa no primeiro lugar encontrado
                map.setCenter(locationResult);

                 if (currentMarker != null) {
                 	currentMarker.setMap(null);
                 }
                 
                 currentMarker = new google.maps.Marker({
	     			 	position: locationResult, 
	      				map: map
	  				});

	  			//Mostra os resultados
	  			//Mostra o resultado encontrado
              	$('#Atlas_local').val(results[0].formatted_address);
	  			$('#Atlas_latitude').val(locationResult.lat());
	  			$('#Atlas_longitude').val(locationResult.lng());
            }

        });

    }
 
 
    /**
     * Captura a localização do form e busca ela no mapa. 
     */
    function findLocation() {
    		
    		var location = $('#query-form').val();
       
          if(!geocoder) {
             geocoder = new google.maps.Geocoder();	
           }
           
           var geocoderRequest = {
             address: location
           };
           
           geocoder.geocode(geocoderRequest,
            function(results, status) {
               if (status == google.maps.GeocoderStatus.OK) {

                 var locationResult = results[0].geometry.location;
                 	//Restaura configurações do mapa.
                 	setDefaultMapProperties();
                 	//Centra mapa no primeiro lugar encontrado
                   map.setCenter(locationResult);
                   map.setZoom(7);

   	  			//Mostra os resultados
   	  			//Mostra o resultado encontrado
                 $('#query-form').val(results[0].formatted_address);
               }

           });

       }
    /**
     * Busca os marcadores que estão na área visualizada no mapa.
     */
    function fetchMarkers(){
    	
    	bounds = map.getBounds();
		  mapArea = {
				  nLat: bounds.getNorthEast().lat(),
				  nLng: bounds.getNorthEast().lng(),
				  sLat: bounds.getSouthWest().lat(),
				  sLng: bounds.getSouthWest().lng()
		  };
		  
		  //limpa os marcadores antigos
		  for(m in markers){
			  m.setMap(null);
		  }
		  
		  var xhr = $.getJSON(resourceUri, mapArea , function(data) {

	    		 //Para cada resultado do JSON retornado adiciona um marcador no mapa
	    		  $.each(data,function(key, val) {
	    			  
	    			var location = new google.maps.LatLng(val.latitude, val.longitude);
	    			//Adiciona um novo marcador no mapa
	    			
	    			  var marker = new google.maps.Marker({
	    			      position: location, 
	    			      map: map, 
	    			      title: val.titulo,
	    			      
	    			  });
	    			  
	    			  //coloca a imagem do ícone
	    			  if(val.marcador){
	    				  marker.setIcon(val.marcador);
	    			  }
	    			  
	    			  //Adiciona a janela de informações
	    			  var infowindow = new google.maps.InfoWindow({
	    			        content: val.descricao
	    			    });

	    			  //Coloca o listener para a janela de informações abrir com o click
	    			    google.maps.event.addListener(marker, 'click', function() {
	    			      infowindow.open(map,marker);
	    			    });
	    			    
	    			    markers.push(marker);
	    		  });

	    		});
	  }
    
   