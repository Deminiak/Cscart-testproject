<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_validate_ip($ip, $show_error = false)
{
    if (empty($ip)) {
        return false;
    }

    $_ip = ip2long($ip);
    if (!empty($_ip) && $_ip != ip2long('')) {
        return true;
    } elseif ($show_error) {
        fn_set_notification('E', __('error'), __('text_not_valid_ip', array(
            '[ip]' => $ip
        )));
    }

    return false;
}

function fn_validate_domain_name($name, $show_error = false)
{
    if (empty($name)) {
        return false;
    }

    if (preg_match('/^([?*-a-z0-9]+\.)+([*?a-z]{2,4}|[*]+)$/i', $name) || fn_validate_ip($name)) {
        return true;
    } elseif ($show_error) {
        fn_set_notification('E', __('error'), __('text_not_valid_domain', array(
            '[domain]' => $name
        )));
    }

    return false;
}

// Please note this function only validate the cc number LENGTH
function fn_validate_cc_number($number, $show_error = false)
{
    if (empty($number)) {
        return false;
    }

    $number = str_replace(array('-',' '), '', $number);

    if (preg_match('/^([?0-9]{13,19}|[?*\d]+)$/', $number)) {
        return true;
    } elseif ($show_error) {
        fn_set_notification('E', __('error'), __('text_not_valid_cc_number', array(
            '[cc_number]' => $number
        )));
    }

    return false;
}

function fn_card_number_is_blocked($number)
{
    $number = str_replace(array('-',' '), '', $number);
    $restricted = db_get_field("SELECT COUNT(*) FROM ?:access_restriction WHERE type = 'cc' AND status = 'A' AND ?s LIKE REPLACE(REPLACE(value, '?', '_'), '*', '%')", $number);

    return !empty($restricted);
}

function fn_email_is_blocked($user_data, $reset_email = false)
{
    $auth = & Tygh::$app['session']['auth'];

    // FIXME: unassigned $user_data['email'] when trying to change admin pass. login by e-mail == on, admin must change pass on first login == on
    $user_data['email'] = isset($user_data['email']) ? $user_data['email'] : '';
    $email = trim($user_data['email']);

    if (!fn_validate_email($email, false)) {
        return false;
    }

    $restricted = db_get_field("SELECT COUNT(*) FROM ?:access_restriction WHERE type IN ('ed', 'es') AND status = 'A' AND ?s LIKE REPLACE(REPLACE(REPLACE(value, '_', '\_'), '?', '_'), '*', '%')", $email);

    if (!empty($restricted)) {
        if ($reset_email && $auth) {
            $uid = (AREA == 'C' || empty($_REQUEST['user_id'])) ? $auth['user_id'] : $_REQUEST['user_id'];
            $_POST['user_data']['email'] = db_get_field("SELECT email FROM ?:users WHERE user_id = ?i", $uid);
        }

        fn_set_notification('E', __('error'), __('text_email_is_blocked', array(
            '[email]' => $user_data['email']
        )));

        return true;
    }

    return false;
}

function fn_domain_is_blocked($domain)
{
    $restricted = db_get_field("SELECT COUNT(*) FROM ?:access_restriction WHERE type='d' AND status = 'A' AND ?s LIKE REPLACE(REPLACE(REPLACE(value, '_', '\_'), '?', '_'), '*', '%')", $domain);

    if (!empty($restricted)) {
        die(__('text_ips_denied'));
    }

    return false;
}

function fn_access_restrictions_redirect()
{
    $auth = & Tygh::$app['session']['auth'];

    $ip = fn_get_ip(true);
    $ip = array_filter($ip);

    if (Registry::get('runtime.mode') == 'login' && Registry::get('runtime.controller') == 'auth' && empty($auth['user_id'])) {
        $ip_exist = db_get_row("SELECT * FROM ?:access_restriction_block WHERE ip IN (?n)", $ip);
        $login_interval = (AREA == 'A') ? Registry::get('addons.access_restrictions.login_intervals') : Registry::get('addons.access_restrictions.login_intervals_customer');
        if ($ip_exist && $ip_exist['expires'] > TIME) {
            $ip_exist['tries'] ++;
            $ip_exist['expires'] += $login_interval;
            db_query('UPDATE ?:access_restriction_block SET ?u WHERE ip IN (?n)', $ip_exist, $ip);
        } else {
            $ip_data = array_map(function($ip_item) use ($login_interval) {
                return array(
                    'ip'        => $ip_item,
                    'tries'     => 1,
                    'timestamp' => TIME,
                    'expires'   => (TIME + $login_interval),
                );
            }, $ip);

            if (!empty($ip_data)) {
                db_query('REPLACE INTO ?:access_restriction_block ?m', $ip_data);
            }
        }
    } elseif (Registry::get('runtime.mode') == 'login' && Registry::get('runtime.controller') == 'auth' && !empty($auth['user_id'])) {
        db_query("DELETE FROM ?:access_restriction_block WHERE ip IN (?n)", $ip);
    }

    return true;
}

