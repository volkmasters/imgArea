<script>
	if(typeof jQuery == "undefined")
	{
		document.write('<script type="text\/javascript" src="[[+jsUrl]]jquery-2.1.1.min.js" ><\/script>');
	}
</script>

<script>
	if(typeof $.fn.mapster == "undefined")
	{
		document.write('<script type="text\/javascript" src="[[+jsUrl]]web/jquery.imagemapster.min.js" ><\/script>');
	}
</script>


[[+easyTooltip:is=`1`:then=`
	<script>
		if(typeof $.fn.easyTooltip == "undefined")
		{
			document.write('<script type="text\/javascript" src="[[+jsUrl]]web/jquery.easyTooltip.js" ><\/script>');
		}

		$(document).ready(function(e)
		{
			$('#map_imgArea[[+id]] area').easyTooltip(); // всплывающие подсказки
		});
	</script>

	<style>
		#easyTooltip {
			width: auto;
			min-width: 10px;
			max-width: 250px;
			background: #fcfcfc;
			border: 1px solid #e1e1e1;
			margin: 0 10px 1em 0;
			padding: 8px;
			font-size: 90%;
			line-height: 130%;
		}
	</style>
`:else=` `]]


<script>
	$(window).on('load resize', function(e)
	{
		var textBlock = '[[+textBlock]]',
			textBlockShowHide = '[[+textBlockShowHide]]';

		$('#img_imgArea[[+id]]').mapster(
		{
			mapKey: 'data-key',
			isSelectable: false, // выделять при клике?

			areas: [[+areas_opts]],

			fill: [[+bg]], // фон
			fillColor: "[[+bgColor]]", // цвет фона
			fillOpacity: "[[+bgOpacity]]", // прозрачность фона
			stroke: [[+border]], // бордер
			strokeWidth: "[[+borderWidth]]", // ширина бордера
			strokeColor: "[[+borderColor]]", // цвет бордера
			strokeOpacity: "[[+borderOpacity]]", // прозрачность фона
			staticState: [[+defaultSelect]], // выделить по-умолчанию без наведения


			onMouseover: function(obj)
			{
				var alt = obj.e.currentTarget.alt;

				if( textBlock != '' && alt != '' )
				{
					$(textBlock).html( alt );

					if(textBlockShowHide != 0 && textBlockShowHide != 'false')
					{
						$(textBlock).show();
					}
				}
			},
			onMouseout: function(obj)
			{
				if(textBlock != '')
				{
					$(textBlock).html('');

					if(textBlockShowHide != 0 && textBlockShowHide != 'false')
					{
						$(textBlock).hide();
					}
				}
			},

			onClick: function(obj)
			{
				var target = "",
					href = "",
					alt = "",
					title = "";

				href = !obj.e.currentTarget.dataset.hasOwnProperty('href') ? '' : obj.e.currentTarget.dataset.href;
				//href != '' && console.log( href )

				target = !obj.e.currentTarget.dataset.hasOwnProperty('target') ? '' : obj.e.currentTarget.dataset.target;
				//target != '' && console.log( target )

				if( href != '' && href != '#' )
				{
					if (/^javascript:.*/i.exec(href)) {
						// console.log(href)
						eval(href)
					} else {
						if(target == '_blank') {
							window.open(href, '_blank');
						}
						else if(target == '_self') {
							window.open(href, '_self');
						}
					}
				}
			}
		});
	});
</script>