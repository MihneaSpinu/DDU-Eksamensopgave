<?php
//Get all subject names from subject_ID's from $all_subjects
$subject_names = array();
foreach ($all_subjects as $subject) {
    $subjects[] = $db->get('subject', array('subject_ID', '=', $subject->subject_ID))->first();
}