function fn_access_restrictions_user_init(&$auth, &$user_info)
{
    $ip = fn_get_ip(true);
    $acc_r = Registry::get('addons.access_restrictions');

    // Get block ip settings, if it should be blocked then add it to the restricted ips
    if ((AREA == 'A' && $acc_r['unsuccessful_attempts_login'] == 'Y') || (AREA != 'A' && $acc_r['unsuccessful_attempts_login_customer'] == 'Y')) {
        $block_condition = db_quote('ip >= ?i', $ip['host']);
        if ($ip['proxy']) {
            $block_condition .= db_quote(' OR ip >= ?i', $ip['proxy']);
        }
        $block = db_get_row("SELECT * FROM ?:access_restriction_block WHERE (?p)", $block_condition);
        $failed_atempts = (AREA == 'A') ? $acc_r['number_unsuccessful_attempts'] : $acc_r['number_unsuccessful_attempts_customer'];
        if (!empty($block) && $block['tries'] >= $failed_atempts) {
            $time_block = (AREA == 'A') ? $acc_r['time_block'] : $acc_r['time_block_customer'];

            foreach(array_filter($ip) as $ip_item) {
                $restrict_ip = array(
                    'ip_from'   => $ip_item,
                    'ip_to'     => $ip_item,
                    'type'      => ((AREA == 'A') ? 'aab' : 'ipb'),
                    'timestamp' => TIME,
                    'expires'   => (TIME + round($time_block * SECONDS_IN_HOUR)),
                    'status'    => 'A',
                );

                $__data['item_id'] = db_query("REPLACE INTO ?:access_restriction ?e", $restrict_ip);
                $__data['type'] = ((AREA == 'A') ? 'aab' : 'ipb');

                foreach (fn_get_translation_languages() as $__data['lang_code'] => $v) {
                    $__data['reason'] = __('text_ip_blocked_failed_login', array("[number]" => $failed_atempts), $__data['lang_code']);
                    db_query("REPLACE INTO ?:access_restriction_reason_descriptions ?e", $__data);
                }
            }

            db_query("DELETE FROM ?:access_restriction_block WHERE ip = ?i", $block['ip']);
        }
    }

    db_query("DELETE FROM ?:access_restriction_block WHERE expires < ?i", TIME);
    db_query("DELETE FROM ?:access_restriction WHERE (type = 'ipb' OR type = 'aab') AND expires < ?i", TIME);

    $type_condition = (AREA != 'A') ? "a.type IN ('ips', 'ipr', 'ipb')" : "a.type IN ('aas', 'aar', 'aab')";
    $ip_condition = db_quote('ip_from <= ?i AND ip_to >= ?i', $ip['host'], $ip['host']);
    if ($ip['proxy']) {
        if (AREA == 'A' && $acc_r['admin_reverse_ip_access'] == 'Y') {
            $ip_condition = db_quote(' ip_from <= ?i AND ip_to >= ?i', $ip['proxy'], $ip['proxy']);
        } else {
            $ip_condition .= db_quote(' OR ip_from <= ?i AND ip_to >= ?i', $ip['proxy'], $ip['proxy']);
        }
    }

    $restricted = db_get_row("SELECT a.item_id, b.reason FROM ?:access_restriction as a LEFT JOIN ?:access_restriction_reason_descriptions as b ON a.item_id = b.item_id AND a.type = b.type AND lang_code = ?s WHERE (?p) AND ?p AND status = 'A'", CART_LANGUAGE, $ip_condition, $type_condition);

    if ($restricted && (AREA != 'A' || $acc_r['admin_reverse_ip_access'] != 'Y')) {
        die((!empty($restricted['reason']) ? $restricted['reason'] : __('text_ip_is_blocked')));
    } elseif (!$restricted && $acc_r['admin_reverse_ip_access'] == 'Y' && AREA == 'A') {
        die(__('text_ips_denied'));
    }

    // Check for domain restrictions
    $is_domain_restricted = db_get_field("SELECT COUNT(*) FROM ?:access_restriction WHERE type='d' AND status = 'A'");
    if ($is_domain_restricted && empty(Tygh::$app['session']['access_domain'])) {
        $ip = fn_get_ip();
        $domain = gethostbyaddr($ip['host']);
        fn_domain_is_blocked($domain);
        if ($ip['proxy']) {
            fn_domain_is_blocked(fn_domain_is_blocked(gethostbyaddr($ip['proxy'])));
        }
        Tygh::$app['session']['access_domain'] = $domain;
    }
}
