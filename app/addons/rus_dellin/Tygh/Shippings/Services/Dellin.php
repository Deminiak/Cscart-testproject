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

namespace Tygh\Shippings\Services;

use Tygh\Shippings\IService;
use Tygh\Registry;
use Tygh\Http;
use Tygh\Bootstrap;

/**
 * Dellin shipping service
 */
class Dellin implements IService
{
    /**
     * Abailability multithreading in this module
     *
     * @var bool $_allow_multithreading
     */
    private $_allow_multithreading = false;

    /**
     * Current Company id environment
     *
     * @var int $company_id
     */
    public $company_id = 0;

    public $session_id = 0;

    public $url_params = array(
        'headers' => array('Content-Type: application/json'),
        'timeout' => 5
    );

    /**
     * Checks if shipping service allows to use multithreading
     *
     * @return bool true if allow
     */
    public function allowMultithreading()
    {
        return $this->_allow_multithreading;
    }

    /**
     * Gets error message from shipping service server
     *
     * @param  string $resonse Reponse from Shipping service server
     * @return string Text of error or false if no errors
     */
    public function processErrors($return)
    {
        return $return;
    }

    /**
     * Sets data to internal class variable
     *
     * @param array $shipping_info
     */
    public function prepareData($shipping_info)
    {
        $this->_shipping_info = $shipping_info;
        $this->company_id = Registry::get('runtime.company_id');
    }

    /**
     * Prepare request information
     *
     * @return array Prepared data
     */
    public function getRequestData()
    {
        $weight_data = fn_expand_weight($this->_shipping_info['package_info']['W']);
        $shipping_settings = $this->_shipping_info['service_params'];
        $origination = $this->_shipping_info['package_info']['origination'];
        $location = $this->_shipping_info['package_info']['location'];
        $packages = fn_get_schema('dellin', 'packages', 'php', true);
        $services = fn_get_schema('dellin', 'services', 'php', true);
        $symbol_weight = Registry::get('settings.General.weight_symbol_grams');

        $post = array (
            'appKey' => $shipping_settings['appkey']
        );

        if (!empty($shipping_settings['individual_calculator']) && ($shipping_settings['individual_calculator'] == 'Y')) {
            if (!empty($shipping_settings['login']) && !empty($shipping_settings['password'])) {
                $post['login'] = $shipping_settings['login'];
                $post['password'] = $shipping_settings['password'];
            }

            $url_login = "https://api.dellin.ru/v1/customers/login.json";
            $response = Http::post($url_login, json_encode($post), $this->url_params);
            $data_session = (array) json_decode($response);

            if (!empty($data_session['sessionID'])) {
                unset($post['login']);
                unset($post['password']);
                $post['sessionID'] = $data_session['sessionID'];
                $this->session_id = $data_session['sessionID'];
            }
        }

        $post['derivalPoint'] = '';
        if (!empty($origination['city'])) {
            $post['derivalPoint'] = fn_rus_dellin_get_code_city($origination);
        }

        $post['arrivalPoint'] = '';
        if (!empty($location['city'])) {
            $post['arrivalPoint'] = fn_rus_dellin_get_code_city($location);
        }

        $post['derivalDoor'] = ($shipping_settings['derival_door'] == 'Y') ? true : false;
        $post['arrivalDoor'] = ($shipping_settings['arrival_door'] == 'Y') ? true : false;

        if (!empty($packages[$shipping_settings['package']])) {
            $post['packages'] = $packages[$shipping_settings['package']];
        }

        if (!empty($shipping_settings['derival_services'])) {
            foreach ($shipping_settings['derival_services'] as $service) {
                if (!empty($services[$service])) {
                    $post['derivalServices'][] = $services[$service];
                }
            }
        }

        if (!empty($shipping_settings['arrival_services'])) {
            foreach ($shipping_settings['arrival_services'] as $service) {
                if (!empty($services[$service])) {
                    $post['arrivalServices'][] = $services[$service];
                }
            }
        }

        $packages = (!empty($this->_shipping_info['package_info']['packages'])) ? $this->_shipping_info['package_info']['packages'] : array();
        $packages_count = count($packages);

        $weight = round($weight_data['plain'] * $symbol_weight / 1000, 3);
        $size_value = 0;
        $max_length = $max_width = $max_height = 0.01;

        if ($packages_count > 0) {
            $sum_weight = 0;

            $default_height = !empty($shipping_settings['height']) ? $shipping_settings['height'] / 100 : 0.1;
            $default_width = !empty($shipping_settings['width']) ? $shipping_settings['width'] / 100 : 0.1;
            $default_length = !empty($shipping_settings['length']) ? $shipping_settings['length'] / 100 : 0.1;

            foreach ($packages as $id => $package) {
                $product_weight = fn_expand_weight($package['weight']);
                $package_weight = round($product_weight['plain'] * $symbol_weight / 1000, 3);
                $sum_weight += $package_weight;

                $length = !empty($package['shipping_params']['box_length']) ? $package['shipping_params']['box_length'] / 100 : $default_length;
                $width = !empty($package['shipping_params']['box_width']) ? $package['shipping_params']['box_width'] / 100 : $default_width;
                $height = !empty($package['shipping_params']['box_height']) ? $package['shipping_params']['box_height'] / 100 : $default_height;

                $size_value += $length * $width * $height;

                $max_length = max($max_length, $length);
                $max_width = max($max_width, $width);
                $max_height = max($max_height, $height);
            }

            $post['statedValue'] = $this->_shipping_info['package_info']['C'];
            $weight = $sum_weight;
        }

        $post['sizedWeight'] = $weight;
        $post['sizedVolume'] = !empty($size_value) ? $size_value : 0.01;

        $post['length'] = $max_length;
        $post['width'] = $max_width;
        $post['height'] = $max_height;

        $post['quantity'] = (!empty($packages_count)) ? $packages_count : 1;

        $url = 'https://api.dellin.ru/v1/public/calculator.json';
        $request_data = array(
            'method' => 'post',
            'url' => $url,
            'data' => $post,
        );

        return $request_data;
    }

