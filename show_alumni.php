<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaave Alumni Search</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #map {
      height: 100%;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .container-fluid {
      height: 100vh;
    }

    .results-section, .map-section {
      height: calc(100vh - 180px); /* Adjust for header and form height */
      overflow-y: auto;
    }

    .header {
      height: 80px;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      padding: 0 20px;
      border-bottom: 1px solid #ddd;
    }

    .header img {
      height: 60px;
    }

    .search-form {
      padding: 20px;
      background-color: #f8f9fa;
      border-bottom: 1px solid #ddd;
    }

    .results-list {
      padding: 15px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="header">
    <img src="https://www.vaave.com/media/logo-black.png" alt="Vaave Logo">
  </div>

  <!-- Search Form -->
  <div class="search-form">
    <form id="searchForm" class="row g-3">
      <div class="col-md-4">
        <input type="text" class="form-control" id="latitude" placeholder="Latitude" required>
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" id="longitude" placeholder="Longitude" required>
      </div>
      <div class="col-md-4">
        <input type="number" class="form-control" id="radius" placeholder="Radius in km" required min="1">
      </div>
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary w-100">Search</button>
      </div>
      <div class="col-md-6">
        <button type="button" class="btn btn-secondary w-100" id="clearForm">Clear</button>
      </div>
    </form>
  </div>

  <!-- Split Layout -->
  <div class="container-fluid">
    <div class="row h-100">
      <!-- Results Section -->
      <div class="col-md-6 bg-light results-section">
        <h4 class="text-center mt-3">Search Results</h4>
        <div class="results-list" id="results">
          <p class="text-muted text-center">No data to display</p>
        </div>
      </div>

      <!-- Map Section -->
      <div class="col-md-6 map-section">
        <div id="map"></div>
      </div>
    </div>
  </div>

  <!-- Google Maps API -->
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1epB5hsaQ9jqaiuG58ehEf2F-eKUIE30&callback=initMap&v=weekly"
    defer
  ></script>

  <script>
    const searchApi = 'http://localhost/vaave/api_search_alumni.php';

    let map;
    let circle;

    function fetchResults(latitude, longitude, radius) {
      fetch(`${searchApi}?latitude=${latitude}&longitude=${longitude}&radius=${radius}`)
        .then(response => response.json())
        .then(data => {
          updateResults(data);
          updateMap(latitude, longitude, radius);
        })
        .catch(error => console.error('Error fetching search results:', error));
    }

    function updateResults(data) {
      const resultsContainer = document.getElementById('results');
      resultsContainer.innerHTML = '';

      if (!data || data.length === 0) {
        resultsContainer.innerHTML = '<p class="text-muted text-center">No alumni found within the specified radius.</p>';
        return;
      }

      data.forEach((result, index) => {
        const resultDiv = document.createElement('div');
		var counter=index+1;
        resultDiv.classList.add('mb-3', 'p-2', 'border', 'rounded', 'bg-white');
        resultDiv.innerHTML = '<strong>'+counter+'. '+result.name+'</strong><br>Email:'+ result.email+'<br>Latitude:'+result.latitude+'<br>Longitude:'+result.longitude;
        resultsContainer.appendChild(resultDiv);
      });
    }

    function updateMap(latitude, longitude, radius) {
      const center = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

      if (!map) {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: center,
          mapTypeId: 'terrain',
        });
      } else {
        map.setCenter(center);
        map.setZoom(12);
      }

      if (circle) {
        circle.setMap(null); // Remove the existing circle
      }

      circle = new google.maps.Circle({
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
        map,
        center: center,
        radius: radius * 1000,
      });
    }

    document.getElementById('searchForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const latitude = document.getElementById('latitude').value.trim();
      const longitude = document.getElementById('longitude').value.trim();
      const radius = document.getElementById('radius').value.trim();

      if (!latitude || !longitude || !radius || isNaN(radius) || radius <= 0) {
        alert('Please provide valid inputs.');
        return;
      }

      fetchResults(latitude, longitude, radius);
    });

    document.getElementById('clearForm').addEventListener('click', function () {
      document.getElementById('searchForm').reset();
      document.getElementById('results').innerHTML = '<p class="text-muted text-center">No data to display</p>';
      if (circle) {
        circle.setMap(null); // Remove the circle
      }
    });

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: { lat: 18.5204, lng: 73.8567 },
        mapTypeId: 'terrain',
      });
    }

    window.initMap = initMap;
  </script>
</body>
</html>
