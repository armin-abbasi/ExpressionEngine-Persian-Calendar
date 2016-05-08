<?php

/**
 * Jalali Date For ExpressionEngine
 *
 * @package Jalali
 * @author EEP
 */

class Jalali_ext {

    var $name           = 'Jalali';
    var $version        = '1.0';
    var $description    = 'Jalali Date';
    var $settings_exist = 'n';
    var $docs_url       = '';
    var $auto_save      = FALSE;
    var $en_id;
    var $entry_id;
    var $meta;
    var $data;

    /**
     * Constructor
     *
     * @param Mixed | Settings array or empty string if none exist
     */
    function __construct() {
        $this->EE =& get_instance();
    }

    /**
     * Activate extension
     */
    function activate_extension() {
        $data = array(
            'class'    => __CLASS__,
            'method'   => 'main',
            'hook'     => 'publish_form_entry_data',
            'priority' => 10,
            'version'  => $this->version,
            'enabled'  => 'y'
        );
        $this->EE->db->insert('extensions', $data);
    }

    /**
     * Update extension
     */
    function update_extension($current = '') {
        if ($current == '' OR $current == $this->version) {
            return FALSE;
        }

        if ($current < '1.0') {
            // Update to new version
        }

        $this->EE->db->where('class', __CLASS__);
        $this->EE->db->update('extensions', array('version' => $this->version));
    }

    /**
     * Disable extension
     */
    function disable_extension() {
        $this->EE->db->where('class', __CLASS__);
        $this->EE->db->delete('extensions');
    }

    /**
     * Main
     */
    function main(){
        $this->persianDatePicker();
    }


    function persianDatePicker(){
        $persianDatePicker = array(
            'jquery-1.10.1.min.js',
            'persianDatepicker.js',
        );
        $js = 'expressionengine/third_party/'.lcfirst($this->name).'/assets'.'/'.'js'.'/';
        $css = 'expressionengine/third_party/'.lcfirst($this->name).'/assets'.'/'.'css'.'/'.'persianDatepicker-default.css';
        $this->EE->cp->add_to_head('<link rel="stylesheet" href="'.$css.'" />');
        foreach($persianDatePicker as $file){
            $this->EE->cp->add_to_foot('<script src="'.$js.$file.'" type="text/javascript"></script>');
        }
        $this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$js.'jsdateconversion.js'.'"></script>');
    }
}