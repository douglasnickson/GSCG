<?php 
include ("connection.php");
include ("funcoes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GSCP - Home</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="http://maps.google.com/maps/api/js?v=3.exp&key=AIzaSyBZOXNqrTHY5EOl52Ur0-eZPhQHM9aqc_Y"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="row" style="margin: 10px 0 10px 0;">
<div class="col-sm-5"></div>
<div class="col-sm-4"><img class="logomarca" src="./images/sebrae-logo.png"></div>
<div class="col-sm-3"></div>
</div>
<div id="map"></div>
    <script type="text/javascript">
        var delay = 25;
        var infowindow = new google.maps.InfoWindow();
        var latlng = new google.maps.LatLng(-7.2357477, -35.8878219);
        var mapOptions = {
          zoom: 14,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var geocoder = new google.maps.Geocoder(); 
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var bounds = new google.maps.LatLngBounds();
      
        function geocodeAddress(address,content, next) {
          geocoder.geocode({address:address}, function (results,status)
            { 
               if (status == google.maps.GeocoderStatus.OK) {
                var p = results[0].geometry.location;
                var lat=p.lat();
                var lng=p.lng();
                createMarker(content,lat,lng);
              }
              else {
                 if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                  nextAddress--;
                  delay++;
                } else {
                              }   
              }
              next();
            }
          );
        }

        function createMarker(add,lat,lng) {
            var contentString = add;
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat,lng),
                map: map,
        });
      
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(contentString); 
            infowindow.open(map,marker);
        });
      
        bounds.extend(marker.position);
      
       }

        var locations = [
        <?php 
            $sql = mysqli_query($conn, "select * from tb_endereco");
            while ($result = mysqli_fetch_array($sql)) {
                $endereco = $result['rua'].','.$result['numero'].','.$result['cidade'].','.$result['estado'].','.$result['pais'];
                echo "'".(string) $endereco."',";
            }
        ?>
        ];

        var content = [
        <?php 
            $sql = mysqli_query($conn, "select * from tb_empresa");
            $count = 1;
            while ($result = mysqli_fetch_array($sql)) {
                $dados = "<br><b>".$count." - ".strtoupper($result['razao_social'])."</b><br><b>CNPJ: </b>".mask($result['cnpj'],'##.###.###/####-##')."</div><br><b>Tel. Fixo: </b>".mask($result['tel_fixo'], '####-####')."<br><b>Tel.Celular: </b>".mask($result['tel_celular'], '(##) #####-####')."<br>";
                echo "'".(string) $dados."',";
                $count+=1;
            }
        ?>
        ];

        var nextAddress = 0;
        function theNext() {
            if (nextAddress < locations.length) {
                setTimeout('geocodeAddress("'+locations[nextAddress]+'","'+content[nextAddress]+'",theNext)', delay);
                nextAddress++;
                } else {
                    map.fitBounds(bounds);
                }
            }
        theNext();
      
      </script>
    <!-- Scripts do JS -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>