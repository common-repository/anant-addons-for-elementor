window.onload = () => {};

const run = (filter , scope) => {
	let selectedFilter = filter.getAttribute("data-filter");
	let itemsToHide = scope.querySelectorAll(
		`.anant-fg-projects .anant-fg-project:not([data-filter='${selectedFilter}'])`
	);

	let itemsToShow = scope.querySelectorAll(
		`.anant-fg-projects [data-filter='${selectedFilter}']`
	);

	if (selectedFilter === "All") {
		itemsToHide = [];
		itemsToShow = scope.querySelectorAll(
			".anant-fg-projects [data-filter]"
		);
	}

	itemsToHide.forEach((el) => {
		el.classList.add("anant-fg-hide");
		el.classList.remove("anant-fg-show");
	});

	itemsToShow.forEach((el) => {
		el.classList.remove("anant-fg-hide");
		el.classList.add("anant-fg-show");
	});
};

const load = ($scope, $) => {
	const wId = $scope.attr("data-id");
	const wrapper = document.querySelector(`.elementor-element-${wId}`);
	// console.clear();
	const filters = wrapper.querySelectorAll(".anant-fg-filter");
	if (filters.length > 0) {
		run(filters[0], wrapper);
	}
	filters.forEach((filter) => {
		filter.addEventListener("click", function () {
			run(filter, wrapper);
		});
	});

	// Add Active Class
	var selector = $scope.find('.anant-fg-filter');
	jQuery(selector).on('click', function(){
		jQuery(selector).removeClass('active');
		jQuery(this).addClass('active');
	});

};

jQuery(window).on("elementor/frontend/init", function () {
	elementorFrontend.hooks.addAction(
		"frontend/element_ready/anant-filter-gallery.default",
		load
	);
});