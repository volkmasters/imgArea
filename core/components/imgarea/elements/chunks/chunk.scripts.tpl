<script>
    if (typeof jQuery == "undefined") {
        document.write('<script type="text\/javascript" src="[[+jsUrl]]jquery-2.1.1.min.js" ><\/script>');
    }
</script>

<script>
    if (typeof $.fn.mapster == "undefined") {
        document.write('<script type="text\/javascript" src="[[+jsUrl]]web/libs/jquery.imagemapster.min.js" ><\/script>');
    }
</script>


[[+easyTooltip:is=`1`:then=`
<script>
    if (typeof $.fn.easyTooltip == "undefined") {
        document.write('<script type="text\/javascript" src="[[+jsUrl]]web/libs/jquery.easyTooltip.js" ><\/script>');
    }

    $(document).ready(function () {
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

<script type="text/javascript">
    if (typeof window.imgAreaHandler == 'undefined') {
        document.write('<script type="text/javascript" src="[[+jsUrl]]web/libs/imgarea.handler.js" ></' + 'script>');
    }
</script>


<script>
    if (typeof imgAreaHandlers == 'undefined') {
        imgAreaHandlers = {
            /* */
        };
    }
    imgAreaHandlers[[[+id]]] = new imgAreaHandler({
        id: [[+id]],
        textBlock: '[[+textBlock]]',
        textBlockShowHide: '[[+textBlockShowHide]]',
        mapKey: 'data-key',
        isSelectable: false, // выделять при клике
        areas: [[+areas_opts]],
        fill: [[+bg]], // фон
        fillColor: "[[+bgColor]]", // цвет фона
        fillOpacity: "[[+bgOpacity]]", // прозрачность фона
        stroke: [[+border]], // бордер
        strokeWidth: "[[+borderWidth]]", // ширина бордера
        strokeColor: "[[+borderColor]]", // цвет бордера
        strokeOpacity: "[[+borderOpacity]]", // прозрачность фона
        staticState: [[+defaultSelect]], // выделить по-умолчанию без наведения
        imgBackgroundSize: '[[+imgBackgroundSize]]',
        imgBackgroundPosition: '[[+imgBackgroundPosition]]',
    });
</script>