// Formata o campo valor
function formataValor(campo) {
    campo.value = filtraCampoValor(campo); 
    vr = campo.value;
    tam = vr.length;

    if ( tam <= 2 ){ 
        campo.value = vr ; }
    if ( (tam > 2) && (tam <= 5) ){
        campo.value = vr.substr( 0, tam - 2 ) + ',' + vr.substr( tam - 2, tam ) ; }
    if ( (tam >= 6) && (tam <= 8) ){
        campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ; }
    if ( (tam >= 9) && (tam <= 11) ){
        campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ; }
    if ( (tam >= 12) && (tam <= 14) ){
        campo.value = vr.substr( 0, tam - 11 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ; }
    if ( (tam >= 15) && (tam <= 18) ){
        campo.value = vr.substr( 0, tam - 14 ) + '.' + vr.substr( tam - 14, 3 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ;}
        
}


// Formata o campo valor
function formataNumerico(campo) {

    campo.value = filtraCampo(campo);
    vr = campo.value;
    tam = vr.length;
}

// limpa todos os caracteres especiais do campo solicitado
function filtraCampo(campo){
    var s = "";
    var cp = "";
    vr = campo.value;
    tam = vr.length;
    for (i = 0; i < tam ; i++) {  
        if (vr.substring(i,i + 1) != "/" && vr.substring(i,i + 1) != "-" && vr.substring(i,i + 1) != "."  && vr.substring(i,i + 1) != "," ){
            s = s + vr.substring(i,i + 1);}
    }
    campo.value = s;
    return cp = campo.value;
}
//limpa todos os caracteres especiais do campo solicitado
function filtraCampoValor(campo){
    var s = "";
    var cp = "";
    vr = campo.value;
    tam = vr.length;
    for (i = 0; i < tam ; i++) {  
        if (vr.substring(i,i + 1) >= "0" && vr.substring(i,i + 1) <= "9"){
            s = s + vr.substring(i,i + 1);}
    } 
    campo.value = s;
    return cp = campo.value;
}