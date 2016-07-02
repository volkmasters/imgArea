document.write('<link rel="stylesheet" type="text/css" href="' + miniShop2Config.jsUrl + 'lib/noty/animate.css"><script src="' + miniShop2Config.jsUrl + 'lib/noty/jquery.noty.packaged.min.js"><\/script><script src="' + miniShop2Config.jsUrl + 'lib/noty/notification_html.js"><\/script>');

function generate( type, text )
{
	var n = noty({
		text			: text,
		type			: type,
		dismissQueue	: true,
		layout			: 'topLeft',
		closeWith		: ['click'],
		theme			: 'relax',
		maxVisible		: 10,
		animation		: {
			open	: 'animated bounceInLeft',
			close	: 'animated bounceOutLeft',
			easing	: 'swing',
			speed	: 500
		}
	});
	//console.log('html: ' + n.options.id);
}