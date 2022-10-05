define(["uiComponent", 'jquery'], function (Component, $) {
    "use strict";
    return Component.extend({

        initialize: function (config, node) {
            // sb se phele ye chele gasss
            console.log(config)
            console.log(node)
            this.initializeMap();
            this.bindMapMarker();
            this.bindStoreGridFunction();
        },
        initializeMap : function (){

        },
        bindMapMarker : function (){

        },
        bindStoreGridFunction : function (){
            this.flyTo(2.33,4.11);

        },
        flyTo : function (lat,long){

        }
    });
});





