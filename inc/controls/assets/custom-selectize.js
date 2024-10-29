const selectizeItemView = elementor.modules.controls.BaseData.extend({
	onReady() {
		const self = this;
		self.ui.select.selectize({
			plugins: ['remove_button', 'drag_drop'],
			delimiter: ',',
			persist: false,
			// maxItems: 8
		});
	},
});

elementor.addControlView('meta-store-selectize', selectizeItemView);