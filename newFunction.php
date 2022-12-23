<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
include 'class.order.php';
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.1'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );
/**
 * Changes the locale output.
 * 
 * @param string $locale The current locale.
 * 
 * @return string The locale.
 */
function yst_wpseo_change_og_locale( $locale ) {
    return 'en_AU';
}

function itsme_disable_feed() {
 wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );



// check login user with relation redirect page url
add_action('init', 'check_login_function');
function check_login_function() {
	
	$postID = url_to_postid( $_SERVER['REQUEST_URI'] , '_wpg_def_keyword', true ); 
	if(in_array($postID,[5218,5285,5286]) && !is_user_logged_in()){
		wp_safe_redirect('https://www.convair.net.au/user');
		exit();
	}

	if(in_array($postID,[5339,5202]) && is_user_logged_in()){
		wp_safe_redirect('https://www.convair.net.au/userprofile');
		exit();
	}
	
}

add_filter('wpmem_login_failed','message_wpmem_login_failed',99,1);
function message_wpmem_login_failed($args){
	return'<div class="register-error-message">'.$args.'</div>';
}





// Order from start now




// add form Short Code
add_shortcode('order_form','order_fun');
function order_fun(){
	ob_start(); ?>

<div class="right-content">
    <h2>New Order</h2>
    <table>
        <!-- <thead>
            <tr>
                <th colspan="4">The table header</th>
            </tr>
        </thead> -->
        <tbody id="tr_container">

            <tr class="table-row" id="first_tr">
                <td>
                    <div class="input-fild">
                    <input type="hidden" name="action" value="form_process" class="data-input-element">
                        <label class="flabel">
                            <p class="hc">
                                Product type<span class="field_required">*</span>
                            </p>
                            <select name="prouct_type" onchange="show2ndTdElm(this)">
                                <option value="" selected="selected">Choose One</option>
                                <option value="Heating">Heating</option>
                                <option value="Cooling">Cooling</option>
                            </select>
                        </label>
                    </div>
                </td>
                <!-- 1st td end -->
                <td>
                    <div class="2ndtd"></div>
                </td>
                <!-- 2nd td end -->
                <td>
                    <div class="3rdtd column-2"></div>
                </td>
                <!-- 3rd td end -->

                <td>
                    <div class="input-fild add-remove">
                        <label class="flabel">Add/Remove</label>
                        <div class="add-remove-btn">
                            <button onclick="cloneTr()">+</button>
                            <button class="fast-remove-btn" onclick="removeTr(this)">-</button>
                        </div>
                    </div>
                </td>

            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="4">
                    <p class="hcs">product received way.<span class="field_required">*</span></p>
                    <div class="pickup-delivery">
                        <label class="flabel"><input type="radio" name="delivery" value="Pick up"> Pick up</label>
                        <label class="flabel"><input type="radio" name="delivery" value="Delivery"> Delivery</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="message_area"></div>
                </td>
            </tr>
            <tr>
                <td colspan="4"><button type="button" onclick="from_submit()"
                        class="submit-btn">Submit</button></td>
            </tr>
        </tfoot>
    </table>

</div>

<?php
    return ob_get_clean();
}


