<?php

$subjects = $db->get('subject_class', array('class_ID', '=', $class->class_ID))->results();

$schedule = array();
foreach ($subjects as $subject) {
    $schedules = $db->get('schedule', array('subject_class_ID', '=', $subject->subject_class_ID))->results();
    foreach ($schedules as $s) {
        $s->subject_name = $db->get('subject', array('subject_ID', '=', $subject->subject_ID))->first()->subject_name;
        $schedule[] = $s;
    }
}