    /**
     * Process simple request to shipping service server
     *
     * @return string Server response
     */
    public function getSimpleRates()
    {
        $data = $this->getRequestData();

        $response = Http::post($data['url'], json_encode($data['data']), $this->url_params);

        return $response;
    }

    /**
     * Gets shipping cost and information about possible errors
     *
     * @param  string $resonse Reponse from Shipping service server
     * @return array  Shipping cost and errors
     */
    public function processResponse($response)
    {
        $return = array(
            'cost' => false,
            'error' => false,
        );
        $shipping_settings = $this->_shipping_info['service_params'];

        $result = json_decode($response);
        $data_dellin = json_decode(json_encode($result), true);

        if (!empty($data_dellin['errors'])) {
            if (is_array($data_dellin['errors'])) {
                foreach ($data_dellin['errors'] as $error) {
                    if (is_array($error)) {
                        foreach ($error as $message) {
                            $return['error'] .= '; ' . $message;
                        }
                    } else {
                        $return['error'] .= '; ' . $error;
                    }
                }
            } else {
                $return['error'] = $data_dellin['errors'];
            }

        } elseif (!empty($data_dellin['price'])) {
            $return['cost'] = $data_dellin['price'];
            $return['delivery_time'] = '1 ' . __('day');
            if (!empty($data_dellin['time']['value'])) {
                $return['delivery_time'] = (!empty($data_dellin['time']['nominative'])) ? $data_dellin['time']['nominative'] : '1 ' . __('day');
            }

            $arrival_terminals = array();
            foreach ($data_dellin['arrival']['terminals'] as $terminal) {
                $arrival_terminals[md5($terminal['name'])] = $terminal;
                $arrival_terminals[md5($terminal['name'])]['code'] = md5($terminal['name']);
            }

            $return['derival_terminals'] = $data_dellin['derival']['terminals'];
            $return['arrival_terminals'] = $arrival_terminals;

            $this->_fillSessionData($return['derival_terminals'], $return['arrival_terminals']);

            if ($shipping_settings['avia_delivery'] && !empty($data_dellin['air']['price'])) {
                $return['cost'] += $data_dellin['air']['price'];
            }

            if ($shipping_settings['small_delivery'] && !empty($data_dellin['small']['price'])) {
                $return['cost'] += $data_dellin['small']['price'];
            }

            if ($shipping_settings['express_delivery'] && !empty($data_dellin['express']['price'])) {
                $return['cost'] += $data_dellin['express']['price'];
            }
        }

        return $return;
    }

    private function _fillSessionData($derival_terminals, $arrival_terminals)
    {
        $group_key = $this->_shipping_info['keys']['group_key'];
        $shipping_id = $this->_shipping_info['keys']['shipping_id'];

        \Tygh::$app['session']['cart']['shippings_extra']['data'][$group_key][$shipping_id] = array(
            'derival_terminals' => $derival_terminals,
            'arrival_terminals' => $arrival_terminals
        );

        return true;
    }

    public function prepareAddress($address)
    {
        
    }

    public static function getInfo()
    {
        return array(
            'name' => __('carrier_dellin'),
            'tracking_url' => 'http://www.dellin.ru/tracker/?rwID=%s'
        );
    }
}
