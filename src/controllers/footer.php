<?php

add_action('genesis_footer', 'nc_footer');

function nc_footer()
{
    render('controllers/footer');
}
