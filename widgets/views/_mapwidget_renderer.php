<?php

use yii\helpers\Html;
use kartik\icons\Icon;

?>

<?php

//initialise all waypoints
$mycenter = 0;
$locations = array();
foreach($dpLocations AS $location){
  foreach($location->party->addresses AS $address)
  {
    if($mycenter == 0)
    {
      $center = new dosamigos\leaflet\types\LatLng(['lat' => $address->no_latitude, 'lng' => $address->no_longitude]);
    }
    $locations[$location->party->organisationName] = new dosamigos\leaflet\types\LatLng(['lat' => $address->no_latitude, 'lng' => $address->no_longitude]);
    $mycenter++;  
  }
}

if($mycenter>0)
{ 

  $layer = new dosamigos\leaflet\layers\TileLayer([
       //'urlTemplate' => 'http://{s}.tile.cloudmade.com/c78ff4e5762545188f82a9a4cd552d54/997/256/{z}/{x}/{y}.png',
       'urlTemplate' => 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
       'map' => 'BlogMap'.$location->param2_int,
       'clientOptions' =>[
          'attribution' => 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
       ]
  ]);

  $leafLet = new dosamigos\leaflet\LeafLet([
    'center' => $center,
    'zoom' => 13,
    'TileLayer' => $layer,
    'name' => 'BlogMap'.$location->param2_int
  ]);

  // Initialize plugin
  $makimarkers = new dosamigos\leaflet\plugins\makimarker\MakiMarker(['name' => 'makimarker']);

  $leafLet->installPlugin($makimarkers);

  //var_dump($leafLet->plugins);exit;

  foreach($locations as $key=>$value)
  {
    // generate icon through its icon
    $marker = new dosamigos\leaflet\layers\Marker([
        'latLng' => $value,
        'icon' => $leafLet->plugins->makimarker->make("cafe",['color' => "#b0b", 'size' => "m"]),
        'popupContent' => $key
    ]);

    $leafLet->addLayer($marker);
  }

  echo dosamigos\leaflet\widgets\Map::widget(['leafLet' => $leafLet,'options' => ['style' => 'height: 400px']]);

}

?>
