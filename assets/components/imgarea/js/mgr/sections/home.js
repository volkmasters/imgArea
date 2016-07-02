imgArea.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'imgarea-panel-home', renderTo: 'imgarea-panel-home-div'
		}]
	});
	imgArea.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(imgArea.page.Home, MODx.Component);
Ext.reg('imgarea-page-home', imgArea.page.Home);