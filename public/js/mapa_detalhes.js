var map,service;
var marcadores = new Array();
var marcadoresAtivos = [];
var info = [];
var curr_infw;
var image = 'http://192.168.2.165:8888/sacavalcante/public/img/marker.png';
var locais = new Array();

var elemento = '#map';
marcadores[0]  = new Array($(elemento).attr('data-latitude'), $(elemento).attr('data-longitude'),'<strong>'+$(elemento).attr('data-endereco')+'</strong>');


if(typeof(Number.prototype.toRad) === "undefined"){
    Number.prototype.toRad = function(){
        return this * Math.PI / 180;
    }
}

function initialize(){
    geocoder = new google.maps.Geocoder();
    var myOptions = {
        zoom: 16,
        animation: google.maps.Animation.DROP,
        center: new google.maps.LatLng($(elemento).attr('data-latitude'), $(elemento).attr('data-longitude'),14.77),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById('map'), myOptions);

    google.maps.event.addListener(map, 'center_changed', function() {
        var location = map.getCenter();
    });

    aplicaRaio(1);
}


google.maps.event.addDomListener(window, 'load', initialize);


function createMarker(point, title, content, map, ativo){
    var marker = new google.maps.Marker({
        position: point,
        map: map,
        title: title,
        icon: image
    });

    var infowindow = new google.maps.InfoWindow({content: content});

    if(ativo == 1){
        if(curr_infw) { curr_infw.close();}
        curr_infw = infowindow;
        infowindow.open(map, marker);
    }

    google.maps.event.addListener(marker, 'click', function() {
       // toggleBounce();
        if(curr_infw) { curr_infw.close();}
        curr_infw = infowindow;
        infowindow.open(map, marker);
    });
    return marker;
};

function getPosAtual(){
    navigator.geolocation.getCurrentPosition(function(position){
        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

        var marker = new google.maps.Marker({
            position: pos,
            map: map,
            icon: image
        });

        map.setCenter(pos);
    });
}

function aplicaRaio(raio){
    if(marcadoresAtivos){
        marcadoresAtivos.length = 0;
    }

    var count, i, calcLat, calcLon, mediaLat, mediaLon;
    count =  marcadores.length-1;
    i=0;
    j=0;
    calcLat = 0;
    calcLon = 0;

    var location = map.getCenter();
    var latIni = location.lat();
    var lngIni = location.lng();

    for(i; i <= count; i++){
        var point = new google.maps.LatLng(marcadores[i][0], marcadores[i][1]);
        var title = marcadores[i][3];
        var content = marcadores[i][2];
        calcLat += marcadores[i][0];
        calcLon += marcadores[i][1];

        marcadoresAtivos[j] = createMarker(point, title, content, map);
        j++;
    }
}

function getCenter(){
    map.getCenter();
}

$(function(){
    $('.link-proximidades').click(function(){
        var opcao = $(this).attr('data-valor');

        if($(this).hasClass('active')){
            if(typeof marcadores[opcao] != 'undefined'){
                $.each(marcadores[opcao],function(k,v){
                    v.setMap(null);
                });
            }
        }else{

            if(typeof locais[opcao] != 'undefined'){

            }
        }
    });
});





