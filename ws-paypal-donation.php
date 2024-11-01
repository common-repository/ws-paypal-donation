<?php
/*
Plugin Name: WS Paypal Donation
Plugin URI: https://wordpress.org/plugins/ws-paypal-donation
Description: WS Paypal Donation plugin provides to add paypal donation button to your blog.
Version: 1.0
Author: WebShouters
Author URI: http://www.webshouters.com
Text Domain: ws-paypal-donation
*/                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                        
define('WS_PAYPAL_DONATE_DIR', plugin_dir_path(__FILE__));
define('WS_PAYPAL_DONATE_URL', plugin_dir_url(__FILE__));   
define('WSPD_TEXT_DOMAIN', 'ws-paypal-donation');
                                                                       
//register settings                                                   
function wspd_register_settings() {
    register_setting( 'wspd_options_group', 'wspd_email');
    register_setting( 'wspd_options_group', 'wspd_currency');
    register_setting( 'wspd_options_group', 'wspd_button');
}     

//add default setting values on activation        
function wspd_activate() {
    add_option( 'wspd_email', 'youremail@mail.com');
    add_option( 'wspd_currency', 'USD');
    add_option( 'wspd_button', 'sm');
}

//delete setting and values on deactivation
function wspd_deactivate() {
    delete_option( 'wspd_email');
    delete_option( 'wspd_currency');
    delete_option( 'wspd_button');
}

function wspd_register_options_page() {
    add_options_page('WS Paypal Donation', 'WS Paypal Donation', 'manage_options', 'ws-paypal-donation', 'ws_paypal_donation_options_page');
}

function ws_paypal_donation_options_page()
{
    ?>
    <div>
        <?php screen_icon(); ?>
        <h2><?php _e('WS Paypal Donation', WSPD_TEXT_DOMAIN); ?></h2>

        <p><?php _e('WS Paypal Donation plugin provides to add simple paypal donation button to your blog.', WSPD_TEXT_DOMAIN); ?> </p>

        <form method="post" action="options.php">

            <?php settings_fields( 'wspd_options_group' ); ?>

            <h3><?php _e('General Setting', WSPD_TEXT_DOMAIN); ?></h3>

            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><label for="wspd_email"><?php _e('Paypal ID', WSPD_TEXT_DOMAIN); ?> </label></th>
                    <td><input name="wspd_email" type="text" id="wspd_email" value="<?php echo get_option('wspd_email'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wspd_currency"><?php _e('Currency', WSPD_TEXT_DOMAIN); ?> </label></th>
                    <td>
                        <?php

                        $currency = array(
                            'USD' => 'U.S. Dollars ($)',
                            'AUD' => 'Australian Dollars (A $)',
                            'BRL' => 'Brazilian Real',
                            'CAD' => 'Canadian Dollars (C $)',
                            'CZK' => 'Czech Koruna',
                            'DKK' => 'Danish Krone',
                            'EUR' => 'Euros (€)',
                            'HKD' => 'Hong Kong Dollar ($)',
                            'HUF' => 'Hungarian Forint',
                            'ILS' => 'Israeli New Shekel',
                            'JPY' => 'Yen (¥)',
                            'MYR' => 'Malaysian Ringgit',
                            'MXN' => 'Mexican Peso',
                            'NOK' => 'Norwegian Krone',
                            'NZD' => 'New Zealand Dollar ($)',
                            'PHP' => 'Philippine Peso',
                            'PLN' => 'Polish Zloty',
                            'GBP' => 'Pounds Sterling (£)',
                            'RUB' => 'Russian Ruble',
                            'SGD' => 'Singapore Dollar ($)',
                            'SEK' => 'Swedish Krona',
                            'CHF' => 'Swiss Franc',
                            'TWD' => 'Taiwan New Dollar',
                            'THB' => 'Thai Baht',
                            'TRY' => 'Turkish Lira'
                        );

                        ?>
                        <select name="wspd_currency" id="wspd_currency">
                            <?php

                            $wspd_currency = get_option('wspd_currency');

                            foreach ($currency as $key => $value) :
                                if ($key == $wspd_currency) {
                                    $selected = "selected='selected'";
                                } else {
                                    $selected = '';
                                }
                                echo "<option {$selected} value='{$key}'>{$value}</option>";
                            endforeach;
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Donation Button', WSPD_TEXT_DOMAIN); ?></th>
                    <td>
                        <label>
                            <input type='radio' name='wspd_button' value='sm' <?php if (get_option('wspd_button') == 'sm') echo 'checked="checked" ';?>>
                            <img src='https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif' alt='Small' style="vertical-align: middle;">
                        </label><br /><br />

                        <label>
                            <input type='radio' name='wspd_button' value='lg' <?php if (get_option('wspd_button') == 'lg') echo 'checked="checked" ';?>>
                            <img src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt='Large' style="vertical-align: middle;">
                        </label><br /><br />

                        <label>
                            <input type='radio' name='wspd_button' value='cc_lg' <?php if (get_option('wspd_button') == 'cc_lg') echo 'checked="checked" ';?>>
                            <img src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' alt='CC Large' style="vertical-align: middle;">
                        </label>
                    </td>
                </tr>
                </tbody>
            </table>

            <?php  submit_button(); ?>

        </form>
    </div>
    <?php
}
add_action( 'admin_init', 'wspd_register_settings' );
//register activation hook
register_activation_hook( __FILE__, 'wspd_activate' );
//register deactivation hook
register_deactivation_hook( __FILE__, 'wspd_deactivate' );
//Add Menu
add_action('admin_menu', 'wspd_register_options_page');
include_once(WS_PAYPAL_DONATE_DIR . 'includes/shortcode/shortcode.php');