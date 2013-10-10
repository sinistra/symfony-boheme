var Contact = function() {

    return {
        //Map
        initMap: function() {
            var map;
            $(document).ready(function() {
                map = new GMaps({
                    div: '#map',
                    lat: -33.874237,
                    lng: 151.224015
                });
                var marker = map.addMarker({
                    lat: -33.874237,
                    lng: 151.224015,
                    title: 'Cafe Boheme.'
                });
            });
        }

    };
}();