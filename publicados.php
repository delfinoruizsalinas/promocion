<!DOCTYPE html>
<html ng-app="MyFirstApp">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Promoción</title>


<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/angular.min.js"></script>


<style>

body {
  background: url(images/el.jpg);
}

h1
{
       font-size: 5.9vw;
       background-color: #ffd102;
}
h3
{
       font-size: 4.0vh;
       color: #470a40;
}

@media (min-width: 1380)
{
       h1
       {
           font-size: 17px; 
       }
       h3
       {
           font-size:24px;
       }
}

</style>
</head>
<body ng-controller="FirstController">

  <div class="container col-md-12">
    <br>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        
        <div ng-repeat="sl in slides" class="item {{sl.esta}}">
                
          <div class="col-md-4 col-md-offset-1">
            <img src="<?php echo "http://dersacom.com/promocion/php/imagenes/?uid={{sl.id_promo}}&tkn={{sl.estatus}}&sz=300" ?>" /> 
          </div>
          <div class="col-md-6">
            <span style="font-size: 5.9vw; color:#3c8dbc">{{ sl.clasificacion }}</span>
          </div>
          <div class="col-md-6">
            <span style="font-size: 2vw;">{{ sl.nombre_producto }}</span>
          </div>
          <div class="col-md-6">
            <span style="font-size: 2vw;">{{ sl.descripcion }}</span>
          </div>
          <div class="col-md-6">
            <span style="font-size: 2vw; color:#aed642">{{ sl.nombre_promocion }}</span>
          </div>
          <div class="col-md-6">
            <span style="font-size: 4vw; color:red">{{ sl.precio_venta | currency:"$":2}}</span>
        </div>

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      </div>
    </div>
  </div>

  <div class="col-md-5">
	<div id="tyt_wdgt_1479522977289" style="overflow:hidden;width:700px;height:450px" data-options="color=gris&text=&content=1111111&temp_unit=c&wind_unit=kmh"><script src="http://tiempoytemperatura.es/widgets/js/biggest-6day/3530597/tyt_wdgt_1479522977289/?v=0"></script></div>
    
  </div>
  <div class="col-md-7">
  	<iframe src="http://www.20minutos.com.mx/widgets/render/portada/6/" frameborder="0" height="300" width="600"></iframe>
  </div>

</body>
<script type="text/javascript" src="js/publicados.js"></script>
<script type="text/javascript" src="js/FeedEk.js"></script>
<script type="text/javascript">
   $(document).ready(function () {

  // $('#divRss').FeedEk({
  //     FeedUrl: 'https://es-us.deportes.yahoo.com/f%C3%BAtbol/mexicano/?format=rss',
  //     MaxCount: 3
  // });

  // function loadFeed(){ // wrapper function
  //   $('#divRss').FeedEk({
  //    FeedUrl : 'https://news.google.com.mx/news?cf=all&hl=es&pz=1&ned=es_mx&topic=s&output=rss',
  //    MaxCount : 1,


  //   }); 
  // } // /wrapper
  // loadFeed();
  // setInterval(loadFeed, 64 * 1000 );


  });

</script>

</html>