<div id="imgarea-panel-areas-div"></div>


<script type="text/javascript">
	if(typeof noty == "undefined")
	{
		document.write('\
			<link rel="stylesheet" type="text\/css" href="'+ imgArea.config.jsUrl +'mgr/lib/noty/animate.css">\
			<script src="'+ imgArea.config.jsUrl +'mgr/lib/noty/jquery.noty.packaged.min.js"><\/script>\
		');
	}
</script>

<script type="text/javascript">
	$(document).ready(function ()
	{
		if(typeof noty != "undefined")
		{
			noty_generate = function( type, text, timeout )
			{
				var n = noty({
					text			: text,
					type			: type,
					dismissQueue	: true,
					layout			: 'topRight',
					closeWith		: ['click'],
					timeout			: timeout,
					theme			: 'defaultTheme', // or "relax"
					maxVisible		: 10,
					animation		: {
						open	: 'animated flipInX',
						close	: 'animated flipOutX',
						easing	: 'swing',
						speed	: 500
					}
				});
			}
		}
	});
</script>


<script>
	console.log( MODx )
	console.log( MODx.config )
	console.log( imgArea )
</script>

{* Изображение из базы дёргаем *}
{$image = $modx->getObject('imgAreaItem', $smarty.get.id)->get('image')}


<div id="wrapper">
	<div id="header">
		<nav id="nav" class="clearfix">
			<ul>
				<li class="display_none" id="save"><a href="#">save</a></li>
				<li class="display_none" id="load"><a href="#">load</a></li>
				<li class="display_none" id="to_html"><a href="#">to html</a></li>
				<li class="display_none" id="preview"><a href="#">preview</a></li>
				<li class="display_none" id="new_image"><a href="#">new image</a></li>

				<li class="" id="from_html"><a href="#"><span class="icon icon-code"></span> Из HTML</a></li>
				<li class="separator">-</li>
				<li class="" id="rect"><a href="#">Прямоугольник</a></li>
				<li class="" id="circle"><a href="#">Круг</a></li>
				<li class="" id="polygon"><a href="#">Произвольная фигура</a></li>
				<li class="separator">-</li>
				<li class="" id="edit"><a href="#"><span class="icon icon-pencil"></span> Править</a></li>
				<li id="my_getcode"><a href="#"><span class="icon icon-asterisk"></span> Сохранить</a></li>
				<li class="separator">-</li>
				<li id="clear"><a href="#"><span class="icon icon-eraser"></span> Очистить</a></li>
				<li class="separator">-</li>
				<li class="" id="show_help"><a href="#"><span class="icon icon-info"></span></a></li>
			</ul>
		</nav>
		<div id="coords"></div>
		<div id="debug"></div>
	</div>
		<div id="image_wrapper">
			<div id="image">
				<img src="" alt="#" id="img" />
				<svg xmlns="http://www.w3.org/2000/svg" version="1.2" baseProfile="tiny" id="svg"></svg>
			</div>
		</div>
</div>

<!-- For html image map code -->
<div id="code">
	<span class="close_button" title="close"></span>
	<div id="code_content"></div>
</div>


