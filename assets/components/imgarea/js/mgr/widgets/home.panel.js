imgArea.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'imgarea-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('imgarea') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('imgarea_items'),
				layout: 'anchor',
				items: [{
					html: _('imgarea_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'imgarea-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	imgArea.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(imgArea.panel.Home, MODx.Panel);
Ext.reg('imgarea-panel-home', imgArea.panel.Home);






//Ext.BLANK_IMAGE_URL = '/assets/components/imgarea/img/_blank.png'
Ext.BLANK_IMAGE_URL = ''

Ext.ux.Image = Ext.extend(Ext.Component, {
	url: Ext.BLANK_IMAGE_URL,  //for initial src value
	autoEl: {
		tag: 'img',
		src: Ext.BLANK_IMAGE_URL,
		cls: 'tng-managed-image',
		width: 166
		//,height: 100
	}
//  Add our custom processing to the onRender phase.
//  We add a ‘load’ listener to our element.
	,onRender: function() {
		Ext.ux.Image.superclass.onRender.apply(this, arguments);
		this.el.on('load', this.onLoad, this);
		this.el.on('click', this.onClick, this);
		if(this.url)
		{
			this.setSrc(this.url);
		}
	}
	,onLoad: function() {
		this.fireEvent('load', this);
	}
	,onClick: function() {
		window.open(this.el.dom.getAttribute('data-link'));
	}
	,setSrc: function(src, source, width, height) {
		if (src == '' || src == undefined) {
			this.el.dom.src = Ext.BLANK_IMAGE_URL;
			Ext.getCmp('currimg').hide();
		}
		else {
			if (!source) {source = MODx.config.imgarea_media_source || MODx.config.default_media_source;}
			if (!height) {height = 200;}
			if (!width) {width = 166;}

			this.el.dom.src = MODx.config.connectors_url +'system/phpthumb.php?src='+ src +'&w='+ width +'&f=jpg&q=90&HTTP_MODAUTH='+ MODx.siteId +'&far=1&wctx=mgr&source='+ source;
			this.el.dom.setAttribute('data-link', '/' + src.replace(MODx.config.base_path, ''));

			Ext.getCmp('currimg').show();
		}
	}
});
Ext.reg('image', Ext.ux.Image);



imgArea.renderGridImage = function(img) {
	var height = MODx.modx23
		? 45
		: 40;

	if (img.length > 0) {
		if (!/(jpg|jpeg|png|gif|bmp)$/.test(img.toLowerCase())) {
			return img;
		}
		else if (/^(http|https)/.test(img)) {
			return '<img src="'+ img +'" alt="" />'
		}
		else {
			return '<img src="'+ MODx.config.connectors_url +'system/phpthumb.php?&src='+ img +'&wctx=web&h='+ height +'&zc=0" alt="" />'
		}
	}
	else {
		return '';
	}
}