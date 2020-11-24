( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

jQuery(document).ready(function($) {
	/* Move widgets to their respective sections in homepage */
	wp.customize.section( 'sidebar-widgets-about' ).panel( 'home_page_setting' );
    wp.customize.section( 'sidebar-widgets-about' ).priority( '20' );

    wp.customize.section( 'sidebar-widgets-cta-one' ).panel( 'home_page_setting' );
    wp.customize.section( 'sidebar-widgets-cta-one' ).priority( '40' );

    wp.customize.section( 'sidebar-widgets-cta-two' ).panel( 'home_page_setting' );
    wp.customize.section( 'sidebar-widgets-cta-two' ).priority( '80' );

    wp.customize.section( 'sidebar-widgets-client' ).panel( 'home_page_setting' );
    wp.customize.section( 'sidebar-widgets-client' ).priority( '110' );

    /* Move widgets to their respective sections in about page template */
    wp.customize.section( 'sidebar-widgets-about-intro' ).panel( 'about_page_setting' );
    wp.customize.section( 'sidebar-widgets-about-intro' ).priority( '10' );

    wp.customize.section( 'sidebar-widgets-about-client' ).panel( 'about_page_setting' );
    wp.customize.section( 'sidebar-widgets-about-client' ).priority( '20' );

    wp.customize.section( 'sidebar-widgets-about-service' ).panel( 'about_page_setting' );
    wp.customize.section( 'sidebar-widgets-about-service' ).priority( '30' );

    wp.customize.panel( 'about_page_setting', function( section ) {
        section.expanded.bind( function( isExpanded ) {
            if ( isExpanded ) {
                wp.customize.previewer.previewUrl.set( tb_customizer_data.url1  );
            }
        } );
    } );
    // console.log( tb_customizer_data.url2 );
    wp.customize.section( 'contact_template_section', function( section ) {
        section.expanded.bind( function( isExpanded ) {
            if ( isExpanded ) {
                wp.customize.previewer.previewUrl.set( tb_customizer_data.url2  );
            }
        } );
    } );

    wp.customize.panel( 'team_page_setting', function( section ) {
        section.expanded.bind( function( isExpanded ) {
            if ( isExpanded ) {
                wp.customize.previewer.previewUrl.set( tb_customizer_data.url3  );
            }
        } );
    } );

    wp.customize.section( 'testimonial_template_section', function( section ) {
        section.expanded.bind( function( isExpanded ) {
            if ( isExpanded ) {
                wp.customize.previewer.previewUrl.set( tb_customizer_data.url4  );
            }
        } );
    } );

    // Scroll to homepage section
    $('body').on('click', '#sub-accordion-panel-home_page_setting .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToHomePageSection( section_id );
    });

    // Scroll to about page section
    $('body').on('click', '#sub-accordion-panel-about_page_setting .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToAboutPageSection( section_id );
    });
    
    // Scroll to team page section
    $('body').on('click', '#sub-accordion-panel-team_page_setting .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToTeamPageSection( section_id );
    });
});

function scrollToHomePageSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-header_image':
        preview_section_id = "banner-section";
        break;

        case 'accordion-section-search_section':
        preview_section_id = "search-section";
        break;

        case 'accordion-section-sidebar-widgets-about':
        preview_section_id = "about-section";
        break;

        case 'accordion-section-popular_section':
        preview_section_id = "popular-section";
        break;

        case 'accordion-section-sidebar-widgets-cta-one':
        preview_section_id = "cta-one-section";
        break;

        case 'accordion-section-featured_section':
        preview_section_id = "featured-trip-section";
        break;

        case 'accordion-section-deal_section':
        preview_section_id = "deals-section";
        break;

        case 'accordion-section-destination_section':
        preview_section_id = "destination-section";
        break;

        case 'accordion-section-sidebar-widgets-cta-two':
        preview_section_id = "cta-two-section";
        break;

        case 'accordion-section-activities_section':
        preview_section_id = "activities-section";
        break;

        case 'accordion-section-testimonial_section':
        preview_section_id = "testimonials-section";
        break;

        case 'accordion-section-blog_section':
        preview_section_id = "blog-section";
        break;

        case 'accordion-section-sidebar-widgets-client':
        preview_section_id = "clients-section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

function scrollToAboutPageSection( section_id ){
    var preview_section_id = "about-intro-section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-sidebar-widgets-about-intro':
        preview_section_id = "about-intro-section";
        break;

        case 'accordion-section-sidebar-widgets-about-client':
        preview_section_id = "about-clients-section";
        break;

        case 'accordion-section-sidebar-widgets-about-service':
        preview_section_id = "about-our-services-section";
        break;

        case 'accordion-section-about_testimonial_section':
        preview_section_id = "about-testimonial-section";
        break;

        case 'accordion-section-about_team_section':
        preview_section_id = "about-team-section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.page-template-about').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}


function scrollToTeamPageSection( section_id ){
    var preview_section_id = "core-member-section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-core_members_team_section':
        preview_section_id = "core-member-section";
        break;

        case 'accordion-section-our_team_section':
        preview_section_id = "our-team-section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.page-template-team').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}
