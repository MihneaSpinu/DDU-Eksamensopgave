<?php
//If samtaler?id=
$message_id = null;
$selected_message = null;
if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    //If message_id does not exist, redirect to samtaler or if the message is not sent / recieved by the user
    if ($db->get('messages', array('message_ID', '=', $message_id))->count() == 0) {
        Redirect::to('samtaler');
    }
} else {
    //Look if there is a message_id in the messages array, then redirect to that message
    $messages = $db->get('messages', array('from_uid', '=', $user->data()->uid))->results();
    $message_ids = array_column($messages, 'message_ID');
    if (count($messages) > 0) {
        Redirect::to('samtaler?id=' . $message_ids[0]);
    }
}

//get all users except the logged in user
$users = $db->query("SELECT * FROM users WHERE uid != ?", array($user->data()->uid))->results();
//Sort alphabetically
usort($users, function ($a, $b) {
    return $a->name > $b->name;
});

//Get all messages data
$recieved = $db->get('message_to_users', array('to_uid', '=', $user->data()->uid))->results();
$messages_recieved = array();
foreach ($recieved as $r) {
    $messages_recieved[] = $db->get('messages', array('message_ID', '=', $r->message_ID))->first();
}
$messages_sent = $db->get('messages', array('from_uid', '=', $user->data()->uid))->results();

$messages = array();
foreach ($messages_recieved as $message) {
    $message->is_sent = 0;
    $messages[] = $message;
}

foreach ($messages_sent as $message) {
    $message->is_sent = 1;
    $messages[] = $message;
}

foreach ($messages as $message) {
    //Find all users in message_to_users with the same message_ID
    $message_to_user = $db->get('message_to_users', array('message_ID', '=', $message->message_ID))->results();
    foreach ($message_to_user as $m) {
        $message->to[] = $db->get('users', array('uid', '=', $m->to_uid))->first();
    }
    $message->from = $db->get('users', array('uid', '=', $message->from_uid))->first();
    $message->replies = $db->get('message_reply', array('message_ID', '=', $message->message_ID))->results();
}

//Sort messages by date
usort($messages, function ($a, $b) {
    return strtotime($b->date_created) - strtotime($a->date_created);
});

//Sort replies by date. oldest first
foreach ($messages as $message) {
    usort($message->replies, function ($a, $b) {
        return strtotime($a->date_created) - strtotime($b->date_created);
    });
}

if ($message_id) {
    $selected_message = null;
    //Find the selected message from the messages array with the same message_ID
    foreach ($messages as $message) {
        if ($message->message_ID == $message_id) {
            $selected_message = $message;
            break;
        }
    }

    if ($selected_message) {
        $message_ids = array_column($messages_recieved, 'message_ID');
        if (!in_array($message_id, $message_ids)) {
            $message_ids = array_column($messages_sent, 'message_ID');
            if (!in_array($message_id, $message_ids)) {
                Redirect::to('samtaler?id=' . $selected_message->message_ID);
            }
        }

        if ($selected_message->is_sent == 0) {
            $db->query("UPDATE message_to_users SET user_read = 1 WHERE message_ID = ? AND to_uid = ?", array($selected_message->message_ID, $user->data()->uid));
        }
    }
} else {
    $selected_message = $messages[0];
    Redirect::to('samtaler?id=' . $selected_message->message_ID);
}

if (Input::exists()) {
    if (Token::check('reply_form', Input::get('csrf_token'))) {
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'reply' => array(
                'required' => true
            )
        ));

        if ($validation->passed()) {
            try {
                $db->insert('message_reply', array(
                    'message_ID' => $selected_message->message_ID,
                    'from_uid' => $user->data()->uid,
                    'message' => Input::get('reply'),
                    'date_created' => date('Y-m-d H:i:s')
                ));

                Redirect::to('samtaler?id=' . $selected_message->message_ID);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            echo '<div class="alert alert-danger"><strong></strong>' . cleaner($validation->error()) . '</div>';
        }
    }
}

//post request to create message and remove sql injection
if (Input::exists()) {
    if (Token::check('send_message_form', Input::get('csrf_token'))) {
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'subject' => array(
                'required' => true
            ),
            'message' => array(
                'required' => true
            ),
            'select_users' => array(
                'required' => true
            )
        ));

        if ($validation->passed()) {
            try {
                $db->insert('messages', array(
                    'from_uid' => $user->data()->uid,
                    'subject' => Input::get('subject'),
                    'message' => Input::get('message'),
                    'date_created' => date('Y-m-d H:i:s')
                ));

                $message_id = $db->query("SELECT MAX(message_ID) as message_ID FROM messages")->first()->message_ID;
                //Insert all selected users from select name="select_users[]" into message_to_users
                foreach (Input::get('select_users') as $to_uid) {
                    $db->insert('message_to_users', array(
                        'message_ID' => $message_id,
                        'to_uid' => $to_uid
                    ));
                }

                Redirect::to('samtaler?id=' . $message_id);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            echo '<div class="alert alert-danger"><strong></strong>' . cleaner($validation->error()) . '</div>';
        }
    }
}
