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
use Tygh\Bootstrap;
use Tygh\Languages\Languages;

if ( !defined('AREA') ) { die('Access denied'); }

function fn_rus_cities_install()
{
    $path = Registry::get('config.dir.root') . '/app/addons/rus_cities/database/cities.csv';
    fn_rus_cities_read_cities_by_chunk($path, RUS_CITIES_FILE_READ_CHUNK_SIZE, 'fn_rus_cities_add_cities_in_table');
}

/**
 * Gets the list cities on parameters.
 *
 * @param array  $params         The parameters for search of cities.
 * @param int    $items_per_page Items per page.
 * @param string $lang_code      The language code (e.g. 'en', 'ru', etc.).
 *
 * @return array The cities list and the search params.
 */
function fn_get_cities($params = array(), $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
    $condition = '';
    $limit = '';

    // Set default values to input params
    $default_params = array (
        'page' => 1,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $fields = array(
        '?:rus_cities.city_id',
        '?:rus_cities.country_code',
        '?:rus_cities.state_code',
        '?:rus_cities.status',
        '?:rus_city_descriptions.city',
    );

    $join = db_quote(
        ' LEFT JOIN ?:rus_city_descriptions'
        . ' ON ?:rus_city_descriptions.city_id = ?:rus_cities.city_id'
    );

    /**
     * Prepares params for SQL query before getting list cities.
     *
     * @param array  $params         The parameters for seorch of cities.
     * @param int    $items_per_page Items per page.
     * @param string $lang_code      The language code (e.g. 'en', 'ru', etc.).
     * @param string  $fields    Array of fields to be selected.
     * @param string  $condition Array of complete condition expressions to be applied to the end of an SQL-query.
     * @param string  $join      List of strings with the complete JOIN information (JOIN type, tables and fields) for an SQL-query.
     */
    fn_set_hook('get_cities_pre', $params, $items_per_page, $lang_code, $fields, $condition, $join);

    if (!empty($params['country_code'])) {
        $condition .= db_quote(' AND ?:rus_cities.country_code = ?s', $params['country_code']);
    }

    if (!empty($params['state_code'])) {
        $condition .= db_quote(' AND ?:rus_cities.state_code = ?s', $params['state_code']);
    }

    if (!empty($params['q'])) {
        $condition .= db_quote(' AND ?:rus_city_descriptions.city LIKE ?l', '%' . $params['q'] . '%');
    }

    if (!empty($params['status'])) {
        $condition .= db_quote(' AND ?:rus_cities.status = ?s', $params['status']);
    }

    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field('SELECT COUNT(*) FROM ?:rus_cities ?p WHERE ?:rus_city_descriptions.lang_code = ?s ?p', $join, $lang_code, $condition);
        $limit = db_paginate($params['page'], $params['items_per_page']);
    }

    $cities = db_get_array(
        'SELECT ?p FROM ?:rus_cities ?p WHERE ?:rus_city_descriptions.lang_code = ?s ?p ORDER BY ?:rus_city_descriptions.city ?p',
        implode(', ', $fields),
        $join,
        $lang_code,
        $condition,
        $limit
    );

    /**
     * Changes data on the list cities.
     *
     * @param string  $cities    The array with the city data.
     */
    fn_set_hook('get_cities_post', $params, $items_per_page, $lang_code, $cities);

    return array($cities, $params);
}

/**
 * Updates the city data for the `rus_cities`, `rus_city_descriptions` tables.
 *
 * @param array   $city_data The array with the city data.
 * @param int     $city_id   The identifiers of city.
 * @param string  $lang_code Language code.
 *
 * @return int The identifiers of city.
 */
