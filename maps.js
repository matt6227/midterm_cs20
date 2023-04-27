// Initialize the platform object
var platform = new H.service.Platform({
        'apikey': '1EtLTfmDeKxWI8nIlALa8nmHO5ygmMUHVM4n42Nr-uw'
    });
    
    // Obtain the default map types from the platform object
    var maptypes = platform.createDefaultLayers();
    
    // Set the center of the map
    var center = { lat: 40.7131, lng: -73.9549 };
    
    // Instantiate (and display) the map
    var map = new H.Map(
        document.getElementById('mapContainer'),
        maptypes.vector.normal.map,
        {
            zoom: 6,
            center: center
        }
    );
    
    // Add markers for Boston, New York City, and Washington, DC
    var bostonMarker = new H.map.Marker({ lat: 42.3601, lng: -71.0589 });
    map.addObject(bostonMarker);
    
    var nycMarker = new H.map.Marker({ lat: 40.7128, lng: -74.0060 });
    map.addObject(nycMarker);
    
    var dcMarker = new H.map.Marker({ lat: 38.9072, lng: -77.0369 });
    map.addObject(dcMarker);
    
    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    
