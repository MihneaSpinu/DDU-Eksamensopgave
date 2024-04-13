<?php
$section_id = null;
if (isset($_GET['id'])) {
    $section_id = $_GET['id'];
    if ($db->get('subject_class_sections', array('section_ID', '=', $section_id))->count() == 0) {
        Redirect::to('/');
    }
    $chosen_section = $db->get('subject_class_sections', array('section_ID', '=', $section_id))->first();
    $section_files = $db->get('section_files', array('section_ID', '=', $section_id))->results();
}

foreach ($all_sections as $section) {
    $subject = $db->get('subject_class', array('subject_class_ID', '=', $section->subject_class_ID))->first();
    $section->teacher = $db->get('users', array('uid', '=', $subject->subject_teacher_ID))->first();
}

echo "<pre>";
if ($section_id) {
    print_r($chosen_section);
    print_r($section_files);
}
echo "</pre>";