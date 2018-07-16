<?php


function fn_status_history_get($limit) {
    $returnlist = db_get_array('SELECT ' ."*". " FROM ?:status_history LIMIT $limit");
    foreach ($returnlist as $k => $order) {
        $returnlist[$k]['username'] = fn_get_user_name($order['user_id']);
    }
return $returnlist;
}