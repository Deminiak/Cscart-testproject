<?php


function fn_history_get($limit) {
    $returnlist = db_get_array('SELECT ' ."*". " FROM ?:status_history LIMIT $limit");
    foreach ($returnlist as $k => $order) {
        $returnlist[$k]['username'] = fn_get_user_name($order['user_id']);
        if($order['new_status'] == 'Y')
        {
            $returnlist[$k]['new_status']=__("status_history.awaiting_call");
        }
        if($order['new_status'] == 'C')
        {
            $returnlist[$k]['new_status']=__("status_history.success");
        }
        if($order['new_status'] == 'O')
        {
            $returnlist[$k]['new_status']=__("status_history.opened");
        }
        if($order['new_status'] == 'F')
        {
            $returnlist[$k]['new_status']=__("status_history.failure");
        }
        if($order['new_status'] == 'D')
        {
            $returnlist[$k]['new_status']=__("status_history.declined");
        }
        if($order['new_status'] == 'B')
        {
            $returnlist[$k]['new_status']=__("status_history.postponed");
        }
        if($order['new_status'] == 'I')
        {
            $returnlist[$k]['new_status']=__("status_history.cancelled");
        }
        if($order['new_status'] == 'P')
        {
            $returnlist[$k]['new_status']=__("status_history.onwork");
        }
        if($order['old_status'] == 'Y')
        {
            $returnlist[$k]['old_status']=__("status_history.awaiting_call");
        }
        if($order['old_status'] == 'C')
        {
            $returnlist[$k]['old_status']=__("status_history.success");
        }
        if($order['old_status'] == 'O')
        {
            $returnlist[$k]['old_status']=__("status_history.opened");
        }
        if($order['old_status'] == 'F')
        {
            $returnlist[$k]['old_status']=__("status_history.failure");
        }
        if($order['old_status'] == 'D')
        {
            $returnlist[$k]['old_status']=__("status_history.declined");
        }
        if($order['old_status'] == 'B')
        {
            $returnlist[$k]['old_status']=__("status_history.postponed");
        }
        if($order['old_status'] == 'I')
        {
            $returnlist[$k]['old_status']=__("status_history.cancelled");
        }
        if($order['old_status'] == 'P')
        {
            $returnlist[$k]['old_status']=__("status_history.onwork");
        }
    }
return $returnlist;
}