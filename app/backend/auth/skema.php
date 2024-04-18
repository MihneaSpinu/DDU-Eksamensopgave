<?php

// $subjects = $db->get('subject_class', array('class_ID', '=', $class->class_ID))->results();

// $schedule = array();
// foreach ($subjects as $subject) {
//     $schedules = $db->get('schedule', array('subject_class_ID', '=', $subject->subject_class_ID))->results();
//     foreach ($schedules as $s) {
//         $s->subject_name = $db->get('subject', array('subject_ID', '=', $subject->subject_ID))->first()->subject_name;
//         $schedule[] = $s;
//         $s->time = date('H:i', strtotime($s->date));
//         $s->date = date('Y-m-d', strtotime($s->date));
//         $s->first_minute = (strtotime($s->time) - strtotime(date('Y-m-d 00:00'))) / 60;
//         $s->last_minute = $s->first_minute + $s->period * 60;
//         //Get teacher from subject class
//         $teacher = $db->get('subject_class', array('subject_class_ID', '=', $s->subject_class_ID))->first()->subject_teacher_ID;
//         $s->teacher = $db->get('users', array('uid', '=', $teacher))->first()->initials;
//     }
// }

// $today = date('D');
// $first_hour = 6;
// $last_hour = 17;

// //Get all schedules for this week. Create a 2D array with 5 arrays, one for each day of the week. First create an empty array for each day, called the day, and then fill.

// $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri');
// $week_schedule = array();
// foreach ($days as $day) {
//     $week_schedule[$day] = array();
// }

// foreach ($schedule as $s) {
//     $day = date('D', strtotime($s->date));
//     $week_schedule[$day][] = $s;
// }