<!-- >> Edit details block -->
<form id="edit_details">
	<span class="close_button" title="close"></span>
	<h5>Настройки области</h5>

	<div class="blockWrapper">
		<div class="label_block">
			<div>
				<label for="href_attr">Ссылка</label>
			</div>
			<input type="text" id="href_attr" />
		</div>
		<div class="label_block">
			<div>
				<label for="target_attr">
					<input type="checkbox" id="target_attr" value="1" class="display_inline_block vertical_middle" />
					<span class="display_inline_block vertical_middle">Открывать в новой вкладке</span>
				</label>
			</div>
		</div>
		<div class="label_block">
			<div>
				<label for="alt_attr">Текст для Tooltip</label>
			</div>
			<!--input type="text" id="alt_attr" /-->
			<textarea id="alt_attr" rows="4"></textarea>
		</div>
		<div class="label_block display_none">
			<div>
				<label for="title_attr">title</label>
			</div>
			<input type="text" id="title_attr" />
		</div>
		<div class="label_block">
			<div>
				<label for="active_attr">
					<input type="checkbox" id="active_attr" value="1" class="display_inline_block vertical_middle" />
					<span class="display_inline_block vertical_middle">Активная область</span>
				</label>
			</div>
		</div>

		<div class="label_block">
			<a href="javascript:;" id="areaViewLink1" class="area_view hide">Внешний вид основной <span class="icon"></span></a>

			<div id="areaViewBlock1" class="areaViewBlock">
				<div style="text-align:left; margin:0 0 2px 3px;">
					<b style="font-size:104%;">Фон:</b>
				</div>
				<div class="block50">
					<div class="label_block">
						<div>
							<label for="fillColor1_attr">Цвет</label>
						</div>
						<input type="text" id="fillColor1_attr" placeholder="от ffffff до 000000" />
					</div>
				</div>
				<div class="block50">
					<div class="label_block">
						<div>
							<label for="fillOpacity1_attr">Прозрачность</label>
						</div>
						<input type="text" id="fillOpacity1_attr" placeholder="от 0.0 до 1.0" />
					</div>
				</div>
				<div class="clear"></div>

				<div class="separator"></div>
				<div class="margin_bottom_10px"></div>

				<div style="text-align:left; margin:0 0 2px 3px;">
					<b style="font-size:104%;">Рамка:</b>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeWidth1_attr">Толщина</label>
						</div>
						<input type="text" id="strokeWidth1_attr" placeholder="от 0 до 999" />
					</div>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeColor1_attr">Цвет</label>
						</div>
						<input type="text" id="strokeColor1_attr" placeholder="от ffffff до 000000" />
					</div>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeOpacity1_attr">Прозрачность</label>
						</div>
						<input type="text" id="strokeOpacity1_attr" placeholder="от 0.0 до 1.0" />
					</div>
				</div>
				<div class="clear"></div>

				<div class="separator"></div>
				<div class="margin_bottom_10px"></div>

				<div class="label_block margin_bottom_0px">
					<div>
						<label for="staticState1_attr">
							<input type="checkbox" id="staticState1_attr" value="1" class="display_inline_block vertical_middle" />
							<b class="display_inline_block vertical_middle">Подсветить по-умолчанию</b>
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="label_block">
			<a href="javascript:;" id="areaViewLink3" class="area_view hide">Внешний вид области при наведении <span class="icon"></span></a>

			<div id="areaViewBlock3" class="areaViewBlock">
				<div style="text-align:left; margin:0 0 2px 3px;">
					<b style="font-size:104%;">Фон:</b>
				</div>
				<div class="block50">
					<div class="label_block">
						<div>
							<label for="fillColor3_attr">Цвет</label>
						</div>
						<input type="text" id="fillColor3_attr" placeholder="от ffffff до 000000" />
					</div>
				</div>
				<div class="block50">
					<div class="label_block">
						<div>
							<label for="fillOpacity3_attr">Прозрачность</label>
						</div>
						<input type="text" id="fillOpacity3_attr" placeholder="от 0.0 до 1.0" />
					</div>
				</div>
				<div class="clear"></div>

				<div class="separator"></div>
				<div class="margin_bottom_10px"></div>

				<div style="text-align:left; margin:0 0 2px 3px;">
					<b style="font-size:104%;">Рамка:</b>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeWidth3_attr">Толщина</label>
						</div>
						<input type="text" id="strokeWidth3_attr" placeholder="от 0 до 999" />
					</div>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeColor3_attr">Цвет</label>
						</div>
						<input type="text" id="strokeColor3_attr" placeholder="от ffffff до 000000" />
					</div>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeOpacity3_attr">Прозрачность</label>
						</div>
						<input type="text" id="strokeOpacity3_attr" placeholder="от 0.0 до 1.0" />
					</div>
				</div>
				<div class="clear"></div>

				<div class="display_none separator"></div>
				<div class="display_none margin_bottom_10px"></div>

				<div class="display_none label_block margin_bottom_0px">
					<div>
						<label for="staticState3_attr">
							<input type="checkbox" id="staticState3_attr" value="1" class="display_inline_block vertical_middle" />
							<b class="display_inline_block vertical_middle">Подсветить по-умолчанию</b>
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="label_block">
			<a href="javascript:;" id="areaViewLink2" class="area_view hide">Внешний вид области подсвеченной по-умолчанию <span class="icon"></span></a>

			<div id="areaViewBlock2" class="areaViewBlock">
				<div style="text-align:left; margin:0 0 2px 3px;">
					<b style="font-size:104%;">Фон:</b>
				</div>
				<div class="block50">
					<div class="label_block">
						<div>
							<label for="fillColor2_attr">Цвет</label>
						</div>
						<input type="text" id="fillColor2_attr" placeholder="от ffffff до 000000" />
					</div>
				</div>
				<div class="block50">
					<div class="label_block">
						<div>
							<label for="fillOpacity2_attr">Прозрачность</label>
						</div>
						<input type="text" id="fillOpacity2_attr" placeholder="от 0.0 до 1.0" />
					</div>
				</div>
				<div class="clear"></div>

				<div class="separator"></div>
				<div class="margin_bottom_10px"></div>

				<div style="text-align:left; margin:0 0 2px 3px;">
					<b style="font-size:104%;">Рамка:</b>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeWidth2_attr">Толщина</label>
						</div>
						<input type="text" id="strokeWidth2_attr" placeholder="от 0 до 999" />
					</div>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeColor2_attr">Цвет</label>
						</div>
						<input type="text" id="strokeColor2_attr" placeholder="от ffffff до 000000" />
					</div>
				</div>
				<div class="block33">
					<div class="label_block">
						<div>
							<label for="strokeOpacity2_attr">Прозрачность</label>
						</div>
						<input type="text" id="strokeOpacity2_attr" placeholder="от 0.0 до 1.0" />
					</div>
				</div>
				<div class="clear"></div>

				<div class="display_none separator"></div>
				<div class="display_none margin_bottom_10px"></div>

				<div class="display_none label_block margin_bottom_0px">
					<div>
						<label for="staticState2_attr">
							<input type="checkbox" id="staticState2_attr" value="1" class="display_inline_block vertical_middle" />
							<b class="display_inline_block vertical_middle">Подсветить по-умолчанию</b>
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="clear"></div>
		<div class="button">
			<button id="save_details">Применить</button>
		</div>
		<div class="after_button"><span class="icon icon-info-circle"></span> Не забудьте применить изменения!</div>
		<div class="clear"></div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function()
	{
		// >> Показываем/скрываем блоки с настройкой вида области
		var sel_areaViewLink = '.area_view';
		var sel_areaViewBlock = '.areaViewBlock';

		// функция показа/скрытия блока ВВ
		var areaViewDisplay = function( link, block, action )
		{
			if( action == 'show' ) {
				$(link)
					.removeClass('hide')
					.addClass('show');

				$(block).show();
			}
			else if( action == 'hide' ) {
				$(link)
					.removeClass('show')
					.addClass('hide');

				$(block).hide();
			}
		}

		// показываем/скрываем блок ВВ при клике на ссылку
		$(sel_areaViewLink).on('click', function()
		{
			if( $(this).hasClass('hide') )
			{
				areaViewDisplay( this, $(this).parent().find(sel_areaViewBlock), 'show' );
			}
			else {
				areaViewDisplay( this, $(this).parent().find(sel_areaViewBlock), 'hide' );
			}
		});

		// скрываем блоки ВВ при клике вне формы
		$(document).on('click', function(e)
		{
			if( $(e.target).closest("#edit_details").length )
				return;

			areaViewDisplay( sel_areaViewLink, sel_areaViewBlock, 'hide' );
		});
		// << Показываем/скрываем блоки с настройкой вида области
	});
