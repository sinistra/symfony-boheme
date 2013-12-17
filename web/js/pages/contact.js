var Contact = function() {

    return {
        //Map
        initMap: function() {
            var map;
            $(document).ready(function() {
                map = new GMaps({
                    div: '#map',
                    lat: -33.874363,
                    lng: 151.224048
                });
                var marker = map.addMarker({
                    lat: -33.874363,
                    lng: 151.224048,
                    title: 'Cafe Boheme'
                });
            });
        }

    };
}();