<?php
$student_classes = $db->get('student_class', array('student_ID', '=', $user->data()->uid))->results();
$all_classes = array();
$all_subjects = array();
$all_sections = array();
$all_homework = array();
$user_submissions = $db->get('submissions', array('student_ID', '=', $user->data()->uid))->results();

foreach ($student_classes as $class) {
    $all_classes[] = $class;
    $classSubjects = $db->get('subject_class', array('class_ID', '=', $class->class_ID))->results();

    foreach ($classSubjects as $subject) {
        $all_subjects[] = $subject;
        $subjectSections = $db->get('subject_class_sections', array('subject_class_ID', '=', $subject->subject_class_ID))->results();

        foreach ($subjectSections as $section) {
            $all_sections[] = $section;
            $homework = $db->get('homework', array('section_ID', '=', $section->section_ID))->results();

            foreach ($homework as $h) {
                $h->subject_name = $db->get('subject', array('subject_ID', '=', $subject->subject_ID))->first()->subject_name;
                //If user_submissions contains homework id, set submitted to true
                $h->submitted = in_array($h->homework_ID, array_column($user_submissions, 'homework_ID')) ? true : false;
                if ($h->submitted) {
                    $submission = $db->get('submissions', array('homework_ID', '=', $h->homework_ID), array('student_ID', '=', $user->data()->uid))->first();
                    $h->marked = $submission->marked_by != 0 ? true : false;
                }
                $all_homework[] = $h;
            }
        }
    }
}

usort($all_homework, function ($a, $b) {
    return strtotime($a->due_date) - strtotime($b->due_date);
});

//Get the next homework, if it exists and if it is not submitted and if the due date is not passed
if (count($all_homework) > 0) {
    $next_homework = null;
    foreach ($all_homework as $homework) {
        if (strtotime($homework->due_date) > strtotime(date('Y-m-d H:i:s')) && !$homework->submitted) {
            $next_homework = $homework;
            break;
        }
    }
} else {
    $next_homework = null;
}

$today = date('Y-m-d');
if ($next_homework) {
    $section = $db->get('subject_class_sections', array('section_ID', '=', $next_homework->section_ID))->first();
    $subject_class = $db->get('subject_class', array('subject_class_ID', '=', $section->subject_class_ID))->first();
    $subject = $db->get('subject', array('subject_ID', '=', $subject_class->subject_ID))->first();

    //echo amount of days until due date. If more than 1 day, print days, else print hours,minutes 
    $due_date = $next_homework->due_date;
    $diff = abs(strtotime($due_date) - strtotime($today));

    $days = floor($diff / (60 * 60 * 24));
    $hours = floor($diff / (60 * 60));
    if ($days > 1) {
        $time = $days . " dage";
    } else {
        $time = $hours . " timer";
    }
}