</script>
<!-- << Edit details block -->


<!-- From html block -->
<div id="from_html_wrapper">
	<form id="from_html_form">
		<h5>Loading areas</h5>
		<span class="close_button" title="close"></span>
		<p>
			<label for="code_input">Enter your html code:</label>
			<textarea id="code_input"></textarea>
		</p>
		<button id="load_code_button">Load</button>
	</form>
</div>

<!-- Get image form -->
<div style="display:none" id="get_image_wrapper">
	<div id="get_image">
		<div id="loading">Loading</div>
		<div id="file_reader_support">
			<label>Drag an image</label>
			<div id="dropzone">
				<span class="clear_button" title="clear">x</span>
				<img src="" alt="preview" id="sm_img" />
			</div>
			<b>or</b>
		</div>
		<label for="url">type a url</label>
		<span id="url_wrapper">
			<span class="clear_button" title="clear">x</span>
			<input type="text" id="url" value="" />
		</span>
		<button id="button">OK</button>
	</div>
</div>


<script>
	$(document).ready(function()
	{
		setTimeout(function()
		{
			$('#url').val("/{$image}"); // ставим изображение
			$('#button').trigger('click'); // кликаем по кнопке, для работы с ним


			// >> Подгружаем наши area из базы
			Ext.onReady(function()
			{
				MODx.Ajax.request({
					url: imgArea.config.connector_url,
					params: {
						action: 'mgr/item/get',
						id: "{$smarty.get.id}",
					},
					listeners: {
						success: {
							fn: function (r) {
								//console.log( 'success' );
								//console.log( r );
								//console.log( r.object.areas );

								$('#code_input').val( r.object.areas );
								$('#load_code_button').trigger('click');
							}, scope: this
						},
						error: {
							fn: function (r) {
								console.log( 'error' );
								console.log( r );
							}, scope: this
						}
					}
				});
			});
			// << Подгружаем наши area из базы
		}, 100);


		$('#my_getcode').on('click', function()
		{
			$('#to_html').trigger('click');

			var html_areas = $('#code_content').text();

			html_areas = html_areas == '0 objects' ? '' : html_areas;

			$('#textarea').val( html_areas );
			$('.close_button').trigger('click');


			MODx.Ajax.request({
				url: imgArea.config.connector_url,
				params: {
					action: 'mgr/item/areasave',
					id: "{$smarty.get.id}",
					html: html_areas,
				},
				listeners: {
					success: {
						fn: function (r) {
							//console.log( 'success' );
							console.log( r );

							if( r.success )
							{
								if( typeof noty != 'undefined' )
								{
									noty_generate( 'success', 'Успешно сохранено!', 7000 );
								}
							}
						}, scope: this
					},
					error: {
						fn: function (r) {
							console.log( 'error' );
							console.log( r );
						}, scope: this
					}
				}
			});

			return false;
		});

	});
