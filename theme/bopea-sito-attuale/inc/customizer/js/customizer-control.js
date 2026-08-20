jQuery( document ).ready( function($) {
	"use strict";
	$( '.jlc-image-select input' ).on( 'change', function () {
		var $this = $( this ), type = $this.attr( 'type' ), selected = $this.is( ':checked' ), $parent = $this.parent(), $others = $parent.siblings();
		if ( selected ) {
			$parent.addClass( 'asw-active' );
			if ( type === 'radio' ) { $others.removeClass( 'asw-active' ); }
		}else{
            $parent.removeClass( 'asw-active' );
        }
	});
	$( '.jlc-image-select input' ).trigger( 'change' );
});