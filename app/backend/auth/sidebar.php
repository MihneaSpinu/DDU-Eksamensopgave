<?php
$student_classes = $db->get('student_class', array('student_ID', '=', $user->data()->uid))->results();
$all_classes = array();
$all_subjects = array();
$all_sections = array();
$all_homework = array();

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
                $all_homework[] = $h;
            }
        }
    }
}

// foreach ($student_classes as $class) {
//     $all_classes[] = $class;
//     $classSubjects = $db->get('subject_class', array('class_ID', '=', $class->class_ID))->results();
//     $class_data = array();

//     foreach ($classSubjects as $subject) {
//         $all_subjects[] = $subject;
//         $subjectSections = $db->get('subject_class_sections', array('subject_class_ID', '=', $subject->subject_class_ID))->results();
//         $subject_data = array();

//         foreach ($subjectSections as $section) {
//             $all_sections[] = $section;
//             $homework = $db->get('homework', array('section_ID', '=', $section->section_ID))->results();
//             $section_homework = array();

//             foreach ($homework as $h) {
//                 $all_homework[] = $h;
//             }

//             $section_data = array(
//                 'section_info' => $section,
//                 'homework' => $all_homework
//             );

//             $subject_data[] = $section_data;
//         }

//         $subject_info = array(
//             'subject_info' => $subject,
//             'sections' => $subject_data
//         );
//         $class_data[] = $subject_info;
//     }

//     $class_info = array(
//         'class_info' => $class,
//         'subjects' => $class_data
//     );
//     $all_tables[] = $class_info;
// }

usort($all_homework, function ($a, $b) {
    return strtotime($a->due_date) - strtotime($b->due_date);
});

//Get the next homework, if it exists
if (count($all_homework) > 0) {
    $next_homework = $all_homework[0];
} else {
    $next_homework = null;
}

if ($next_homework) {
    $section = $db->get('subject_class_sections', array('section_ID', '=', $next_homework->section_ID))->first();
    $subject_class = $db->get('subject_class', array('subject_class_ID', '=', $section->subject_class_ID))->first();
    $subject = $db->get('subject', array('subject_ID', '=', $subject_class->subject_ID))->first();

    //echo amount of days until due date. If more than 1 day, print days, else print hours,minutes 
    $today = date('Y-m-d');
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