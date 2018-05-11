<?php
echo $args['title']."<BR>";
while ($args['pods']->fetch()) {
	echo $args['pods']->field('post_title')."<BR>";
}
echo $args['pagination'];
?>
<BR><BR>