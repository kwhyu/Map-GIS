<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistem Informasi Geografis - Map Sederhana</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/clara.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.3/dist/leaflet.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- <style>

  </style> -->
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.html"><span>GIS</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Map</a></li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1>Sistem Informasi Geografis <span>Peta</span></h1>
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto">Go to Map</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
          <img src="icon.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>
  </section><!-- End Hero -->

<main id="main">
  <!-- ======= Map Section ======= -->
  <section id="about" class="about">
    <div class="container-fluid">
    <div class="grid">
      <div class="column6">
          <div id="mapid"></div>
          <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.3/dist/leaflet.min.js"></script>
          <script>
            var mymap = L.map('mapid').setView([-8.4095188, 115.188919], 11);

            //Map Option
            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(mymap);

            var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
            });

            var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            });

            //Leaflet layer control
            var baseMaps = {
              'Base': osm,
              'Topografi':OpenTopoMap,
              'Imagery':Esri_WorldImagery
            }
            L.control.layers(baseMaps).addTo(mymap)

            var markers = [];
            var isOnDrag = false;

            function createMarker(latlng, index) {
                var marker = L.marker(latlng, { draggable: true }).addTo(mymap);
                var popup = L.popup({ offset: [0, -30] }).setLatLng(latlng);

                marker.on('click', function() {
                    popup.setLatLng(marker.getLatLng());
                    updatePopupContent(marker, index);
                });
                marker.on('drag', function() {
                    popup.setLatLng(marker.getLatLng());
                    updatePopupContent(marker, index);
                });
                marker.on('dragstart', function() { isOnDrag = true; });
                marker.on('dragend', function() {
                    setTimeout(function() { isOnDrag = false; }, 500);
                });
                marker.on('contextmenu', function() {
                    markers.splice(index, 1);
                    mymap.removeLayer(marker);
                });
                return marker;
            }

            function updatePopupContent(marker, index) {
                var lat = marker.getLatLng().lat.toFixed(6);
                var lng = marker.getLatLng().lng.toFixed(6);  
                // var content = `
                //         <div class ="popup-content latlan">
                //           <table border="2" cellpadding="10">
                //                 <tr>
                //                   <td><div class="popup-row">Marker</div></td>
                //                   <td><div class="popup-row">[${index + 1}]</div></td>
                //                 </tr>
                //                 <tr>
                //                   <td><div class="popup-row"><span class="popup-col">Latitude:</span>${lat}</div></td>
                //                   <td><div class="popup-row"><span class="popup-col">Longitude:</span>${lng}</div></td>
                //                 </tr>
                //               </table>
                //               </div>
                //               `;
                var content = `
                          <div class="popup-content">
                            <div class="popup-row">Marker [${index + 1}]</div>
                            <div class="popup-row"><span class="popup-col">Latitude:</span>${lat}</div>
                            <div class="popup-row"><span class="popup-col">Longitude:</span>${lng}</div>
                          </div>
                `;
                // Memindahkan konten popup ke dalam div dengan id 'info'
                document.getElementById('info').innerHTML = content;
                marker.getPopup().setContent(content);
            }

            mymap.on('click', function(e) {
                if (!isOnDrag) {
                    var marker = createMarker(e.latlng, markers.length);
                    markers.push(marker);
                }
            });
          </script>
          <!-- </script>  -->
      </div>
      <div class="column9">
        <div class="colomn66">
          <div id="info"></div>
        </div>
        <div class="colomn99">
          <button type="button" onclick="resetMarkers()">Reset</button>
        </div>
        <script>
          function resetMarkers() {
            // Hapus semua marker dari peta
            for (var i = 0; i < markers.length; i++) {
              mymap.removeLayer(markers[i]);
            }
            // Kosongkan array markers
            markers = [];
            // Kosongkan konten popup
            document.getElementById('info').innerHTML = '';
          }
        </script>
      </div>
    </div>
  </section>
</main>

        <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy;  <strong><span>Kwhy</span></strong>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>
