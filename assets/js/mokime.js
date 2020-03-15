/**
 * Toggle the mobile menu
 *
 * @param el HTMLElement the burger menu
 */
function toggleMobileMenu(el) {
	// Get the target from the "data-target" attribute.
	var target  = el.dataset.target;
	var $target = document.getElementById( target );

	// Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu".
	el.classList.toggle( 'is-active' );
	$target.classList.toggle( 'is-active' );
}

WebFontConfig = {
	google: { families: [ 'Roboto:300,400,400i,500,900:latin' ] }
};

(function(d) {
	var wf   = d.createElement( 'script' ), s = d.scripts[0];
	wf.src   = '/wp-content/themes/mokime/assets/js/webfontloader.js?ver=1.6.28';
	wf.async = true;
	s.parentNode.insertBefore( wf, s );
})( document );
