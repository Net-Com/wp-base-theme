<?php

add_action('genesis_entry_content', 'nc_post');

function nc_post()
{
	if ( get_post_type() == 'post' )
	{
		$pods = pods(get_post_type())->find();

		if ( $pods->total() > 0 )
		{
			$posts = [];

			while ( $pods->fetch() )
			{
				$posts[] = $pods->field('post_title');
			}

			render('controllers/post.php', [
				'posts' => $posts,
			]);
		}
	}
}
