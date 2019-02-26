<?php

/*
foreach( ['post', 'page', 'attachment', 'post_type'] as $type )
{
    add_filter($type . '_link', function($url, $post, $sample) use ($type)
    {
        if ( is_object($post) )
        {
            switch ( $post->post_type )
            {
                case 'programme' :
                    $url = str_replace("/programme/", "/contexte/", $url);
                    break;
            }
        }

        return $url;
    }, 9999, 3);
}
*/