</script>

<!-- Help block -->
<div id="overlay"></div>

<div id="help">
	<span class="close_button" title="close"></span>
	<div class="txt">
		<section>
			<h2>Main</h2>
			<p><span class="key">F5</span> &mdash; reload the page and display the form for loading image again</p>
			<p><span class="key">S</span> &mdash; save map params in localStorage</p>
		</section>
		<section>
			<h2>Drawing mode (rectangle / circle / polygon)</h2>
			<p><span class="key">ENTER</span> &mdash; stop polygon drawing (or click on first helper)</p>
			<p><span class="key">ESC</span> &mdash; cancel drawing of a new area</p>
			<p><span class="key">SHIFT</span> &mdash; square drawing in case of a rectangle and right angle drawing in case of a polygon</p>
		</section>
		<section>
		<h2>Editing mode</h2>
			<p><span class="key">DELETE</span> &mdash; remove a selected area</p>
			<p><span class="key">ESC</span> &mdash; cancel editing of a selected area</p>
			<p><span class="key">SHIFT</span> &mdash; edit and save proportions for rectangle</p>
			<p><span class="key">I</span> &mdash; edit attributes of a selected area (or dblclick on an area)</p>
			<p><span class="key">CTRL</span> + <span class="key">C</span> &mdash; a copy of the selected area</p>
			<p><span class="key">&uarr;</span> &mdash; move a selected area up</p>
			<p><span class="key">&darr;</span> &mdash; move a selected area down</p>
			<p><span class="key">&larr;</span> &mdash; move a selected area to the left</p>
			<p><span class="key">&rarr;</span> &mdash; move a selected area to the right</p>
		</section>
	</div>
	<footer>
		<a href="http://github.com/summerstyle/summer">Summer html image map creator 0.5</a><br />
		&copy; 2014 Vera Lobatcheva<br />
		GPL3 License
	</footer>
</div>