<?php 

function helloworld_shortcode($param , $content)
{
	return render('helloworld',['param'=>$param,'content'=>$content],true);
}