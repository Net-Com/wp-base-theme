<?php

add_action('genesis_header', 'nc_header');

function nc_header()
{
    render('controllers/header');
}
