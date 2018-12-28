<?php 

class Helloworld_widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct('hello_world', 'Hello world !', [
		    'description' => 'Hello world !',
        ]);
	}

	public function widget($args, $instance)
	{
		render('widgets/helloworld');
	}

	public function form($instance)
	{

	}

	public function update($new_instance, $old_instance)
	{
		
	}
}
