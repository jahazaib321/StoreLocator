define(["uiComponent", "jquery"], function (Component, $) {
    "use strict";
    return Component.extend({
        map: null, initialize: function (config, node, google_api_key) {

            const Stores = config.stores;
            console.log("config", config);
            console.log("stores", Stores);
            this.renderGetCurrentLocation();
            this.flyToLocation();
            this.renderGoogleMap(Stores);
            this.SearchInputField();
        },


        renderGetCurrentLocation: function () {
            $('#get_location').on('click', function () {
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
            $('.flyTo').on('click', function () {
                let lat = $(this).data('lat');
                let long = $(this).data('long');
                console.log(lat, ' -- ', long);
                setTimeout(() => {
                 let map = new google.maps.Map(document.getElementById("Google_Map"));
                    map.panTo(new google.maps.LatLng(lat, long));
                    map.setZoom(12);
                }, 1000);
            })
        },
        renderGoogleMap: function (Stores) {
            let MapContent = document.getElementById("Google_Map")
            let map = new google.maps.Map(MapContent, {
                center: {lat: 59.9695413, lng: 30.382844},
                zoom: 12
            });

            let marker;
            Stores.map((store) => {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(store.lat, store.lng),
                    map: map,
                    animate: google.maps.Animation.BOUNCE,
                });
                marker.addListener('click', () => {
                    let infoWindow = new google.maps.InfoWindow({
                        content: `<div class="store-tooltip__content">
                         <img class="store__image" src={store.image} />
                       <div class="store-tooltip__title">store name</div>

                        <div class="store-tooltip__buttons">
                                        <a href="http://maps.google.com/maps?z=12&t=m&q=loc:${store.lat}+${store.lng}" target="_blank">
                                         <button class="store-tooltip__button__div">
                                         <span>
                                         <img class="store-tooltip__button__img" src="pinBigImageSelected">
                                         </span>

                                         </button>
                                         <span class="store-tooltip__button__text" > Direction </span>
                                         </a>
                                <a href="http://maps.google.com/maps?z=12&t=m&q=loc:${store.lat}+${store.lng}" target="_blank">
                                         <button class="store-tooltip__button__div">
                                         <span class="store-tooltip__button__title">
                                         <img class="store-tooltip__button__img" src="pinBigImageSelected" >
                                         </span>
                                         </button>
                                         <span class="store-tooltip__button__text"> Save </span>
                                         </a>
                                        <a href="http://maps.google.com/maps?z=12&t=m&q=loc:${store.lat}+${store.lng}" target="_blank">

                                           <button class="store-tooltip__button__div">
                                         <span class="store-tooltip__button__title">
                                         <img class="store-tooltip__button__img" src="pinBigImageSelected" >
                                         </span>
                                         </button>
                                         <span class="store-tooltip__button__text"> Nearby </span>
                                         </a>
                                         </div>

                                            <div class="store-tooltip__details">

                                         <div class="store-tooltip__address">
                                         <div>
                                         <img class="store-tooltip__button__img" src={store.image}></div>
                                         <div>
                                         <P>${store.address}</p>
                                         </div>
                                         </div>
                                         <div class="store-tooltip__address">
                                         <div>

                                         <img class="store-tooltip__button__img" src={store.image}>
                                         </div>
                                         <div>
                                         <P>${store.phone}</p>
                                         </div>
                                         </div>
                                         </div>

                                        <div class="select">
                                       <select name="slct" id="slct">
                                         <option>Open Hours</option>
                                         <option value="1">24</option>
                                         <option value="2">24</option>
                                         <option value="3">24</option>
                                         <option value="4">24</option>
                                         <option value="5">24</option>
                                       </select>
                                   </div>
                                         </div>
                                        </div>`
                    });
                    infoWindow.open(map, marker);
                })
            });

            window.map = this.renderGoogleMap;
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
// google_maps
