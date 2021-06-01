<?
if(!isset($id))
    $id = 'google-map';

// google map
Yii::import('map.models.GoogleMaps');
$map_model = GoogleMaps::model()->findByPk(1);
$mapLat = $map_model->map_lat;
$mapLng = $map_model->map_lng;
$mapZoom = 15;
if($map_model) {
//    Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDbhMDAxCreEWc5Due7477QxAVuBAJKdTM');
    Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js');
    Yii::app()->clientScript->registerScript($id.'-script',
        "
        map = new OpenLayers.Map('$id');
        map.addLayer(new OpenLayers.Layer.OSM());
    
        var lonLat = new OpenLayers.LonLat($mapLng,$mapLat).transform(
            new OpenLayers.Projection('EPSG:4326'), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
          );
              
        var zoom=$mapZoom;
    
        var markers = new OpenLayers.Layer.Markers('Markers');
        map.addLayer(markers);
        
        markers.addMarker(new OpenLayers.Marker(lonLat));
        
        map.setCenter (lonLat, zoom);
        "
        ,CClientScript::POS_READY);
}
?>
<div id="<?= $id ?>"></div>