<?php

function ws_paypal_donation() {

    $wspd_button = get_option('wspd_button');

    switch ($wspd_button) {
        case 'sm':
            $img_url = 'https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif';
            break;
        case 'lg':
            $img_url = 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif';
            break;
        case 'cc_lg':
            $img_url = 'https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif';
            break;
        default:
            $img_url = 'https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif';
    }
	
	$html = '';
	
	$html .= '<form  target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin:10px 0px;">
			        <input type="hidden" name="cmd" value="_donations">
			        <input type="hidden" name="business" value="' . get_option('wspd_email') . '">
			        <input type="hidden" name="rm" value="0">
			        <input type="hidden" name="currency_code" value="' . get_option('wspd_currency') . '">
			        <input type="image" src="' . $img_url . '" name="submit" alt="PayPal - The safer, easier way to pay online.">
			        <img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>';
	
    return $html;
}

//Add Shortcode
add_shortcode('ws_paypal_donation', 'ws_paypal_donation');

?>