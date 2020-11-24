jQuery(document).ready(function($){
    
    var screen = tb_admin.screen;
    
    //Sortable for Team social links
    $('.tb-team-sortable-icons').sortable({
        cursor: "move"
    });     
    
    //datepicker for testimonail trip
    $('#trip-date').datepicker({ 
        maxDate: 0, 
        changeMonth: true,
        changeYear: true, 
        dateFormat: 'MM yy', 
        yearRange: "-100:+0" 
    });
    
    if( screen == 'tb_testimonial' ){
        var val = $("#trip-rating").val();
        $( "#rate-" + tb_admin.id ).rateYo({
         	onSet: function( rating, rateYoInstance ){
          		$("#trip-rating").val(rating);
        	}
      	});
        if( val ){
            $( "#rate-" + tb_admin.id ).rateYo( "rating", val );
        }
    }        
});