function fn_update_city($city_data, $city_id = 0, $lang_code = DESCR_SL)
{
    $city = $city_descriptions = array();

    if (!empty($city_data['country_code'])) {
        $city['country_code'] = $city_data['country_code'];
    }

    if (!empty($city_data['state_code'])) {
        $city['state_code'] = $city_data['state_code'];
    }

    if (!empty($city_data['city'])) {
        $city_descriptions['city'] = $city_data['city'];
    }

    if (!empty($city_id)) {
        if (!empty($city)) {
            db_query('UPDATE ?:rus_cities SET ?u WHERE city_id = ?i', $city, $city_id);
        }

        if (!empty($city_descriptions)) {
            db_query('UPDATE ?:rus_city_descriptions SET ?u WHERE city_id = ?i AND lang_code = ?s', $city_descriptions, $city_id, $lang_code);
        }

    } else {
        $languages = Languages::getAll();

        if (!empty($city)) {
            $city_id = db_replace_into('rus_cities', $city);

            $city_descriptions['city_id'] = $city_id;

            foreach ($languages as $city_descriptions['lang_code'] => $language) {
                db_replace_into('rus_city_descriptions', $city_descriptions);
            }
        }
    }

    /**
     * Updates the city data.
     *
     * @param array   $city_data The array with the city data.
     * @param int     $city_id   The identifiers of city.
     * @param string  $lang_code Language code.
     */
    fn_set_hook('update_city_post', $city_data, $city_id, $lang_code);

    return $city_id;
}

/**
 * Finds the cities by the parameters.
 *
 * @param array $params The array with the parameters for find cities.
 *
 * @return array The array the list cities.
 */
function fn_rus_cities_find_cities($params, $lang_code = CART_LANGUAGE)
{
    $condition = '';
    $prefix = explode(',', __('addons.rus_cities.city_prefix'));

    if (empty($params['q'])) {
        return array();
    }

    $params['q'] = str_replace($prefix, '', $params['q']);
    $search = trim($params['q']) . '%';

    if (!empty($params['check_country'])) {
        $condition .= db_quote(' AND ?:countries.code = ?s', $params['check_country']);
    }

    if (!empty($params['check_state'])) {
        $condition .= db_quote(' AND ?:states.code = ?s', $params['check_state']);
    }

    $cities = db_get_array(
        'SELECT DISTINCT ?:country_descriptions.country, ?:state_descriptions.state, ?:rus_city_descriptions.city, ?:rus_cities.city_id'
        . ' FROM ?:rus_city_descriptions'
        . ' LEFT JOIN ?:rus_cities'
            . ' ON ?:rus_cities.city_id = ?:rus_city_descriptions.city_id'
        . ' LEFT JOIN ?:countries'
            . ' ON ?:rus_cities.country_code = ?:countries.code'
        . ' LEFT JOIN ?:country_descriptions'
            . ' ON ?:countries.code = ?:country_descriptions.code AND ?:country_descriptions.lang_code = ?s'
        . ' LEFT JOIN ?:states'
            . ' ON ?:rus_cities.state_code = ?:states.code AND ?:countries.code = ?:states.country_code'
        . ' LEFT JOIN ?:state_descriptions'
            . ' ON ?:states.state_id = ?:state_descriptions.state_id AND ?:state_descriptions.lang_code = ?s'
        . ' WHERE ?:countries.status = ?s AND ?:states.status = ?s AND city LIKE ?l AND ?:rus_city_descriptions.lang_code = ?s AND ?:rus_cities.status = ?s ?p'
        . ' LIMIT 10',
        $lang_code,
        $lang_code,
        'A',
        'A',
        $search,
        $lang_code,
        'A',
        $condition
    );

    return $cities;
}

/**
 * Gets the list cities in the correct formats.
 *
 * @param array $cities The array the list cities.
 *
 * @return array The array cities.
 */
function fn_rus_cities_format_to_autocomplete($cities)
{
    $list_cities = array();

    if (!empty($cities)) {
        foreach ($cities as $city) {
            $list_cities[] = array(
                'code' => $city['city_id'],
                'value' => $city['city'],
                'label' => $city['city'] . ', ' . $city['state'],
                'country' => $city['country']
            );
        }
    }

    return $list_cities;
}

/**
 * Gets the cities identificators by city name.
 *
 * @param array  $params     The array with the parameters for find the cities identificators.
 * @param string $lang_code  Language code.
 *
 * @return array The array the cities identificators.
 */
function fn_rus_cities_get_city_ids($city, $state, $country, $lang_code = CART_LANGUAGE)
{
    $condition = '';

    if (!empty($state)) {
        $condition .= db_quote(' AND ?:rus_cities.state_code = ?s', $state);
    }
    if (!empty($country)) {
        $condition .= db_quote(' AND ?:rus_cities.country_code = ?s', $country);
    }

    $cities = db_get_fields(
        'SELECT ?:rus_cities.city_id'
        . ' FROM ?:rus_city_descriptions'
        . ' LEFT JOIN ?:rus_cities'
            . ' ON ?:rus_city_descriptions.city_id = ?:rus_cities.city_id'
        . ' WHERE ?:rus_city_descriptions.city = ?s AND ?:rus_cities.status = ?s AND lang_code = ?s ?p',
        $city,
        'A',
        $lang_code,
        $condition
    );

    return $cities;
}

