<?php

function helloworld_shortcode($param, $content)
{
	return render('shortcodes/helloworld', [
		'param'     => $param,
		'content'   => $content
	], true);
}
