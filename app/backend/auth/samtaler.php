<?php
//If samtaler?id=
$message_id = null;
if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    //If message_id does not exist, redirect to samtaler or if the message is not sent / recieved by the user
    // if ($db->get('messages', array('message_ID', '=', $message_id))->count() == 0 || $db->query('SELECT * FROM messages WHERE message_ID = ? AND from_uid = ?', array($message_id, $user->data()->uid))->count() == 0 || $db->query('SELECT * FROM message_to_users WHERE message_ID = ? AND to_uid = ?', array($message_id, $user->data()->uid))->count() == 0) {
    //     Redirect::to('/');
    // }
}

//Get all messages data
$recieved = $db->get('message_to_users', array('to_uid', '=', $user->data()->uid))->results();
$messages_recieved = array();
foreach ($recieved as $r) {
    $messages_recieved[] = $db->get('messages', array('message_ID', '=', $r->message_ID))->first();
}
$messages_sent = $db->get('messages', array('from_uid', '=', $user->data()->uid))->results();

//merge the two arrays, but add a key to each message to know if it is recieved or sent
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
    return strtotime($a->date_created) - strtotime($b->date_created);
});

//Sort replies by date. oldest first
foreach ($messages as $message) {
    usort($message->replies, function ($a, $b) {
        return strtotime($a->date_created) - strtotime($b->date_created);
    });
}

$selected_message = null;
if ($message_id) {
    //Find the selected message from the messages array with the same message_ID
    foreach ($messages as $message) {
        if ($message->message_ID == $message_id) {
            $selected_message = $message;
            break;
        }
    }
} else {
    if (count($messages) > 0) {
        $selected_message = $messages[0];
    }
    Redirect::to('samtaler?id=' . $selected_message->message_ID);
}