// add javaScript hook for footer 
add_action('wp_footer', 'get_footer_custom_script');
function get_footer_custom_script(){
  ?>


<script>
    // $(".Click-here").on('click', function() {
    //   $(".popup-model-main").addClass('model-open');
    // }); 
    // $(".close-btn, .bg-overlay").click(function(){
    //   $(".popup-model-main").removeClass('model-open');
    // });

    const heating = `
    <div class="input-fild">
        <label class="flabel">Choose Heater <span class="field_required">*</span></label>

        <select name="input_3" onchange="show3rdTdElm(this)">
            <option value="" selected="selected" class="placeholder">Choose One</option>
            <option value="3 Star Heater">3 Star Heater</option>
            <option value="4 Star Heater">4 Star Heater</option>
            <option value="5 Star Heater">5 Star Heater</option>
            <option value="6 Star Heater">6 Star Heater</option>
        </select>
    </div>
    `;

    const cooling = `
    <div class="input-fild">
        <label class="flabel">Choose Class<span class="field_required">*</span></label>

        <select name="input_2" onchange="show3rdTdElm(this)">
            <option value="" selected="selected" class="placeholder">Choose One</option>
            <option value="Standard">Standard (CA)</option>
            <option value="Premium">Premium (CX)</option>
        </select>
    </div>
    `;

    const modelStandard = `
    <div class="input-fild model coolingModel">
        <label class="flabel">Model, Color & Qty<span class="field_required">*</span></label>

        <div class="modelCooling">
            <select name="cooling_model" class="standardPremium">
                <option value="" selected="selected" class="placeholder">Choose Model</option>
                <option value="CA08 – Small">CA08 – Small</option>
                <option value="CA10 – Medium">CA10 – Medium</option>
                <option value="CA14 – X-Large">CA14 – X-Large</option>
            </select>
            <select name="cooling_color" class="color">
                <option value="" selected="selected" class="placeholder">Choose Color</option>
                <option value="Grey">Grey</option>
                <option value="Terracotta">Terracotta</option>
                <option value="Beige">Beige</option>
            </select>
            <label class="flabel">
                <input name="cooling_qty" type="text" value="" placeholder="Qty" class="qty data-input-element">
            </label>
        </div>

    </div>`;

    const modelPremium = `
    <div class="input-fild model coolingModel">
        <label class="flabel">Model, Color & Qty<span class="field_required">*</span></label>

        <div class="modelCooling">
            <select name="cooling_model" class="standardPremium">
                <option value="" selected="selected" class="placeholder">Choose Model</option>
                <option value="CX12 – Premium Large">CX12 – Premium Large</option>
                <option value="CX14 – Premium X-Large">CX14 – Premium X-Large</option>
            </select>
            <select name="cooling_color" class="color">
                <option value="" selected="selected" class="placeholder">Choose Color</option>
                <option value="Grey">Grey</option>
                <option value="Terracotta">Terracotta</option>
                <option value="Beige">Beige</option>
            </select>
            <label class="flabel">
                <input name="cooling_qty" type="text" value="" placeholder="Qty" class="qty data-input-element">
            </label>
        </div>

    </div> `;

    const model3 = `
    <div class="input-fild model">
        <label class="flabel">Model<span
                class="field_required">*</span></label>

        <div class="inactive">
            <div class="c-option">
                <label class="clabel">
                <input data-id="1" type="checkbox" value="C314-272030" name="m_7" class="data-input-element">
                C314</label>
                <label class="flabel">
                    <input data-id="1" name="mq_7" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="2" type="checkbox" value="C318-272047" name="m_8" class="data-input-element">
                C318</label>
                <label class="flabel">
                    <input data-id="2" name="mq_8" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="3" type="checkbox" value="323-272054" name="m_9" class="data-input-element">
                C323</label>
                <label class="flabel">
                    <input data-id="3" name="mq_9" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="4" type="checkbox" value="C328-272061" name="m_10" class="data-input-element">
                C328</label>
                <label class="flabel">
                    <input data-id="5" name="mq_10" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="5" type="checkbox" value="CD318-272078" name="m_11" class="data-input-element">
                CD318</label>
                <label class="flabel">
                    <input data-id="5" name="mq_11" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="6" type="checkbox" value="CD328-272085" name="m_12" class="data-input-element">
                CD328</label>
                <label class="flabel">
                    <input data-id="6" name="mq_12" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
        </div>

    </div>`;

    const model4 = ` 
    <div class="input-fild model">
        <label class="flabel">Model<span
                class="field_required">*</span></label>

        <div class="inactive">
            <div class="c-option">
                <label class="clabel">
                <input data-id="7" type="checkbox" value="C414 – 272092" name="m_13" class="data-input-element">
                    C414</label>
                <label class="flabel">
                    <input data-id="7" name="mq_13" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="8" type="checkbox" value="C418 – 272108" name="m_14" class="data-input-element">
                    C418</label>
                <label class="flabel">
                    <input data-id="8" name="mq_14" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="9" type="checkbox" value="C423 – 272115" name="m_15" class="data-input-element">
                    C423</label>
                <label class="flabel">
                    <input data-id="9" name="mq_15" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="10" type="checkbox" value="C428- 272122" name="m_16" class="data-input-element">
                    C428</label>
                <label class="flabel">
                    <input data-id="10" name="mq_16" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            
        </div>

    </div>`;

    const model5 = `
    <div class="input-fild model">
        <label class="flabel">Model<span
                class="field_required">*</span></label>

        <div class="inactive">
            <div class="c-option">
                <label class="clabel">
                <input data-id="11" type="checkbox" value="C516 – 272139" name="m_17" class="data-input-element">
                    C516</label>
                <label class="flabel">
                    <input data-id="11" name="mq_17" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="12" type="checkbox" value="C520 – 272146" name="m_18" class="data-input-element">
                    C520</label>
                <label class="flabel">
                    <input data-id="12" name="mq_18" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="13" type="checkbox" value="C528 – 272153" name="m_19" class="data-input-element">
                    C528</label>
                <label class="flabel">
                    <input data-id="13" name="mq_19" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="14" type="checkbox" value="CX528 – 272160" name="m_20" class="data-input-element">
                    CX528</label>
                <label class="flabel">
                    <input data-id="14" name="mq_20" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            
        </div>

    </div>`;

    const model6 = `
    <div class="input-fild model">
        <label class="flabel">Model<span
                class="field_required">*</span></label>

        <div class="inactive">
            <div class="c-option">
                <label class="clabel">
                <input data-id="15" type="checkbox" value="C618 – 272177" name="m_21" class="data-input-element">
                    C618</label>
                <label class="flabel">
                    <input data-id="15" name="mq_21" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="16" type="checkbox" value="C623 – 272184" name="m_22" class="data-input-element">
                    C623</label>
                <label class="flabel">
                    <input data-id="16" name="mq_22" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="17" type="checkbox" value="C631 – 272191" name="m_23" class="data-input-element">
                    C631</label>
                <label class="flabel">
                    <input data-id="17" name="mq_23" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            <div class="c-option">
                <label class="clabel">
                <input data-id="18" type="checkbox" value="CX631 – 272207" name="m_24" class="data-input-element">
                    CX631</label>
                <label class="flabel">
                    <input data-id="18" name="mq_24" type="text" value="" placeholder="Qty" class="qty data-input-element">
                </label>
            </div>
            
        </div>

    </div>`;

    const coolingAccessories = ` 
    <div class="input-fild accessories coolingAccessories">
        <label class="flabel">Evaporative Cooler Accessories</label>

        <div class="c-option">
            <label class="clabel">
                <input data-id="18" type="checkbox" value="Auto Drain Kit (not required for CX) – 098470" name="a_1" class="data-input-element">
            Auto Drain Kit (not required for CX)</label>
            <label class="flabel"><input data-id="18" placeholder="Qty" class="data-input-element qty" name="aq_1" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="19" type="checkbox" value="Bushfire Protection Kit Medium – 114392" name="a_2" class="data-input-element">
            Bushfire Protection Kit Medium</label>
            <label class="flabel"><input data-id="19" placeholder="Qty" class="data-input-element qty" name="aq_2" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="20" type="checkbox" value="Bushfire Protection Kit Large – 114408" name="a_3" class="data-input-element">
            Bushfire Protection Kit Large</label>
            <label class="flabel"><input data-id="20" placeholder="Qty" class="data-input-element qty" name="aq_3" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="21" type="checkbox" value="Convair Standard Digital Control - 118499FG" name="a_4" class="data-input-element">
            Convair Standard Digital Control</label>
            <label class="flabel"><input data-id="21" placeholder="Qty" class="data-input-element qty" name="aq_4" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="22" type="checkbox" value="Convair Smart Thermostat - 094267" name="a_5" class="data-input-element">
            Convair Smart Thermostat</label>
            <label class="flabel"><input data-id="22" placeholder="Qty" class="data-input-element qty" name="aq_5" type="text" value=""></label>
        </div>

    </div>`;

    const heatingAcc3 = `
    <div class="input-fild accessories">
        <label class="flabel">Select Accessory (Flashing Kit, Zone Board)</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="23" type="checkbox" value="Kit Flashing Sml (Rebuff) – 680026" name="a_6" class="data-input-element">
            Kit Flashing Sml (Rebuff)</label>
            <label class="flabel"><input data-id="23" placeholder="Qty" class="data-input-element qty" name="aq_6" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="24" type="checkbox" value="Kit Flashing Lrg (Rebuff) – 680033" name="a_7" class="data-input-element">
            Kit Flashing Lrg (Rebuff)</label>
            <label class="flabel"><input data-id="24" placeholder="Qty" class="data-input-element qty" name="aq_7" type="text" value=""></label>
        </div>

    </div>`;

    const heatingAcc45 = `
    <div class="input-fild accessories">
        <label class="flabel">Select Accessory (Flashing Kit, Zone Board)</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="25" type="checkbox" value="Kit Flashing 150mm (14-23Kw) – 076331" name="a_8" class="data-input-element">
            Kit Flashing 150mm (14-23Kw)</label>
            <label class="flabel"><input data-id="25" placeholder="Qty" class="data-input-element qty" name="aq_8" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="26" type="checkbox" value="Kit Flashing 300mm (15-25Kw) – 076348" name="a_9" class="data-input-element">
            Kit Flashing 300mm (15-25Kw)</label>
            <label class="flabel"><input data-id="26" placeholder="Qty" class="data-input-element qty" name="aq_9" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="27" type="checkbox" value="Kit Flashing 150mm (30-35Kw) – 076362" name="a_10" class="data-input-element">
            Kit Flashing 150mm (30-35Kw)</label>
            <label class="flabel"><input data-id="27" placeholder="Qty" class="data-input-element qty" name="aq_10" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="28" type="checkbox" value="Kit Flashing 300mm (30-35Kw) – 076386" name="a_11" class="data-input-element">
            Kit Flashing 300mm (30-35Kw)</label>
            <label class="flabel"><input data-id="28" placeholder="Qty" class="data-input-element qty" name="aq_11" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="29" type="checkbox" value="Kit Flashing Sml (Rebuff) – 680026" name="a_12" class="data-input-element">
            Kit Flashing Sml (Rebuff)</label>
            <label class="flabel"><input data-id="29" placeholder="Qty" class="data-input-element qty" name="aq_12" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="30" type="checkbox" value="Kit Flashing Lrg (Rebuff) – 680033" name="a_13" class="data-input-element">
            Kit Flashing Lrg (Rebuff)</label>
            <label class="flabel"><input data-id="30" placeholder="Qty" class="data-input-element qty" name="aq_13" type="text" value=""></label>
        </div>

    </div>`;

    const heatingAcc6 = `
    <div class="input-fild accessories">
        <label class="flabel">Select Accessory (Flashing Kit, Zone Board)</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="31" type="checkbox" value="Kit Flashing 150mm (16-23Kw) – 075990" name="a_14" class="data-input-element">
            Kit Flashing 150mm (16-23Kw)</label>
            <label class="flabel"><input data-id="31" placeholder="Qty" class="data-input-element qty" name="aq_14" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="32" type="checkbox" value="Kit Flashing 150mm (32Kw) – 077260" name="a_15" class="data-input-element">
            Kit Flashing 150mm (32Kw)</label>
            <label class="flabel"><input data-id="32" placeholder="Qty" class="data-input-element qty" name="aq_15" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="33" type="checkbox" value="Kit Flashing 300mm (16-23Kw) – 076034" name="a_16" class="data-input-element">
            Kit Flashing 300mm (16-23Kw)</label>
            <label class="flabel"><input data-id="33" placeholder="Qty" class="data-input-element qty" name="aq_16" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
            <input data-id="34" type="checkbox" value="Kit Flashing 300mm (32Kw) – 077277" name="a_17" class="data-input-element">
            Kit Flashing 300mm (32Kw)</label>
            <label class="flabel"><input data-id="34" placeholder="Qty" class="data-input-element qty" name="aq_17" type="text" value=""></label>
        </div>

    </div>`;

    const heatingThermostat = `
    <div class="input-fild thermostat">
        <label class="flabel" >Select Thermostat</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="35" type="checkbox" value="Manual T/Stat – 639666" name="t_1" class="data-input-element">
            Manual T/Stat</label>
            <label class="flabel"><input data-id="35" placeholder="Qty" class="data-input-element qty" name="tq_1" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
                <input data-id="36" type="checkbox" value="Smart Thermostat – 094267" name="t_2" class="data-input-element">
                Smart Thermostat
            </label>
            <label class="clabel"><input data-id="36" placeholder="Qty" class="data-input-element qty" name="tq_2" type="text" value=""></label>
        </div>

    </div>`;

    const flueKit3 = `
    <div class="input-fild flue-kit">
        <label class="flabel" >Flue Kit (determine internal/External Heater)</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="37" type="checkbox" value="External kit inc Man T/Stat – 078083" name="f_1" class="data-input-element">
            External kit inc Man T/Stat</label>
            <label class="flabel"><input data-id="37" placeholder="Qty" class="data-input-element qty" name="fq_1" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
                <input data-id="38" type="checkbox" value="Internal kit inc Man T/Stat – 078076" name="f_2" class="data-input-element">
                Internal kit inc Man T/Stat
            </label>
            <label class="clabel"><input data-id="38" placeholder="Qty" class="data-input-element qty" name="fq_2" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
                <input data-id="39" type="checkbox" value="U/Floor kit inc Man T/Stat – 078090" name="f_3" class="data-input-element">
                U/Floor kit inc Man T/Stat
            </label>
            <label class="clabel"><input data-id="39" placeholder="Qty" class="data-input-element qty" name="fq_3" type="text" value=""></label>
        </div>

    </div>`;

    const flueKit4 = `
    <div class="input-fild flue-kit">
        <label class="flabel" >Flue Kit (determine internal/External Heater)</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="40" type="checkbox" value="External kit for 3,4 star – 075365" name="f_4" class="data-input-element">
            External kit for 3,4 star</label>
            <label class="clabel"><input data-id="40" placeholder="Qty" class="data-input-element qty" name="fq_4" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
                <input data-id="41" type="checkbox" value="Internal kit for 3,4, 5 star – 075297" name="f_5" class="data-input-element">
                Internal kit for 3,4, 5 star
            </label>
            <label class="clabel"><input data-id="41" placeholder="Qty" class="data-input-element qty" name="fq_5" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
                <input data-id="42" type="checkbox" value="U/Floor Kit for 3,4 Star – 075334" name="f_6" class="data-input-element">
                U/Floor Kit for 3,4 Star
            </label>
            <label class="clabel"><input data-id="42" placeholder="Qty" class="data-input-element qty" name="fq_6" type="text" value=""></label>
        </div>

    </div>`;

    const flueKit5 = `
    <div class="input-fild flue-kit">
        <label class="flabel" >Flue Kit (determine internal/External Heater)</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="43" type="checkbox" value="External or U/Floor kit for 5 star – 075389" name="f_7" class="data-input-element">
            External or U/Floor kit for 5 star</label>
            <label class="clabel"><input data-id="43" placeholder="Qty" class="data-input-element qty" name="fq_7" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
                <input data-id="44" type="checkbox" value="Internal kit for 3,4, 5 star – 075297" name="f_8" class="data-input-element">
                Internal kit for 3,4, 5 star
            </label>
            <label class="clabel"><input data-id="44" placeholder="Qty" class="data-input-element qty" name="fq_8" type="text" value=""></label>
        </div>

    </div>`;

    const flueKit6 = `
    <div class="input-fild flue-kit">
        <label class="flabel" >Flue Kit (determine internal/External Heater)</label>

        <div class="c-option">
            <label class="clabel">
            <input data-id="45" type="checkbox" value="External Kit for 6 star – 075396" name="f_9" class="data-input-element">
            External Kit for 6 star</label>
            <label class="clabel"><input data-id="45" placeholder="Qty" class="data-input-element qty" name="fq_9" type="text" value=""></label>
        </div>
        <div class="c-option">
            <label class="clabel">
                <input data-id="46" type="checkbox" value="Internal kit or U/Floor for 6 star – 075358" name="f_10" class="data-input-element">
                Internal kit or U/Floor for 6 star
            </label>
            <label class="clabel"><input data-id="46" placeholder="Qty" class="data-input-element qty" name="fq_"10 type="text" value=""></label>
        </div>

    </div>`;

    function cloneTr() {
        let tr = jQuery("#first_tr").clone();
        jQuery(tr).find("select").val("");
        jQuery(tr).find("input").val("");
        jQuery(tr).find('div.2ndtd').html("");
        jQuery(tr).find('div.3rdtd').html("");
        jQuery(tr).attr("id", "");
        jQuery("#tr_container").append(tr);
    }

    function removeTr(data) {
        let tr = jQuery(data).parent().parent().parent().parent();
        let id = jQuery(tr).attr("id");
        if (id != 'first_tr') jQuery(tr).remove();
    }

    // jQuery(document).ready(function () {

    //     $("#input_2").change(function () {
    //         let input_2 = this.value;
    //         // alert(status);
    //         if (input_2 == "Standard") {
    //             jQuery(".inactive.active").removeClass("active");
    //             jQuery("#modelStandard").addClass("active");
    //         }
    //         if (input_2 == "Premium") {
    //             jQuery(".inactive.active").removeClass("active");
    //             jQuery("#modelPremium").addClass("active");
    //         }
    //     });


    // });
</script>
<script>
function show2ndTdElm(data) {
    let value = jQuery(data).val();
    let tr = jQuery(data).parent().parent().parent().parent();
    if (value == 'Heating') {
        jQuery(tr).find('div.2ndtd').html(heating);
        jQuery(tr).find('div.3rdtd').html("");
    } else if (value == 'Cooling') {
        jQuery(tr).find('div.2ndtd').html(cooling);
        jQuery(tr).find('div.3rdtd').html("");
    } else {
        jQuery(tr).find('div.2ndtd').html("");
        jQuery(tr).find('div.3rdtd').html("");
    }
}

function show3rdTdElm(data) {
    let value = jQuery(data).val();
    let tr = jQuery(data).parent().parent().parent().parent();
    if (value == 'Standard') {
        jQuery(tr).find('div.3rdtd').html(modelStandard + coolingAccessories);
    } else if (value == 'Premium') {
        jQuery(tr).find('div.3rdtd').html(modelPremium + coolingAccessories);
    } else if (value == '3 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model3 + flueKit3 + heatingThermostat + heatingAcc3);
    } else if (value == '4 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model4 + flueKit4 + heatingThermostat + heatingAcc45);
    } else if (value == '5 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model5 + flueKit5 + heatingThermostat + heatingAcc45);
    } else if (value == '6 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model6 + flueKit6 + heatingThermostat + heatingAcc6);
    } else {
        jQuery(tr).find('div.3rdtd').html("");
    }
}

async function from_submit() {
    let returnValue= await form_validation();// 2 sec
    console.log(returnValue);
    let error = returnValue[0];
    if(!error){
        let data = returnValue[1];
        process_form_data(data);
    }
}

async function form_validation(){
    jQuery("#message_area").html("");

    let rows = jQuery("#tr_container tr.table-row");

    let data = {'action':'form_process','rows':{}};
    let error = false;
    jQuery(rows).each(function (index, row) {

        let rowData = {};

        let prouct_type = jQuery(row).find("select[name='prouct_type']").val();
        if (!prouct_type) {
            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Product type must need to select.</p>`);
            jQuery(row).find("select[name='prouct_type']").addClass("warning");
            error=true;
            return [error,false];
        }

        rowData.type=prouct_type;

        // check heating or cooling
        if (prouct_type == 'Heating') {

            let star = jQuery(row).find("select[name='input_3']").val();
            if (!star) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Heater must need to select.</p>`);
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_3']").addClass("warning");
                error=true;
                return [error,false];
            } else {
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_3']").removeClass("warning");
            }

            rowData.heater = star;

            // model
            let modelLength = jQuery(row).find(".model").find("input[type=checkbox]:checked").length;
            if (modelLength < 1) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model must need to select.</p>`);
                jQuery(row).find("select[name='input_3']").removeClass("warning");
                jQuery(row).find(".model").find(".clabel").addClass("error");
                error=true;
            return [error,false];
            } else {
                jQuery(row).find(".model").find(".clabel").removeClass("error");
            }

            // model qty 
            let models = jQuery(row).find(".model").find("input[type=checkbox]:checked");
            rowData.models = {};
            jQuery(models).each(function (i, model) {
                let qty = jQuery(model).parent().parent().find("input.qty").val().trim();
                if (qty) {
                    qty = parseInt(qty);
                    if (qty < 1) {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model's quantity required.</p>`);
                        jQuery(row).find(".model").find(".clabel").removeClass("error");
                        jQuery(model).parent().parent().find("input.qty").addClass("warning");
                        error=true;
            return [error,false];
                    } else {
                        jQuery(row).find(".model").find(".clabel").removeClass("error");
                        jQuery(model).parent().parent().find("input.qty").removeClass("warning");

                        let rowModelData = {model:jQuery(model).val(),qty:qty};
                        //rowData.models.push(rowModelData);
                        rowData.models[i]=rowModelData;
                    }
                } else {
                    jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model's quantity required.</p>`);
                    jQuery(row).find(".model").find(".clabel").removeClass("error");
                    jQuery(model).parent().parent().find("input.qty").addClass("warning");
                    error=true;
            return [error,false];
                }
            }); // model qty end

            // fule kit
            let fuleKitLength = jQuery(row).find(".flue-kit").find("input[type=checkbox]:checked").length;
            if (fuleKitLength > 0) {
                let fuleKits = jQuery(row).find(".flue-kit").find("input[type=checkbox]:checked");
                rowData.fule_kits = {};
                jQuery(fuleKits).each(function (i, kit) {
                    let qty = jQuery(kit).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Fule kit quantity required.</p>`);
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                            error=true;
                            return [error,false];
                        } else {
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").removeClass("warning");

                            let rowFuleData = {kit:jQuery(kit).val(),qty:qty};
                            rowData.fule_kits[i]=rowFuleData;
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Fule kit quantity required.</p>`);
                        jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                        jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                        error=true;
                        return [error,false];
                    }
                });
            } // fule kit end

            // Thermostat
            let thermostatLength = jQuery(row).find(".thermostat").find("input[type=checkbox]:checked").length;
            if (thermostatLength > 0) {
                let thermostats = jQuery(row).find(".thermostat").find("input[type=checkbox]:checked");
                rowData.thermostats = {};
                jQuery(thermostats).each(function (i, kit) {
                    let qty = jQuery(kit).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Thermostat Qty required.</p>`);
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                            error=true;
            return [error,false];
                        } else {
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").removeClass("warning");

                            let rowThermData = {thermostat:jQuery(kit).val(),qty:qty};
                            rowData.thermostats[i]=rowThermData;
                            //rowData.thermostats.push(rowThermData);
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Thermostat Qty required.</p>`);
                        jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                        jQuery(kit).parent().parent().find("input.qty").addClass("warning");

                        error=true;
                        return [error,false];
                    }
                });
            } // Thermostat end


            // Heater accessories
            let accessoriesLength = jQuery(row).find(".accessories").find("input[type=checkbox]:checked").length;
            if (accessoriesLength > 0) {
                let accessoriess = jQuery(row).find(".accessories").find("input[type=checkbox]:checked");
                rowData.heater_accessories = {};
                jQuery(accessoriess).each(function (i, kit) {
                    let qty = jQuery(kit).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Heater Accessories Qty required.</p>`);
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                            error=true;
                            return [error,false];
                        } else {
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").removeClass("warning");

                            let rowFuleData = {accessories:jQuery(kit).val(),qty:qty};
                            rowData.heater_accessories[i]=rowFuleData;
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Heater Accessories Qty required.</p>`);
                        jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                        jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                        error=true;
                        return [error,false];
                    }
                });
            } // Heater accessories end

        } // end heating

        if (prouct_type == 'Cooling') {
            let standardPremium = jQuery(row).find("select[name='input_2']").val();
            if (!standardPremium) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Cooling must need to select.</p>`);
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_2']").addClass("warning");
                
                error=true;
                return [error,false];
            } else {
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_2']").removeClass("warning");
            }

            // rowData['class'] = standardPremium;
            rowData.class = standardPremium;

            // Model, Color & Qty
            let modelSelect = jQuery(row).find(".modelCooling").find("select.standardPremium").val();
            if (!modelSelect) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model must need to select.</p>`);
                jQuery(row).find("select[name='input_2']").removeClass("warning");
                jQuery(row).find(".modelCooling").find("select.standardPremium").addClass("warning");
                
                error=true;
                return [error,false];
            } else {
                jQuery(row).find(".modelCooling").find("select.standardPremium").removeClass("warning");
            }
            // rowData['model'] = modelSelect;
            rowData.model = modelSelect;

            let modelColor = jQuery(row).find(".modelCooling").find("select.color").val();
            if (!modelColor) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model Color need to select.</p>`);
                jQuery(row).find(".modelCooling").find("select.standardPremium").removeClass("warning");
                jQuery(row).find(".modelCooling").find("select.color").addClass("warning");
                
                error=true;
                return [error,false];
            } else {
                jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
            }
            // rowData['color'] = modelColor;
            rowData.color = modelColor;

            let modelQty = jQuery(row).find(".modelCooling").find("input[type='text']").val().trim();

            if (modelQty) {
                let mSQty = parseInt(modelQty);
                if (mSQty < 1) {
                    jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Please add Qty.</p>`);
                    jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
                    jQuery(row).find(".modelCooling").find("input.qty").addClass("warning");
                        
                    error=true;
                    return [error,false];
                } else {
                    jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
                    jQuery(row).find(".modelCooling").find("input.qty").removeClass("warning");
                }
                // rowData['qty'] = mSQty;
                rowData.qty = mSQty;
            } else {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Please add Qty.</p>`);
                jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
                jQuery(row).find(".modelCooling").find("input.qty").addClass("warning");
                
                error=true;
                return [error,false];
            }

            // Model, Color & Qty end


            // Cooler accessories
            let accessoriesLength = jQuery(row).find(".accessories").find("input[type=checkbox]:checked").length;
            if (accessoriesLength > 0) {
                let accessoriess = jQuery(row).find(".accessories").find("input[type=checkbox]:checked");
                rowData.cooler_accessories = {};
                
                jQuery(accessoriess).each(function (i, coolerAcc) {
                    let qty = jQuery(coolerAcc).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Cooler Accessories Qty required.</p>`);
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(coolerAcc).parent().parent().find("input.qty").addClass("warning");
                            error=true;
                            return [error,false];
                        } else {
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(coolerAcc).parent().parent().find("input.qty").removeClass("warning");

                            let rowAccData = {accessories:jQuery(coolerAcc).val(),qty:qty};
                            rowData.cooler_accessories[i]=rowAccData;
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Cooler Accessories Qty required.</p>`);
                        jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                        jQuery(coolerAcc).parent().parent().find("input.qty").addClass("warning");
                        error=true;
                        return [error,false];
                    }
                });
            } // Cooler accessories end



        } // end cooling

        data.rows[index]=rowData;
    });
    
    // Delivery Or Pick up 
    let tfoot = jQuery("tfoot .pickup-delivery");
    let delivery = jQuery(tfoot).find("input[type=radio]:checked").length;
    // console.log(delivery);
    if (!delivery) {
        jQuery("#message_area").html(`<p>Product received way... need to select.</p>`);
        jQuery(tfoot).find(".flabel").addClass("error");
        error=true;
        return [error,false];
    } else {
        jQuery(tfoot).find(".flabel").removeClass("error");

        let delivery = jQuery(tfoot).find("input[type=radio]:checked").val();
        data.delivery=delivery;
    }
    // End Form validation

   return [error,data];
}


function process_form_data(data){
    
    jQuery("#message_area").html(`<p class="info">Please wait! we are processing...</p>`);
    jQuery.post('<?=admin_url( 'admin-ajax.php' )?>',data,function(result){
       if(result == 'ok') {
        window.location.href='https://www.convair.net.au/userprofile/';
       }else {
        jQuery("#message_area").html(result);
       }
    });
}


function details(id) {
    // $.ajax({
    //         type : "POST",
    //         url : "<?php echo admin_url('admin-ajax.php'); ?>",
    //         data : {action: "get_data", id: id},
    //         success: function(response) {
    //             jQuery("#order_details").html(response);
    //             $(".Click-here").on('click', function() {
    //                 $(".popup-model-main").addClass('model-open');
    //             }); 
    //             $(".close-btn, .bg-overlay").click(function(){
    //                 $(".popup-model-main").removeClass('model-open');
    //             });
    //         }
    //     });

    jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {action: "get_data", id: id}, function(response) {
        jQuery("#order_details").html(response);
        jQuery(".Click-here").on('click', function() {
            jQuery(".popup-model-main").addClass('model-open');
            }); 
            jQuery(".close-btn, .bg-overlay").click(function(){
                jQuery(".popup-model-main").removeClass('model-open');
            });
    });
}
</script>
<?php
}

// The end 


// ajax process
function form_process(){



    $post_type = "dealer-order";
    $post_title = 'order - '.uniqid();
    $post_content = json_encode($_POST);

    $new_post = array(
          'post_author' => get_current_user_id(), 
          'post_content' => $post_content, 
          'post_title' => $post_title,
          'post_type' => $post_type,
          'post_status'=>'draft'
        );

    $post_id = wp_insert_post($new_post);
    // email to admin

 $rows=$_POST['rows'];
//  $order_id_email=$_POST['id'];
//  print_r($rows);
 if(count($rows)>0){
    $html='';
    $html.='<h4>Order No: '.$post_id.'</h4>
    <table style="border-collapse: collapse;">';

        $th = '
        <tr>
            <th style="border: 1px solid #4b4a4a;padding: 6px;">Product type</th>
            <th style="border: 1px solid #4b4a4a;">Heater</th>
            <th style="border: 1px solid #4b4a4a;">Model (Qty)</th>
            <th style="border: 1px solid #4b4a4a;">Flue Kit(Qty)</th>
            <th style="border: 1px solid #4b4a4a;">Thermostat(Qty)</th>
            <th style="border: 1px solid #4b4a4a;">Accessory(Qty)</th>
        </tr>
        ';
        $ths = '
        <tr>
            <th style="border: 1px solid #4b4a4a;padding: 6px;">Product type</th>
            <th style="border: 1px solid #4b4a4a;">Class</th>
            <th style="border: 1px solid #4b4a4a;">Model</th>
            <th style="border: 1px solid #4b4a4a;">Color</th>
            <th style="border: 1px solid #4b4a4a;">Qty</th>
            <th style="border: 1px solid #4b4a4a;">Accessory(Qty)</th>
        </tr>
        ';
    

 $last_type = '';
    foreach ($rows as $key => $value) { // class
        if (!$last_type) {
            $last_type = $value['type'];

            if ($value['type'] == 'Heating') {
                $html.=$th ;
            }
            if ($value['type'] == 'Cooling') {
                $html.=$ths ;
            }

        }

        if($last_type != $value['type']){

            if ($value['type'] == 'Heating') {
                $html.=$th ;
            }
            if ($value['type'] == 'Cooling') {
                $html.=$ths ;
            }
        }

        $html.=' 
        <tr>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['type'].'</td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['heater'].$value['class'].'</td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['model'];
                $models=$value['models'];
                foreach ($models as $mkey => $mv){
                    $html.= '
                <p>'.$mv['model'].' <br> <b>Qty</b>: '.$mv['qty'].'</p>';

                };
            $html.= '
            </td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['color'];
                $fule_kits=$value['fule_kits'];
                foreach ($fule_kits as $fkey => $kit){
                    $html.= '
                <p>'.$kit['kit'].' <br> <b>Qty</b>: '.$kit['qty'].'</p>';

                };
            $html.= '
            </td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['qty'];
                $thermostats=$value['thermostats'];
                foreach ($thermostats as $tkey => $thermostat){
                    $html.= '
                <p>'.$thermostat['thermostat'].'  <br> <b>Qty</b>: '.$thermostat['qty'].'</p>';

                };
            $html.= '
            </td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">';
                $accessories=$value['cooler_accessories'];
                foreach ($accessories as $ckey => $acc){
                    $html.= '
                <p>'.$acc['accessories'].' <br> <b>Qty</b>: '.$acc['qty'].'</p>';

                };
                $h_accessories=$value['heater_accessories'];
                foreach ($h_accessories as $hkey => $acc){
                    $html.= '
                <p>'.$acc['accessories'].'  <br> <b>Qty</b>: '.$acc['qty'].'</p>';

                };
            $html.= '
            </td>
        </tr>';
        $last_type = $value['type'];
     }// end foreach

     $html.='</tbody>
</table>';
    // $to = 'tanvirmdalamint@gmail.com';

    $to=get_bloginfo('admin_email');
    $subject = 'New product order from the dealer.';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $html, $headers );
    }
    echo 'ok';

    exit();
}

add_action("wp_ajax_form_process", "form_process");
add_action("wp_ajax_nopriv_form_process", "form_process");


// View Order Data Short Code
add_shortcode('order-data','order_data_fun');
function order_data_fun(){
ob_start(); 

?>

<table>
    <thead>
        <tr>
            <td>Order No.</td>
            <td>Order Date</td>
            <td>Received type</td>
            <!-- <td>the_excerpt();</td> -->
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $args = array(  
            'post_type' => 'dealer-order',
            'post_author' => get_current_user_id(),
            'posts_per_page' => 50, 
            'orderby' => 'ID', 
            'order' => 'DESC', 
            'post_status'=>'draft'
        );
        
        $loop = new WP_Query( $args ); 
        //    print_r($loop); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
        $current_post_id = get_the_ID();
        // $excerptData = json_encode($_POST);
        
        //  $order_id=$_POST['id'];
        $content_post = get_post($current_post_id);
        $contents = $content_post->post_content; // echo $contents; equal the_excerpt();

        $datas = json_decode($contents,true);

        ?>
        <tr>
            <td><?php echo $current_post_id; ?></td>
            <td><?=get_the_date('d/m/Y')?></td>
            <td><?php echo $datas['delivery'];  ?></td>
            <!-- <td><?php // echo $contents;  ?></td> -->
            <td>
            <button type="button" onclick="details(<?php echo $current_post_id; ?>)" class="Click-here">Details</button>
            </td>
        </tr>
        <?php
    endwhile;
    wp_reset_postdata(); ?>
    </tbody>
</table>

<!-- Add Popup section Start Now-->
<div class="popup-wrap">
	<!-- <div class="Click-here">Details</div> -->
	<div class="popup-model-main">
		<div class="popup-model-inner">
			<div class="close-btn">×</div>
			<div class="popup-model-wrap">
				<div class="pop-up-content-wrap" id="order_details">
					

				</div>
			</div>
		</div>
		<div class="bg-overlay"></div>
	</div>

</div>
<!-- Popup section The end -->
    
<?php
    return ob_get_clean();
}

// Details data ajax prosses

function get_data() {
 $order_id=$_POST['id'];
 $content_post = get_post($order_id);
 $content = $content_post->post_content;

 $data = json_decode($content,true);
 $rows=$data['rows'];

//  print_r($rows);
 if(count($rows)>0){
?>
<h4>Order No: <?= $order_id;?></h4>
<table>
    <thead>
        <?php 
        $th = '
        <tr>
            <th>Product type</th>
            <th>Heater</th>
            <th>Model (Qty)</th>
            <th>Flue Kit(Qty)</th>
            <th>Thermostat(Qty)</th>
            <th>Accessory(Qty)</th>
        </tr>
        ';
        $ths = '
        <tr>
            <th>Product type</th>
            <th>Class</th>
            <th>Model</th>
            <th>Color</th>
            <th>Qty</th>
            <th>Accessory(Qty)</th>
        </tr>
        ';
        ?>
    </thead>
    <tbody>
<?php
 $last_type = '';
    foreach ($rows as $key => $value) { // class
        if (!$last_type) {
            $last_type = $value['type'];

            if ($value['type'] == 'Heating') {
                echo $th ;
            }
            if ($value['type'] == 'Cooling') {
                echo $ths ;
            }

        }

        if($last_type != $value['type']){

            if ($value['type'] == 'Heating') {
                echo $th ;
            }
            if ($value['type'] == 'Cooling') {
                echo $ths ;
            }
        }

        echo ' 
        <tr>
            <td>'.$value['type'].'</td>
            <td>'.$value['heater'].$value['class'].'</td>
            <td>'.$value['model'];
                $models=$value['models'];
                foreach ($models as $mkey => $mv){
                    echo '
                <p>'.$mv['model'].' <br><b>Qty</b>: '.$mv['qty'].'</p>';

                };
            echo '
            </td>
            <td>'.$value['color'];
                $fule_kits=$value['fule_kits'];
                foreach ($fule_kits as $fkey => $kit){
                    echo '
                <p>'.$kit['kit'].' <br><b>Qty</b>: '.$kit['qty'].'</p>';

                };
            echo '
            </td>
            <td>'.$value['qty'];
                $thermostats=$value['thermostats'];
                foreach ($thermostats as $tkey => $thermostat){
                    echo '
                <p>'.$thermostat['thermostat'].' <br> <b>Qty</b>: '.$thermostat['qty'].'</p>';

                };
            echo '
            </td>
            <td>';
                $accessories=$value['cooler_accessories'];
                foreach ($accessories as $ckey => $acc){
                    echo '
                <p>'.$acc['accessories'].' <br> <b>Qty</b>: '.$acc['qty'].'</p>';

                };
                $h_accessories=$value['heater_accessories'];
                foreach ($h_accessories as $hkey => $acc){
                    echo '
                <p>'.$acc['accessories'].' <br> <b>Qty</b>: '.$acc['qty'].'</p>';

                };
            echo '
            </td>
        </tr>';
        $last_type = $value['type'];
     }

     ?>
     
    </tbody>
</table>
     <?php
 }


    exit();
}

add_action("wp_ajax_get_data", "get_data");
add_action("wp_ajax_nopriv_get_data", "get_data");

// WP Dashboard menu registation

add_action("admin_menu", "orders_datatable_admin_page");
function orders_datatable_admin_page() {
    add_menu_page(
        __('Dealer Orders', 'tabledata'),
        __('Dealer Orders', 'tabledata'),
        'manage_options', //  dashicons-list-view 'menu_icon'   => 'dashicons-products',
        'dbdemo',
        'dealer_orders_page'
    );
}

function dealer_orders_page() {
    global $wpdb;
    // nonce checking
    if(isset($_GET['pid'])) {
        // if(!isset($_GET['n']) || !wp_verify_nonce($_GET['n'], "dbdemo_edit")){
        //     $wpdb->delete("{$wpdb->prefix}posts", ['ID'=> sanitize_key($_GET['pid'])]);
        //     $_GET['pid'] = null;
        //     wp_die(__("Sorry you are not authorized to do this", "database-demo"));
        // }

        if(isset($_GET['action']) && $_GET['action']=='delete'){
            $wpdb->delete("{$wpdb->prefix}posts", ['ID'=> sanitize_key($_GET['pid'])]);
            $_GET['pid'] = null;
        }

    }
    echo "<h2>Dealer Orders</h2>";
    ?>

<style>
    
  /*Table Order Details popup css Start now*/
    .popup-wrap {
        font: normal 14px/100% "Andale Mono", AndaleMono, monospace;
        width: 300px;
        margin: 0 auto;
        display:flex;
        align-items:center;
    /*   height:100vh; */
    }
    .Click-here {
        cursor: pointer;
        transition:background-image 3s ease-in-out;
    }
    
    .popup-model-main {
        text-align: center;
        overflow: hidden;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0; /* z-index: 1050; */
        -webkit-overflow-scrolling: touch;
        outline: 0;
        opacity: 0;
        -webkit-transition: opacity 0.15s linear, z-index 0.15;
        -o-transition: opacity 0.15s linear, z-index 0.15;
        transition: opacity 0.15s linear, z-index 0.15;
        z-index: -1;
        overflow-x: hidden;
        overflow-y: auto;
    }
    
    .model-open {
        z-index: 99999;
        opacity: 1;
        overflow: hidden;
    }
    .popup-model-inner {
        -webkit-transform: translate(0, -25%);
        -ms-transform: translate(0, -25%);
        transform: translate(0, -25%);
        -webkit-transition: -webkit-transform 0.3s ease-out;
        -o-transition: -o-transform 0.3s ease-out;
        transition: -webkit-transform 0.3s ease-out;
        -o-transition: transform 0.3s ease-out;
        transition: transform 0.3s ease-out;
        transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
        display: inline-block;
        vertical-align: middle;
        width: 1100px;
        margin: 30px auto;
        max-width: 97%;
    }
    .popup-model-wrap {
        display: block;
        width: 100%;
        position: relative;
        background-color: #fff;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        background-clip: padding-box;
        outline: 0;
        text-align: left;
        padding: 20px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        max-height: calc(100vh - 70px);
        overflow-y: auto;
    }
    
    .pop-up-content-wrap p, .pop-up-content-wrap ol li {
        color: #000000;
        font-style:normal;
        text-transform:none;
        font-family: 'Lato';
        font-weight: 400;
        letter-spacing: normal;
        vertical-align: baseline;
        word-spacing: 0px;
        font-size: 16px;
        line-height:24px;
        margin-bottom: 0.5em;
    }
    .pop-up-content-wrap h3 {
        font-size: 20px;
        line-height: 1.28205em;
        margin-top: 1.28205em;
        margin-bottom: 1.28205em;
    }
    .model-open .popup-model-inner {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        transform: translate(0, 0);
        position: relative;
        z-index: 999;
    }
    .model-open .bg-overlay {
        background: #000000;
        z-index: 99;
        opacity: 0.85;
    }
    .bg-overlay {
        background: rgba(0, 0, 0, 0);
        height: 100vh;
        width: 100%;
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        -webkit-transition: background 0.15s linear;
        -o-transition: background 0.15s linear;
        transition: background 0.15s linear;
    }
    .close-btn {
        position: absolute;
        right: 0;
        top: -30px;
        cursor: pointer;
        z-index: 99;
        font-size: 30px;
        color: #fff;
    }


    .pop-up-content-wrap td p {
        font-size: 12px !important;
        color: #7a7a7a !important;
        margin: 0 !important;
        font-family: 'Roboto';
        font-weight: normal;
        line-height: 1.6em;
    }

    .admin-popup tr td, .admin-popup tr th {
        border: 1px solid #c0c5c0;
        padding: 5px;
    }
    .admin-popup table {
        border-collapse: collapse;
    }
    .admin-popup tr th {
        background: #def1e1;
    }

  /*Table Order Details popup css The end*/

  button.Click-here.bg-btn {
        padding: 6px 12px;
        background: #039347;
        border: 0;
        border-radius: 3px;
        color: #fff;
        cursor: pointer;
    }

    button.Click-here.bg-btn:hover {
        color: #fddd00;
    }



</style>

<table>
    <tbody>
    <?php 
        //  {$wpdb->prefix}posts
        
            global $wpdb;
            $dbdemo_users = $wpdb->get_results("SELECT ID, post_content, post_date, post_title FROM {$wpdb->prefix}posts where post_type='dealer-order' ORDER BY id DESC", ARRAY_A);

            // print_r($dbdemo_users);
            $dbtu = new DBTableOrder($dbdemo_users);
            $dbtu->prepare_items();
            $dbtu->display();
        ?>
    </tbody>
</table>

<!-- Add Popup section Start Now-->
<div class="popup-wrap">
	<!-- <div class="Click-here">Details</div> -->
	<div class="popup-model-main">
		<div class="popup-model-inner">
			<div class="close-btn">×</div>
			<div class="popup-model-wrap">
				<div class="pop-up-content-wrap admin-popup" id="order_details">
					

				</div>
			</div>
		</div>
		<div class="bg-overlay"></div>
	</div>

</div>
<!-- Popup section The end -->

    <?php
}

add_action('admin_footer', function(){

    ?>


<script>
    function details(id) {
        jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {action: "get_data", id: id}, function(response) {
            jQuery("#order_details").html(response);
            jQuery(".Click-here").on('click', function() {
                jQuery(".popup-model-main").addClass('model-open');
                }); 
                jQuery(".close-btn, .bg-overlay").click(function(){
                    jQuery(".popup-model-main").removeClass('model-open');
                });
        });
    
    }
</script>
    <?php
});

