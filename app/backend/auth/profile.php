<?php
$name = $user->data()->firstname . " " . $user->data()->lastname;

//Get all subject names from subject_ID's from $all_subjects
$subject_names = array();
foreach ($all_subjects as $subject) {
    $subject_names[] = $db->get('subject', array('subject_ID', '=', $subject->subject_ID))->first()->subject_name;
}