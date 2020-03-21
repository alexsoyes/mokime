/**
 * Display the menu for mobile device.
 *
 * @package mokime
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


function loadJS(d, src) {
	var wf   = d.createElement( 'script' ), s = d.scripts[0];
	wf.src   = src;
	wf.async = true;
	s.parentNode.insertBefore( wf, s );
}

function loadCSS(d, src) {
	var wf  = d.createElement( 'link' ), s = d.scripts[0];
	wf.href = src;
	wf.rel  = "stylesheet";
	s.parentNode.insertBefore( wf, s );
}

(function(d) {
	loadCSS( d, 'https://fonts.googleapis.com/css?family=Roboto:300,500,900&display=swap' );
})( document );
