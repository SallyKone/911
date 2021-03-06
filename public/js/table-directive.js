var app = angular.module("app", [])
.controller("TableController", ['$scope','$http', '$interval', function($scope, $http, $interval){
	$scope.pointages = [];
	$scope.sites = [];

	const myIconValid = L.icon({
      iconUrl: "../assets/images/myIconValid.png",
      iconSize:     [20, 40], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [10, 40], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    const myIconInvalid = L.icon({
      iconUrl: "../assets/images/myIconInvalid.png",
      iconSize:     [20, 40], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [10, 40], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

	$scope.markers = new L.FeatureGroup();
	$scope.mapsites = new L.FeatureGroup();
	
    $scope.map = L.map('map').setView([8, -5], 7);    
    L.tileLayer(
        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> Contributors',
        maxZoom: 30,
        minZoom: 1
    }).addTo($scope.map);


    $scope.myFunc = function(lat,lng) {
        $scope.map.setView([lat, lng], 17, {animation: true});
    };

	$scope.init = function(){
		

		$http.get('listeSites').success(function(data){
			$scope.sites = data;
			$scope.refresh_sites();
		});

		$interval(function () {
        	$http.get('listeCurrentPointages').success(function(data){
				$scope.pointages = data;
				$scope.refresh_markers();
			});
    	}, 5000);
	}

	$scope.refresh_sites = function(){
		$scope.mapsites.clearLayers();

		for (var i in $scope.sites) {
			
			$scope.site = new L.circle(new L.LatLng($scope.sites[i].latitude, $scope.sites[i].longitude), {radius: 30, color: "green"})
				.bindPopup("<b>"+$scope.sites[i].nom + "</b><br />" + $scope.sites[i].nbre + " Agent(s)")
				.on('mouseover', function (e) {this.openPopup();})
				.on('mouseout', function (e) {this.closePopup();});
			//console.log($scope.site);
			$scope.mapsites.addLayer($scope.site);
		}				
		$scope.map.addLayer($scope.mapsites);
	}

	$scope.refresh_markers = function(){
		$scope.markers.clearLayers();

		for (var i in $scope.pointages) {
			$scope.marker = new L.marker(new L.LatLng($scope.pointages[i].latitude, $scope.pointages[i].longitude), {icon: myIconValid})
				.bindPopup("<b>"+$scope.pointages[i].nom + " " +$scope.pointages[i].prenom+"</b><br />" + $scope.pointages[i].contact)
				.on('mouseover', function (e) {this.openPopup();})
				.on('mouseout', function (e) {this.closePopup();});
			$scope.markers.addLayer($scope.marker);
		}

		$scope.map.addLayer($scope.markers);
	}						
		
	$scope.init();
}]);