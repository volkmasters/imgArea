var imgArea = function (config) {
	config = config || {};
	imgArea.superclass.constructor.call(this, config);
};
Ext.extend(imgArea, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('imgarea', imgArea);

imgArea = new imgArea();