<?php

add_action( 'customize_register', 'nc_child_theme_customize' );

function nc_child_theme_customize($wp_customize)
{
	global $customize_options;

	if (is_array($customize_options) && !empty($customize_options)) {
		$wp_customize->add_section( 'NC_Child_theme' , array(
		    'title'      => 'Themes options'
		));

		foreach ($customize_options as $id => $options) {
			$wp_customize->add_setting($id,['default'=>$options['default'],'type'=>'option']);

			unset($options['default']);

			$type = @$options['type'];

			switch ($type) {
				case 'image':
					$classe_used = 'WP_Customize_Image_Control';
					unset($options['type']);
					break;

				case 'file':
					$classe_used = 'WP_Customize_Upload_Control';
					unset($options['type']);
					break;
				
				default:
					$classe_used = 'WP_Customize_Control';
					break;
			}

			//unset($options['type']);

			$options['section'] = 'NC_Child_theme';
			$options['settings'] = $id;

			$wp_customize->add_control(
				new $classe_used(
					$wp_customize,
					$id,
					$options
				)
			);
		}
	}
}