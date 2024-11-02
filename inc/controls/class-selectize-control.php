<?php namespace AnantAddons;
use \Elementor\Base_Data_Control;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class Selectize_Control extends Base_Data_Control {

    const Selectize = 'meta-store-selectize';

    /**
     * Set control type.
     */
    public function get_type() {
        return self::Selectize;
    }

    /**
     * Enqueue control scripts and styles.
     */
    public function enqueue() {

        wp_enqueue_script('selectize', ANANT_URL . 'inc/controls/assets/selectize.js', array('jquery', 'jquery-ui-sortable'), '1.0', true);
        wp_enqueue_script('custom-selectize', ANANT_URL . 'inc/controls/assets/custom-selectize.js', array('selectize'), '1.0', true);
        wp_enqueue_style('selectize', ANANT_URL . 'inc/controls/assets/selectize.css', array(), ANANT_VERSION);
    }

    /**
     * Set default settings
     */
    protected function get_default_settings() {
        return [
            'multiple' => true,
            'label_block' => true,
            'options' => [],
        ];
    }

    /**
     * Control field markup
     */
    public function content_template() {

        $control_uid = $this->get_control_uid();
        ?>
        <div class="elementor-control-field">
            <label for="<?php echo esc_attr($control_uid); ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <#
                var unstored = {};
                var multiple = ( data.multiple ) ? 'multiple' : '';
                var value = data.controlValue;
                var options = data.options;
                if(options){
                _.each( options, function( option_title, option_value ) {
                if (-1 == value.indexOf( option_value ) ) {
                unstored[option_value] = option_title;
                }
                });
                }
                #>

                <select id="<?php echo esc_attr($control_uid); ?>" class="elementor-selectize" {{ multiple }} data-setting="{{ data.name }}">
                        <#
                        if(value){
                        _.each( value, function( key ) { #>
                        <option value="{{ key }}">{{{ options[key] }}}</option>
                    <# } );
                    }

                    _.each( unstored, function( option_title, option_value ) { #>
                    <option value="{{ option_value }}">{{{ option_title }}}</option>
                    <# } ); #>
                </select>
            </div>
        </div>
        <# if ( data.description ) { #>
        <div class="elementor-control-field-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }

}