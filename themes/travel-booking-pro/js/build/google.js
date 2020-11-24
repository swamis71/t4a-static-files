google.maps.event.addDomListener( window, 'load', gmaps_results_initialize );
/**
 * Renders a Google Maps centered on Atlanta, Georgia. This is done by using
 * the Latitude and Longitude for the city.
 *
 * Getting the coordinates of a city can easily be done using the tool availabled
 * at: http://www.latlong.net
 *
 * @since    1.0.0
 */
function gmaps_results_initialize(){
    
	if ( null === document.getElementById( 'map-canvas' ) ) {
		return;
	}

	var map, marker, wheel, zoom, control, defaultUi;
    var myLatLng = {lat: parseFloat( tbp_gdata.latitude ), lng: parseFloat( tbp_gdata.longitude )};
    
    if( tbp_gdata.scroll == '1' ){
        wheel = true;
        zoom  = false;
    }else{
        wheel = false;
        zoom  = true;
    }
    
    if( tbp_gdata.control == '1' ){
        control   = true;
        defaultUi = false;
    }else{
        control    = false;
        defaultUi  = true;
    }
    
	map = new google.maps.Map( document.getElementById( 'map-canvas' ), {
		zoom                  : parseInt( tbp_gdata.zoom ),
		center                : myLatLng,
        mapTypeId             : google.maps.MapTypeId.mtype,
        scrollwheel           : wheel,
        zoomControl           : zoom, //opposite value of scrollwheel
        mapTypeControl        : control,
        disableDefaultUI      : defaultUi,//opposite value of mapTypeControl
        mapTypeControlOptions : {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        
	});
    
    if( tbp_gdata.ed_marker == '1' ){
    	// Place a marker in Atlanta
    	marker = new google.maps.Marker({
    		position : myLatLng,
    		map      : map,
            title    : tbp_gdata.marker_title,
            content  : tbp_gdata.marker_title
    	});
        
        // Add an InfoWindow for Marker
        infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener( marker, 'click', ( function( marker ) {    
        	return function() {
        		infowindow.setContent( marker.content );
                infowindow.open( map, marker );
        	};    
        })( marker ));
    }
}