/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    
    var map = L.map('map').setView([43.632487, 3.864621], 16);
    L.tileLayer('http://{s}.tile.cloudmade.com/f809e033ff534c8d9406d1a245f6eac9/997/256/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
        maxZoom: 18
    }).addTo(map);
    
    var polygon = L.polygon([
        [43.63279, 3.86099],
        [43.63266, 3.86107],
        [43.63334, 3.86333],
        [43.63345, 3.86323]
        ], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0
        }).addTo(map);
    // 43.63307, 3.86217
    var popup = L.popup()
    .setLatLng(new L.LatLng(43.63307, 3.86217))
    .setContent('<b>Bâtiment 5</b><p>TD 5.06</p>')
    .openOn(map);


    function onMapClick(e) {
        alert(e.latlng );
    }

    map.on('click', onMapClick);

});