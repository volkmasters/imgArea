(function () {
    function imgAreaHandler(config) {
        if (typeof config['id'] == 'undefined') {
            console.error('[imgArea] Id not found!');
            return;
        }

        this.config = config;
        this.running = false;
        var self = this;

        this.positionPrepare = function (axis, int) {
            if (!self.config['imgBackgroundPosition']) {
                return '0';
            }

            var pos = self.config['imgBackgroundPosition'].split(' ');
            if (axis == 'x' && pos[0]) {
                pos = pos[0];
            } else if (axis == 'y' && pos[1]) {
                pos = pos[1];
            } else {
                return '0';
            }

            // Процент
            if (pos.indexOf('%') !== -1) {
                return '-' + (int * parseFloat(pos.replace('%', '')) / 100) + 'px';
            }
            // Пиксели
            else if (pos.indexOf('px') !== -1) {
                return pos;
            }
            // Слева
            else if (pos == 'left') {
                return '0';
            }
            // Справа
            else if (pos == 'right') {
                return '-' + int + 'px';
            }
            // По-центру
            else if (pos == 'center') {
                return '-' + (int / 2) + 'px';
            }
        };

        this.imgResize = function ($img, $wrap) {
            var curWrapWidth = $wrap.width();
            var curWrapHeight = $wrap.height();
            var curImgWidth = $img.width();
            var curImgHeight = $img.height();
            var width = 0;
            var height = 0;

            // Блок портретный / Изображение альбомное
            if (curWrapWidth < curWrapHeight && curImgWidth > curImgHeight) {
                height = curWrapHeight;
            }
            // Блок альбомный / Изображение портретное
            else if (curWrapWidth > curWrapHeight && curImgWidth < curImgHeight) {
                width = curWrapWidth;
            }
            // Блок портретный / Изображение портретное или Блок альбомный / Изображение альбомное
            else if (
                (curWrapWidth < curWrapHeight && curImgWidth < curImgHeight) ||
                (curWrapWidth >= curWrapHeight && curImgWidth >= curImgHeight)
            ) {
                // Ширина блока больше ширины изображения и высота блока меньше или равна высоте изображения
                if (curWrapWidth > curImgWidth && curWrapHeight <= curImgHeight) {
                    width = curWrapWidth;
                }
                // Высота блока больше или равна высоте изображения
                else if (curWrapHeight >= curImgHeight) {
                    height = curWrapHeight;
                } else {
                    width = curWrapWidth;
                }
            }

            // Делаем ресайз изображения средствами imageMapster
            $img.mapster('resize', width, height, 0, function () {
                var curWrapWidth = $wrap.width();
                var curWrapHeight = $wrap.height();
                var curImgWidth = $img.width();
                var curImgHeight = $img.height();

                var marginLeft = self.positionPrepare('x', (curImgWidth - curWrapWidth));
                var marginTop = self.positionPrepare('y', (curImgHeight - curWrapHeight));

                $img.parent().css({
                    marginLeft: marginLeft,
                    marginTop: marginTop,
                });
            });
        };

        this.initialize = function () {
            var tmp = {
                id: self.config['id'],
                mapKey: self.config['mapKey'],
                isSelectable: self.config['isSelectable'],
                areas: self.config['areas'],
                fill: self.config['fill'],
                fillColor: self.config['fillColor'],
                fillOpacity: self.config['fillOpacity'],
                stroke: self.config['stroke'],
                strokeWidth: self.config['strokeWidth'],
                strokeColor: self.config['strokeColor'],
                strokeOpacity: self.config['strokeOpacity'],
                staticState: self.config['staticState'],
                imgBackgroundSize: self.config['imgBackgroundSize'],
                imgBackgroundPosition: self.config['imgBackgroundPosition'],
                textBlockShowHide: self.config['textBlockShowHide'],
                selectors: {
                    img: '#img_imgArea' + self.config['id'],
                    map: '#map_imgArea' + self.config['id'],
                    textBlock: self.config['textBlock'],
                },
            };
            if (typeof self.config['selectors'] != 'undefined') {
                for (var i in self.config['selectors']) {
                    if (self.config.selectors.hasOwnProperty(i)) {
                        tmp.selectors[i] = self.config.selectors[i];
                    }
                }
            }
            self.config = tmp;
        };

        this.run = function () {
            if (!self.running) {
                var isCover = false;
                var events = ['load'];
                if (self.config['imgBackgroundSize'] != 'cover') {
                    events.push('resize');
                } else {
                    isCover = true;
                }

                $(window).on(events.join(' '), function () {
                    var $img = $(self.config.selectors['img']);
                    var $wrap = $('<div style="max-width: 100%; height: 100%; overflow: hidden;"></div>')
                        .insertAfter($img)
                        .prepend($img);

                    // var baseWrapWidth = $wrap.width();
                    // var baseWrapHeight = $wrap.height();
                    // var baseImgWidth = $img.width();
                    // var baseImgHeight = $img.height();

                    $($img).mapster({
                        mapKey: self.config['mapKey'],
                        isSelectable: self.config['isSelectable'],
                        areas: self.config['areas'],
                        fill: self.config['fill'],
                        fillColor: self.config['fillColor'],
                        fillOpacity: self.config['fillOpacity'],
                        stroke: self.config['stroke'],
                        strokeWidth: self.config['strokeWidth'],
                        strokeColor: self.config['strokeColor'],
                        strokeOpacity: self.config['strokeOpacity'],
                        staticState: self.config['staticState'],

                        onConfigured: function (success) {
                            if (success) {
                                if (isCover) {
                                    self.imgResize($img, $wrap);

                                    // При смене размеров окна
                                    window.addEventListener('resize', function () {
                                        self.imgResize($img, $wrap);
                                    });
                                }
                            }
                        },

                        onMouseover: function (obj) {
                            var alt = obj.e.currentTarget.alt;

                            if (self.config.selectors['textBlock'] != '' && alt != '') {
                                $(self.config.selectors['textBlock']).html(alt);

                                if (self.config['textBlockShowHide'] != 0 && self.config['textBlockShowHide'] != 'false') {
                                    $(self.config.selectors['textBlock']).show();
                                }
                            }
                        },

                        onMouseout: function (obj) {
                            if (self.config.selectors['textBlock'] != '') {
                                $(self.config.selectors['textBlock']).html('');

                                if (self.config['textBlockShowHide'] != 0 && self.config['textBlockShowHide'] != 'false') {
                                    $(self.config.selectors['textBlock']).hide();
                                }
                            }
                        },

                        onClick: function (obj) {
                            var target = "";
                            var href = "";
                            var alt = "";
                            var title = "";

                            href = !obj.e.currentTarget.dataset.hasOwnProperty('href') ? '' : obj.e.currentTarget.dataset.href;
                            //href != '' && console.log( href )

                            target = !obj.e.currentTarget.dataset.hasOwnProperty('target') ? '' : obj.e.currentTarget.dataset.target;
                            //target != '' && console.log( target )

                            if (href != '' && href != '#') {
                                if (/^javascript:.*/i.exec(href)) {
                                    // console.log(href)
                                    eval(href)
                                } else {
                                    if (target == '_blank') {
                                        window.open(href, '_blank');
                                    } else if (target == '_self') {
                                        window.open(href, '_self');
                                    }
                                }
                            }
                        },
                    });
                });

                self.running = true;
            }
        };

        this.initialize();
        this.run();
    }

    window.imgAreaHandler = imgAreaHandler;
})();