<?php
$homework_id = $_GET['id'];

if ($homework_id) {
    if ($db->get('homework', array('homework_ID', '=', $homework_id))->count() == 0) {
        Redirect::to('/');
    }    
} else {
    Redirect::to('/');
}

$homework = $db->get('homework', array('homework_ID', '=', $homework_id))->first();
$section = $db->get('subject_class_sections', array('section_ID', '=', $homework->section_ID))->first();

if (!in_array($section, $all_sections)) {
    Redirect::to('/');
}

$subject_class = $db->get('subject_class', array('subject_class_ID', '=', $section->subject_class_ID))->first();
$subject = $db->get('subject', array('subject_ID', '=', $subject_class->subject_ID))->first();
$assigned_by = $db->get('users', array('uid', '=', $homework->assigned_by))->first();

$submitted = $db->get('submissions', array('homework_ID', '=', $homework_id), array('student_ID', '=', $user->data()->uid))->count() ? true : false;
if ($submitted) {
    $submission = $db->get('submissions', array('homework_ID', '=', $homework_id), array('student_ID', '=', $user->data()->uid))->first();    
    $submitted_by = $db->get('users', array('uid', '=', $submission->student_ID))->first();
    if ($submission->marked_by != 0) {
        $marked_by = $db->get('users', array('uid', '=', $submission->marked_by))->first();
    }
}

echo "<pre>";
print_r($homework);
print_r($section);
print_r($subject);
print_r($assigned_by);
print_r($submitted);
echo "</pre>";