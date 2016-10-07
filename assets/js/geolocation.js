function iniciar() {
    if(!!navigator.geolocation)
        navigator.geolocation.getCurrentPosition(mostraCoords,trataGeoErro,{
            enableHighAccuracy: true,
            maximumAge: 25000,
            timeout: 5000
        });
    else {
        var campo = document.getElementById('coordenadas');
        campo.innerHTML='Seu navegador não suporta a geolocalização';
        campo.style.fontStyle = 'italic';
        campo.style.color = 'red';
    }
}

function mostraCoords(posicao) {
    var campo = document.getElementById('coordenadas');
    console.log(posicao);
    campo.innerHTML = 'lat: '+posicao.coords.latitude+', lng: '+posicao.coords.longitude+', acc: '+posicao.coords.accuracy;
    var mapa = 'https://maps.googleapis.com/maps/api/staticmap?center='+posicao.coords.latitude+','+posicao.coords.longitude +
        '&zoom=17&size=600x450&maptype=roadmap&markers=color:red|label:A|'+posicao.coords.latitude+','+posicao.coords.longitude;
    document.getElementById('mapa').innerHTML = '<img src="'+mapa+'"/>';
}

function trataGeoErro(erro) {
    var campo = document.getElementById('coordenadas');
    campo.style.fontStyle = 'italic';
    campo.style.color = 'red';

    switch(erro.code) {
        case erro.PERMISSION_DENIED:
            alert('O usuário não autorizou a geolocalização');
            break;
        case erro.POSITION_UNAVAILABLE:
            alert('Localização não está disponível');
            break;
        case erro.TIMEOUT:
            alert('Tempo esgotado para obtenção da localização');
            break;
        default:
            alert('Erro desconhecido: ' + erro.code + '<br/>' + erro.message);
    }
}

window.addEventListener('load', iniciar, false);