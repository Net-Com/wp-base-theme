<?php 

class Helloworld_widget extends WP_Widget
{
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct()
	{
		parent::__construct( 'hello', 'Hello world !', ['description'=> 'Hello world !'] );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance )
	{
		render('widgets/helloworld/helloworld', ['args'=>$args,'instance'=>$instance]);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance )
	{
		render('widgets/helloworld/helloworld_form',['instance'=>$instance]);
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance )
	{
		
	}
}
