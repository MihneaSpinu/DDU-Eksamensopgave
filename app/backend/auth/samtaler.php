<?php

//Get all messages data
$recieved_messages = $db->get('messages', array('to_uid', '=', $user->data()->uid))->results();
$sent_messages = $db->get('messages', array('from_uid', '=', $user->data()->uid))->results();
//Create replies array in recieved messages and sent messages. Add replies from message_reply table to array
$recieved_messages = array_map(function ($message) use ($db) {
    $message->replies = $db->get('message_reply', array('message_ID', '=', $message->message_ID))->results();
    return $message;
}, $recieved_messages);

$sent_messages = array_map(function ($message) use ($db) {
    $message->replies = $db->get('message_reply', array('message_ID', '=', $message->message_ID))->results();
    return $message;
}, $sent_messages);