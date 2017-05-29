<?php 

class ListeInfoSimple_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct( 'pagination-simple', 'Pagination simple', ['description'=> 'Pagination simple'] );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$args['title']= 'Simple';
		$args['pods']=$pod = pods('info',['limit' => 2]);
		$args['pagination']=$pod->pagination(['type' => 'simple','first_text' => '<<', 'last_text' => '>>','prev_text' => '<', 'next_text' => '>']); 
		render('widgets/listeInfo/listeInfo',['args'=>$args,'instance'=>$instance]);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		
	}
}