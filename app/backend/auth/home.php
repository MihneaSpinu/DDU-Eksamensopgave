<?php

$submissions = $db->get('submissions', array('student_ID', '=', $user->data()->uid))->results();

$schedule = array();
foreach ($all_subjects as $subject) {
    $schedules = $db->get('schedule', array('subject_class_ID', '=', $subject->subject_class_ID))->results();
    foreach ($schedules as $s) {
        $s->subject_name = $db->get('subject', array('subject_ID', '=', $subject->subject_ID))->first()->subject_name;
        $schedule[] = $s;
    }
}

$today = date('D');
$today_schedule = array();
foreach ($schedule as $s) {
    if (date('D', strtotime($s->date)) == $today) {
        //Add $s to $today_schedule
        $today_schedule[] = $s;
    }
    $s->time = date('H:i', strtotime($s->date));
    $s->date = date('Y-m-d', strtotime($s->date));
    $s->minute = date('H', strtotime($s->time)) * 60 + date('i', strtotime($s->time));
}

//Sort by time
usort($today_schedule, function ($a, $b) {
    return strtotime($a->time) - strtotime($b->time);
});


//First minute from first object from $today_schedule from time
$first_minute = date('H', strtotime($today_schedule[0]->time)) * 60 + date('i', strtotime($today_schedule[0]->time));
$last_minute = date('H', strtotime($today_schedule[count($today_schedule) - 1]->time)) * 60 + date('i', strtotime($today_schedule[count($today_schedule) - 1]->time));
$first_hour = date('H', strtotime($today_schedule[0]->time));

echo "<pre>";
print_r($today_schedule);
echo "</pre>";


$amount_of_minutes = $last_minute - $first_minute;
