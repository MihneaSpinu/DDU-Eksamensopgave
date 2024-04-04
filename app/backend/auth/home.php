<?php
$dage = array(
    'Mon' => 'Man',
    'Tue' => 'Tir',
    'Wed' => 'Ons',
    'Thu' => 'Tor',
    'Fri' => 'Fre',
    'Sat' => 'Lør',
    'Sun' => 'Søn'
);

$schedule = array();
foreach ($all_subjects as $subject) {
    $schedules = $db->get('schedule', array('subject_class_ID', '=', $subject->subject_class_ID))->results();
    foreach ($schedules as $s) {
        $s->subject_name = $db->get('subject', array('subject_ID', '=', $subject->subject_ID))->first()->subject_name;
        $schedule[] = $s;
    }
}

$today = "2024-03-27";
$today_schedule = array();
foreach ($schedule as $s) {
    if (date('Y-m-d', strtotime($s->date)) == $today) {
        //Add $s to $today_schedule
        $today_schedule[] = $s;
    }
    $s->time = date('H:i', strtotime($s->date));
    $s->date = date('Y-m-d', strtotime($s->date));
    $s->first_minute = (strtotime($s->time) - strtotime(date('Y-m-d 00:00'))) / 60;
    $s->last_minute = $s->first_minute + $s->period * 60;
    //Get teacher from subject class
    $teacher = $db->get('subject_class', array('subject_class_ID', '=', $s->subject_class_ID))->first()->subject_teacher_ID;
    $s->teacher = $db->get('users', array('uid', '=', $teacher))->first()->initials;
}
//Sort by time
usort($today_schedule, function ($a, $b) {
    return strtotime($a->time) - strtotime($b->time);
});

if (count($today_schedule) > 0) {
    $first_hour = floor($today_schedule[0]->first_minute / 60);
    $last_hour = ceil($today_schedule[count($today_schedule) - 1]->last_minute) / 60;
}

//Count amount of homework that has been submitted
$submitted_homework = 0;
foreach ($all_homework as $homework) {
    if ($homework->submitted || date('Y-m-d H:i:s') > $homework->due_date) {
        $submitted_homework++;
    }
}