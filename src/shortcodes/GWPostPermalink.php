<?php

/**
 * AJOUT TAG {CURRENT_PERMALINK}
 */

class GWPostPermalink
{
    function __construct()
    {
        add_filter('gform_custom_merge_tags', array($this, 'add_custom_merge_tag'), 10, 4);
        add_filter('gform_replace_merge_tags', array($this, 'replace_merge_tag'), 10, 3);
    }
   
    function add_custom_merge_tag($merge_tags, $form_id, $fields, $element_id)
    {
        $merge_tags[] = array('label' => 'Current Permalink', 'tag' => '{current_permalink}');
       
        return $merge_tags;
    }
   
    function replace_merge_tag($text, $form, $entry)
    {
        $custom_merge_tag = '{current_permalink}';

        if(strpos($text, $custom_merge_tag) === false)
            return $text;
       
        $post_permalink = get_permalink(rgar($entry, get_the_id()));
        $text = str_replace($custom_merge_tag, $post_permalink, $text);
       
        return $text;
    }
}
