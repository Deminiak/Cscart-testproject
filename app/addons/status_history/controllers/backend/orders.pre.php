<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($mode == 'update_status') {
        $user_data = array(
            'order_id' => $_REQUEST['id'],
            'old_status' => '',
            'new_status' => $_REQUEST['status'],
            'user_id' => $auth['user_id'],
            'timestamp'=>time()
        );
        db_query('INSERT INTO ?:status_history ?e', $user_data);
        }
    }