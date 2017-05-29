<?php
/**
 * Plugin Name: Gravity Forms Multi-Column
 * Description: Adds basic multi-column support to Gravity Forms
 * Version: 1.1.0
 * Author: Jordan Crown
 * Author URI: http://www.jordancrown.com
 * License: GNU General Pulic License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

add_filter( 'gform_field_container', 'add_bootstrap_container_class', 10, 6 );
function add_bootstrap_container_class( $field_container, $field, $form, $css_class, $style, $field_content ) {
  if(IS_ADMIN) return $field_container;
  $id = $field->id;
  $field_id = is_admin() || empty( $form ) ? "field_{$id}" : 'field_' . $form['id'] . "_$id";
  return '<div id="' . $field_id . '" class="' . $css_class . ' form-group">{FIELD_CONTENT}</div>';
}

add_filter("gform_field_content", "bootstrap_styles_for_gravityforms_fields", 10, 5);
function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){
	if(IS_ADMIN) return $content;
	// Currently only applies to most common field types, but could be expanded.
	
	if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
		$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
	}
	
	if($field["type"] == 'name' || $field["type"] == 'address') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
	}
	
	if($field["type"] == 'textarea') {
		$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
	}
	
	if($field["type"] == 'checkbox') {
		$content = str_replace('li class=\'', 'div class=\'checkbox ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
		$content = str_replace('</li>', '</div>', $content);
	}
	
	if($field["type"] == 'radio') {
		$content = str_replace('li class=\'', 'div class=\'radio ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
		$content = str_replace('</li>', '</div>', $content);
	}

	
	return $content;
	
} // End bootstrap_styles_for_gravityforms_fields()
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
    return str_replace("gform_button", "gform_button btn btn-primary", $button);
}


if(!class_exists('GF_Multi_Column')) {
	class GF_Multi_Column {

		public static $version = '1.0.0';


		public static function init() {
			add_action('init', array('GF_Multi_Column', 'register_gf_field_column'), 20);
			add_filter('gform_field_container', array('GF_Multi_Column', 'filter_gf_field_column_container'), 10, 6);
			add_filter('gform_get_form_filter', array('GF_Multi_Column', 'filter_gf_multi_column_get_form'), 10, 2 );
		}


		public static function register_gf_field_column() {
			if(!class_exists('GFForms')) return;
			GF_Fields::register(new GF_Field_Column_start());
			GF_Fields::register(new GF_Field_Column_end());
			GF_Fields::register(new GF_Field_Row_start());
			GF_Fields::register(new GF_Field_Row_end());
			GF_Fields::register(new GF_Field_Submit());
		}

		public static function filter_gf_multi_column_get_form($form, $fields)
		{
			if(IS_ADMIN) return $form;
			$form = str_replace("</ul>", "", $form);
			$form = preg_replace("/<\s*ul[^>]*>/", "", $form);

			if(preg_match("/{submit}/", $form)){
				preg_match("/<\s*input type='submit' [^>]*>/",$form,$submit);
				$form = str_replace($submit[0], '', $form);
				$cssClass = '';
				foreach ($fields['fields'] as $field) {
					if ($field->type == 'submit-btn') {
						$cssClass = $field->cssClass;
						break;
					}
				}
				$submit[0] = str_replace("class='","class='".$cssClass." ",$submit[0]);
				$form = str_replace("{submit}", $submit[0], $form);

			}

			return $form;
		}

		public static function filter_gf_field_column_container($field_container, $field, $form, $css_class, $style, $field_content) {
			if(IS_ADMIN) return $field_container;
			if($field['type'] == 'column-start') {
				foreach($form['fields'] as $form_field) {
					if($form_field['id'] == $field['id']) break;
				}
				return '<div class="'.GFCommon::get_ul_classes($form).' column '.$field['cssClass'].'">';
			}

			if($field['type'] == 'row-start') {
				foreach($form['fields'] as $form_field) {
					if($form_field['id'] == $field['id']) break;
				}
				return '<div class="row">';
			}

			if($field['type'] == 'column-end' || $field['type'] == 'row-end') {
				foreach($form['fields'] as $form_field) {
					if($form_field['id'] == $field['id']) break;
				}
				return '</div>';
			}

			if($field['type'] == 'submit-btn') {
				foreach($form['fields'] as $form_field) {
					if($form_field['id'] == $field['id']) break;
				}
				return '{submit}';
			}
			return $field_container;
		}
	}
	GF_Multi_Column::init();
}


if(!class_exists('GF_Field_Column_start') && class_exists('GF_Field')) {
	class GF_Field_Column_start extends GF_Field {

		public $type = 'column-start';

		public function get_form_editor_field_title() {
			return esc_attr__('Column start', 'gravityforms');
		}

		public function is_conditional_logic_supported() {
			return false;
		}

		function get_form_editor_field_settings() {
			return array(
				'column_description',
				'css_class_setting'
			);
		}

		public function add_button( $field_groups ) {
		    $field_groups = $this->maybe_add_field_group( $field_groups );

		    return parent::add_button( $field_groups );
		}

		public function maybe_add_field_group( $field_groups ) {
		    foreach ( $field_groups as $field_group ) {
		        if ( $field_group['name'] == 'gird_fields' ) {

		            return $field_groups;
		        }
		    }

		    $field_groups[] = array(
		        'name'   => 'gird_fields',
		        'label'  => 'Grille bootstrap',
		        'fields' => array()
		    );

		    return $field_groups;
		}

		public function get_form_editor_button() {
		    return array(
		        'group' => 'gird_fields',
		        'text'  => $this->get_form_editor_field_title(),
		    );
		}

		public function get_field_content($value, $force_frontend_label, $form) {

			$is_entry_detail = $this->is_entry_detail();
			$is_form_editor = $this->is_form_editor();
			$is_admin = $is_entry_detail || $is_form_editor;

			if($is_admin) {
				$admin_buttons = $this->get_admin_buttons();
				return $admin_buttons.'<label class=\'gfield_label\'>'.$this->get_form_editor_field_title().'</label>{FIELD}<hr>';
			}

			return '';
		}

	}
}

if(!class_exists('GF_Field_Row_start') && class_exists('GF_Field')) {
	class GF_Field_Row_start extends GF_Field {

		public $type = 'row-start';

		public function get_form_editor_field_title() {
			return esc_attr__('Row start', 'gravityforms');
		}

		public function is_conditional_logic_supported() {
			return false;
		}

		function get_form_editor_field_settings() {
			return array();
		}

		public function get_field_content($value, $force_frontend_label, $form) {

			$is_entry_detail = $this->is_entry_detail();
			$is_form_editor = $this->is_form_editor();
			$is_admin = $is_entry_detail || $is_form_editor;

			if($is_admin) {
				$admin_buttons = $this->get_admin_buttons();
				return $admin_buttons.'<label class=\'gfield_label\'>'.$this->get_form_editor_field_title().'</label>{FIELD}<hr>';
			}

			return '';
		}

		public function get_form_editor_button() {
		    return array(
		        'group' => 'gird_fields',
		        'text'  => $this->get_form_editor_field_title(),
		    );
		}

	}
}

if(!class_exists('GF_Field_Column_end') && class_exists('GF_Field')) {
	class GF_Field_Column_end extends GF_Field {

		public $type = 'column-end';

		public function get_form_editor_field_title() {
			return esc_attr__('Column end', 'gravityforms');
		}

		public function is_conditional_logic_supported() {
			return false;
		}

		function get_form_editor_field_settings() {
			return array();
		}

		public function get_field_input($form, $value = '', $entry = null) {
			return '';
		}

		public function get_field_content($value, $force_frontend_label, $form) {

			$is_entry_detail = $this->is_entry_detail();
			$is_form_editor = $this->is_form_editor();
			$is_admin = $is_entry_detail || $is_form_editor;

			if($is_admin) {
				$admin_buttons = $this->get_admin_buttons();
				return $admin_buttons.'<label class=\'gfield_label\'>'.$this->get_form_editor_field_title().'</label>{FIELD}<hr>';
			}

			return '';
		}

		public function get_form_editor_button() {
		    return array(
		        'group' => 'gird_fields',
		        'text'  => $this->get_form_editor_field_title(),
		    );
		}

	}
}

if(!class_exists('GF_Field_Row_end') && class_exists('GF_Field')) {
	class GF_Field_Row_end extends GF_Field {

		public $type = 'row-end';

		public function get_form_editor_field_title() {
			return esc_attr__('Row end', 'gravityforms');
		}

		public function is_conditional_logic_supported() {
			return false;
		}

		function get_form_editor_field_settings() {
			return array();
		}

		public function get_field_input($form, $value = '', $entry = null) {
			return '';
		}

		public function get_field_content($value, $force_frontend_label, $form) {

			$is_entry_detail = $this->is_entry_detail();
			$is_form_editor = $this->is_form_editor();
			$is_admin = $is_entry_detail || $is_form_editor;

			if($is_admin) {
				$admin_buttons = $this->get_admin_buttons();
				return $admin_buttons.'<label class=\'gfield_label\'>'.$this->get_form_editor_field_title().'</label>{FIELD}<hr>';
			}

			return '';
		}

		public function get_form_editor_button() {
		    return array(
		        'group' => 'gird_fields',
		        'text'  => $this->get_form_editor_field_title(),
		    );
		}

	}
}

if(!class_exists('GF_Field_Submit') && class_exists('GF_Field')) {
	class GF_Field_Submit extends GF_Field {

		public $type = 'submit-btn';

		public function get_form_editor_field_title() {
			return esc_attr__('Submit', 'gravityforms');
		}

		function get_form_editor_field_settings() {
			return array(
				'css_class_setting'
			);
		}

		public function get_field_content($value, $force_frontend_label, $form) {

			$is_entry_detail = $this->is_entry_detail();
			$is_form_editor = $this->is_form_editor();
			$is_admin = $is_entry_detail || $is_form_editor;

			if($is_admin) {
				$admin_buttons = $this->get_admin_buttons();
				return $admin_buttons.'<label class=\'gfield_label\'>'.$this->get_form_editor_field_title().'</label>{FIELD}<hr>';
			}

			return '';
		}
	}
}
