/**
 * Scripts within the customizer controls window.
 *
 */

jQuery( document ).ready(function($) {

    // icon picker
    $('.pet-care-icon-picker').each( function() {
        $(this).iconpicker( '#' + this.id );
    } );

});

