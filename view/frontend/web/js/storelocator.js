define(["uiComponent", "jquery"], function (Component, $) {
    "use strict";
    return Component.extend({
        initialize: function (config, node) {
            // sb se phele ye chele ga
            console.log(config);
            console.log(node);
            this.StoresMap();
            this.GoogleMap();
            this.bindStoreGridFunction();
        },
        StoresMap: function () {
            $('.get_location').on('click' ,function (){
                alert("Message")
            })

            $('.flyTo').on('click' ,function (){
                alert("flyTO")
            })
        },
        GoogleMap: function () {
            $('#Google_Map').click(function (){
                alert("GoogleMap")
            })
        },
        bindStoreGridFunction: function () {
        },
    });
});
