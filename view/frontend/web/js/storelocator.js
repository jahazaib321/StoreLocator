define(["uiComponent", "jquery"], function (Component, $) {
    "use strict";
    return Component.extend({
        map: null, initialize: function (config, node) {

            const Stores = config.stores;
            const MarkerIcon = config.marker_icon;
            const SelectedMarkerIcon = config.selected_marker_icon;
            const Default_Zoom = config.Default_Zoom;
            const Map_Style = config.Map_Style;
            const Image_Url = config.Image_Url;
            console.log("config", config);
            this.renderGetCurrentLocation();
            this.renderGoogleMap(Stores, MarkerIcon, SelectedMarkerIcon, Default_Zoom, Map_Style , Image_Url);
            this.SearchInputField();
            this.flyToLocation();
        },


        renderGetCurrentLocation: function () {
            let map = this.map;
            $('.get_location').on('click', function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        console.log(`Current Latitude is ${lat} and your lolatlngngitude is ${lng}`);
                        let center = new google.maps.LatLng(lat, lng);
                        map.setCenter(center);
                    });
                } else {
                    alert("Browser doesn't support Geolocation");
                }


            })
        },

        flyToLocation: function () {
            let map = this.map;
            $('.flyTo').on('click', function () {
                let lat = parseFloat($(this).data('lat'));
                let long = parseFloat($(this).data('long'));
                let center = new google.maps.LatLng(lat, long);
                map.setCenter(center);
                map.setZoom(12);
            })
        },
        renderGoogleMap: function (Stores, MarkerIcon, SelectedMarkerIcon, Default_Zoom, Map_Style , Image_Url) {
            let MapId = document.getElementById("Google_Map")
            let center = {lat: 38.000275, lng: 23.733576}
            this.map = new google.maps.Map(MapId, {
                center: center,
                zoom: Default_Zoom,
                greatPlaceCoords: {lat: 59.9695413, lng: 30.382844},
                clickable: true,
                styles: Map_Style,
                scrollwheel: true,
                panControl: true
            });
            Stores.map((store) => {
                let storeLatLong = {lat: parseFloat(store.lat), lng: parseFloat(store.lng)};
                let marker = new google.maps.Marker({
                    position: storeLatLong, map: this.map,
                    icon: SelectedMarkerIcon ? SelectedMarkerIcon : MarkerIcon,
                    style: {width: "40px"}
                });
                marker.addListener('click', () => {
                    let infoWindow = new google.maps.InfoWindow({
                        content: `
                         <div class="store-tooltip__content">
                         <img alt="store_image" src="${Image_Url}${store.image}" style="width: 100%; height: 100%;">
                         <div class="store-tooltip__title">
                         <h2>${store.name}</h2>
                         </div>
                           <a href="http://maps.google.com/maps?z=12&t=m&q=loc:${store.lat}+${store.lng}" target="_blank">
                           <button class="store-tooltip__button__div">
                            <span>Google_maps</span>
                            </button>
                             </a>
                               </div>`
                    });
                    infoWindow.open(this.map, marker);
                })
            });
            window.map = this.renderGoogleMap;
        },


        SearchInputField: function () {
            $("#myInput").on("keyup", function () {
                let value = $(this).val().toLowerCase();
                $("#myDiv li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        }


    })
});
// google_maps
