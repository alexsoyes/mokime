/**
 *
 */
var $navbar       = document.getElementById( 'navbar' );
var $navbarButton = document.getElementById( 'navbar-button' );

var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;

if (width <= 1023) {
	$navbarButton.addEventListener(
		'click',
		function() {
			menuToggle();
		}
	);
}

function menuToggle() {
	if ($navbarButton.classList.contains( 'is-active' )) {
		menuClose();
	} else {
		menuOpen();
	}
}

function menuOpen() {
	$navbar.classList.add( 'is-active' );
	$navbarButton.classList.add( 'is-active' )
}

function menuClose() {
	$navbar.classList.remove( 'is-active' );
	$navbarButton.classList.remove( 'is-active' )
}

WebFontConfig = {
	google: { families: [ 'Roboto:300,500,900:latin' ] }
};

(function(d) {
	var wf   = d.createElement( 'script' ), s = d.scripts[0];
	wf.src   = '/wp-content/themes/mokime/assets/js/webfontloader.js?ver=1.6.28';
	wf.async = true;
	s.parentNode.insertBefore( wf, s );
})( document );