/**
 * Reads the csv of file for upload the cities data.
 *
 * @param string $path               The name file.
 * @param int    $size               The maximum number the rows upload.
 * @param string $function_callback  The name of function.
 *
 * @return void.
 */
function fn_rus_cities_read_cities_by_chunk($path, $size, $function_callback)
{
    $rows = array();
    $max_line_size = 165536;
    $delimiter = ',';

    if (!file_exists($path)) {
        return false;
    }

    $cities_file = fopen($path, 'rb');
    if (!$cities_file) {
        return false;
    }

    $import_schema = fgetcsv($cities_file, $max_line_size, $delimiter);
    $schema_size = sizeof($import_schema);
    $skipped_lines = array();
    $line_it = 1;

    while (($data = fn_fgetcsv($cities_file, $max_line_size, $delimiter)) !== false) {
        $line_it++;

        if (fn_is_empty($data)) {
            continue;
        }

        if (sizeof($data) != $schema_size) {
            $skipped_lines[] = $line_it;
            continue;
        }

        $data = str_replace(array('\r', '\n', '\t', '"'), '', $data);
        $row = array_combine($import_schema, Bootstrap::stripSlashes($data));

        $row['City'] = (string) trim($row['City']);

        $rows[] = $row;

        if (count($rows) == $size) {
            call_user_func($function_callback, $rows);

            $rows = array();
        }
    }

    if (!empty($rows)) {
        call_user_func($function_callback, $rows);
    }
}

/**
 * Adds the cities data in the table.
 *
 * @param string $path The path to the file.
 *
 * @return array The array with the cities.
 */
function fn_rus_cities_add_cities_in_table($rows)
{
    static $languages;

    if (is_null($languages)) {
        $languages = Languages::getAll();
    }

    foreach ($rows as $city_data) {
        $city_data['City'] = (string) trim($city_data['City']);

        $city = array(
            'country_code' => $city_data['Country'],
            'state_code' => $city_data['OblName'],
            'status' => 'A'
        );

        $city_id = db_replace_into('rus_cities', $city);

        $city_description = array(
            'city' => $city_data['City'],
            'city_id' => $city_id
        );

        foreach ($languages as $city_description['lang_code'] => $lang_data) {
            db_replace_into('rus_city_descriptions', $city_description);
        }
    }
}

/**
 * Gets the full of list cities.
 *
 * @param array $rows The array with cities data.
 *
 * @return array The array with cities.
 */
function fn_rus_cities_get_all_cities($rows)
{
    $cities_data = array();
    $countries = $states = $cities = array();

    foreach ($rows as $row) {
        $countries[] = $row['Country'];
        $states[] = $row['OblName'];
        $cities[] = $row['City'];
    }

    $countries = array_unique($countries);
    $states = array_unique($states);
    $cities = array_unique($cities);

    $cities_list = db_get_array(
        'SELECT a.city_id, country_code, state_code, city'
        . ' FROM ?:rus_cities as a LEFT JOIN ?:rus_city_descriptions as b ON a.city_id = b.city_id'
        . ' WHERE country_code IN (?a) AND state_code IN (?a) AND city IN (?a)',
        $countries, $states, $cities
    );

    foreach ($cities_list as $city_list) {
        $city = fn_strtolower($city_list['city']);
        $cities_data[$city_list['country_code']][$city_list['state_code']][$city] = $city_list['city_id'];
    }

    return $cities_data;
}

/**
 * Deletes the city by city identifier.
 *
 * @param int $city_id The city identifier.
 *
 * @return void
 */
function fn_rus_cities_delete_city($city_id)
{
    db_query('DELETE FROM ?:rus_cities WHERE city_id = ?i', $city_id);
    db_query('DELETE FROM ?:rus_city_descriptions WHERE city_id = ?i', $city_id);

    /**
     * Deletes the city data.
     *
     * @param int $city_id The city identifier.
     */
    fn_set_hook('delete_city_post', $city_id);
}