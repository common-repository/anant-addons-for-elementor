jQuery(document).ready(function($) {
    
    elementor.settings.page.addChangeCallback("demo_product_id", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_post_id", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_cat_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_tag_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_author_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_date_year_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_search_result_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_product_cat_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("demo_product_tag_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });
    
});