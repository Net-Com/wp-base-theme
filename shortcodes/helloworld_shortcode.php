<?php 

function helloworld_shortcode($param , $content)
{
	return render('shortcodes/tpls/helloworld',['param'=>$param,'content'=>$content],true);
}