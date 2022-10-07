define(["uiComponent", "jquery"], function (Component, $) {
    "use strict";
    return Component.extend({
        map: null, initialize: function (config, node ,stores, google_api_key) {

            var taha = config.stores;
            console.log("taha" , taha)
            // sb se phele ye chele ga
            console.log("config", config);
            this.renderGetCurrentLocation();
            this.flyToLocation();
            this.renderGoogleMap();
            this.SearchInputField();
        },


        renderGetCurrentLocation: function () {
            $('.get_location').on('click', function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        if (window.map) {
                            window.map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
                        }

                    });
                }
            })

        },
        flyToLocation: function () {
            $('.flyTo').on('click', function (config) {
                setTimeout(() => {
                    // let maps = new google.maps;
                    let myLatlng = new google.maps.LatLng(-34.397, 150.644);
                    map.panTo(myLatlng);
                    // window.map.panTo(new google.maps.LatLng(24.860735, 67.001137), location);
                    map.setZoom(12);
                    return null;
                }, 1000);
            })

        },
        renderGoogleMap: function () {
            let MapContent = document.getElementById("Google_Map")
            let map = new google.maps.Map(MapContent, {
                center: {lat: 59.9695413, lng: 30.382844}, zoom: 12
            });

            let marker = new google.maps.Marker({
                // position: new google.maps.LatLng(24.860735, 67.001137),
                position: new google.maps.LatLng(taha.lat, taha.lng),
                map: map,
                animate: google.maps.Animation.BOUNCE,
            });
            console.log(taha)
            // let address = `  <div class="store-tooltip__content">
            //              <img class="store__image" src="" />
            //            <div class="store-tooltip__title">store name</div>
            //
            //             <div class="store-tooltip__buttons">
            //                             <a href="http://maps.google.com/maps?z=12&t=m&q=loc:${stores.lat}+${stores.lng}" target="_blank">
            //                              <button class="store-tooltip__button__div">
            //                              <span>
            //                              <img class="store-tooltip__button__img" src="pinBigImageSelected">
            //                              </span>
            //
            //                              </button>
            //                              <span class="store-tooltip__button__text" > Direction </span>
            //                              </a>
            //                     <a href="http://maps.google.com/maps?z=12&t=m&q=loc:${stores.lat}+${stores.lng}" target="_blank">
            //                              <button class="store-tooltip__button__div">
            //                              <span class="store-tooltip__button__title">
            //                              <img class="store-tooltip__button__img" src="pinBigImageSelected" >
            //                              </span>
            //                              </button>
            //                              <span class="store-tooltip__button__text"> Save </span>
            //                              </a>
            //                             <a href="http://maps.google.com/maps?z=12&t=m&q=loc:${stores.lat}+${stores.lng}" target="_blank">
            //
            //                                <button class="store-tooltip__button__div">
            //                              <span class="store-tooltip__button__title">
            //                              <img class="store-tooltip__button__img" src="pinBigImageSelected" >
            //                              </span>
            //                              </button>
            //                              <span class="store-tooltip__button__text"> Nearby </span>
            //                              </a>
            //                              </div>
            //
            //                                 <div class="store-tooltip__details">
            //
            //                              <div class="store-tooltip__address">
            //                              <div><img class="store-tooltip__button__img" src={pinBigImageSelected}></div>
            //                              <div>
            //                              <P>${stores.address}</p>
            //                              </div>
            //                              </div>
            //                              <div class="store-tooltip__address">
            //                              <div>
            //                              <img class="store-tooltip__button__img" src={pinBigImageSelected}>
            //                              </div>
            //                              <div>
            //                              <P>${stores.phone}</p>
            //                              </div>
            //                              </div>
            //                              </div>
            //
            //                             <div class="select">
            //                            <select name="slct" id="slct">
            //                              <option>Open Hours</option>
            //                              <option value="1">24</option>
            //                              <option value="2">24</option>
            //                              <option value="3">24</option>
            //                              <option value="4">24</option>
            //                              <option value="5">24</option>
            //                            </select>
            //                        </div>
            //                              </div>
            //                             </div>`
            marker.addListener('click', () => {

                let infoWindow = new google.maps.InfoWindow({
                    content: `<h1>Pop Data </h1>`
                });
                infoWindow.open(map, marker);
            })

        },
        SearchInputField: function () {
            $("#myInput").on("keyup", function () {
                let value = $(this).val().toLowerCase();
                $("#myDiv *").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        }


    })
});
// googlemaps
