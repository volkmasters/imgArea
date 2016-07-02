imgArea.window.CreateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'imgarea-item-window-create';
	}
	Ext.applyIf(config, {
		title: _('imgarea_item_create'),
		width: 600,
		autoHeight: true,
		modal: true,
		url: imgArea.config.connector_url,
		action: 'mgr/item/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	imgArea.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(imgArea.window.CreateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'image',
			anchor: '100%',
			id: 'image',
		}, {
			xtype: 'textfield',
			fieldLabel: _('imgarea_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '100%',
			allowBlank: false,
		}, {
			items: [{
				layout: 'column',
				border: false,
				items: [{
					columnWidth: .67,
					border: false,
					layout: 'form',
					//style: 'margin-right: 5px;',
					items: [{
						xtype: 'modx-combo-browser',
						fieldLabel: _('imgarea_item_image'),
						name: 'newimage',
						id: config.id + '-newimage',
						anchor: '100%',
						allowBlank: false,
						hideFiles: true,
						source: MODx.config.imgarea_media_source || MODx.config.default_media_source,
						openTo: config.openTo || '/',
						hideSourceCombo: true,
						listeners: imgArea.fieldsImageListeners,
					}, {
						xtype: 'textarea',
						fieldLabel: _('imgarea_item_description'),
						name: 'description',
						id: config.id + '-description',
						height: 70,
						anchor: '100%',
					}, {
						xtype: 'xcheckbox',
						boxLabel: _('imgarea_item_active'),
						name: 'active',
						id: config.id + '-active',
						checked: true,
					}]
				}, {
					columnWidth: .33,
					border: false,
					layout: 'form',
					style: 'text-align:center;',
					items: [{
						id: 'currimg',
						//hideLabel: true,
						style: 'margin-top:20px;',
						xtype: 'image',
						cls: 'imgarea-thumb-window x-hide-display',
					}]
				}]
			}]
		}];
	},

	loadDropZones: function() {
	}

});
Ext.reg('imgarea-item-window-create', imgArea.window.CreateItem);


imgArea.window.UpdateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'imgarea-item-window-update';
	}
	Ext.applyIf(config, {
		title: _('imgarea_item_update'),
		width: 600,
		autoHeight: true,
		modal: true,
		url: imgArea.config.connector_url,
		action: 'mgr/item/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	imgArea.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(imgArea.window.UpdateItem, MODx.Window, {

	getFields: function(config)
	{
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id',
		}, {
			xtype: 'hidden',
			name: 'image',
			anchor: '100%',
			id: 'image',
		}, {
			xtype: 'textfield',
			fieldLabel: _('imgarea_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '100%',
			allowBlank: false,
		}, {
			items: [{
				layout: 'column',
				border: false,
				items: [{
					columnWidth: .67,
					border: false,
					layout: 'form',
					//style: 'margin-right: 5px;',
					items: [{
						xtype: 'modx-combo-browser',
						fieldLabel: _('imgarea_item_image'),
						name: 'newimage',
						id: config.id + '-newimage',
						anchor: '100%',
						allowBlank: false,
						hideFiles: true,
						source: MODx.config.imgarea_media_source || MODx.config.default_media_source,
						openTo: config.openTo || '/',
						hideSourceCombo: true,
						listeners: imgArea.fieldsImageListeners,
						originalValue: config.record.object.image,
					}, {
						xtype: 'textarea',
						fieldLabel: _('imgarea_item_description'),
						name: 'description',
						id: config.id + '-description',
						anchor: '100%',
						height: 70,
					}, {
						xtype: 'xcheckbox',
						boxLabel: _('imgarea_item_active'),
						name: 'active',
						id: config.id + '-active',
					}]
				}, {
					columnWidth: .33,
					border: false,
					layout: 'form',
					style: 'text-align:center;',
					items: [{
						id: 'currimg',
						//hideLabel: true,
						style: 'margin-top:20px;',
						xtype: 'image',
						cls: 'imgarea-thumb-window x-hide-display',
						listeners: {
							render: {fn:function(data)
							{
								Ext.getCmp('currimg').setSrc( Ext.getCmp('image').getValue() );
							}}
						}
					}]
				}]
			}]
		}];
	},

	loadDropZones: function() {
	}

});
Ext.reg('imgarea-item-window-update', imgArea.window.UpdateItem);


imgArea.fieldsImageListeners = {
	select: {fn:function(data)
	{
		Ext.getCmp('currimg').setSrc(data.fullRelativeUrl);
		Ext.getCmp('image').setValue(data.fullRelativeUrl);
	}}
	,change: {fn:function(data)
	{
		var value = this.getValue();
		Ext.getCmp('currimg').setSrc(value);
		Ext.getCmp('image').setValue(value);
	}}
};