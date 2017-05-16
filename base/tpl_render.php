<?php 

function render($tpl,$data,$return = false)
{
	@ob_end_flush();
	ob_start();

	$tpl = get_stylesheet_directory().'/'.dirname($tpl).'/'.basename($tpl,'.php').'.php';

	if (file_exists($tpl)) {
		if (is_array($data) && !empty($data)) {
			extract($data);
		}
		include $tpl;
		$content = ob_get_clean();

		@ob_end_flush();

		if ($return) {
			return $content;
		}else{
			echo $content;
		}
	}

}