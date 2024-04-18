<?php
$homework_id = $_GET['id'];

if ($homework_id) {
    if ($db->get('homework', array('homework_ID', '=', $homework_id))->count() == 0) {
        Redirect::to('/');
    }
} else {
    Redirect::to('/');
}

$dage = array(
    'Monday' => 'Mandag',
    'Tuesday' => 'Tirsdag',
    'Wednesday' => 'Onsdag',
    'Thursday' => 'Torsdag',
    'Friday' => 'Fredag',
    'Saturday' => 'Lørdag',
    'Sunday' => 'Søndag'
);

foreach ($all_homework as $homework) {
    if ($homework->homework_ID == $homework_id) {
        $homework = $homework;
        break;
    }
}

//Get group from groups table based on homework id
$group = null;
if ($homework->group_work) {
    if (!$db->get('groups', array('homework_ID', '=', $homework->homework_ID))->count() == 0) {
        $group = $db->get('groups', array('homework_ID', '=', $homework->homework_ID))->first();
        $group_students = $db->get('group_students', array('group_ID', '=', $group->group_ID))->results();
    }
}

$section = $db->get('subject_class_sections', array('section_ID', '=', $homework->section_ID))->first();

$parent_sections = array();
$parent_section = $db->get('subject_class_sections', array('section_ID', '=', $homework->section_ID))->first();
while ($parent_section->parent_section_ID != 0) {
    $parent_section = $db->get('subject_class_sections', array('section_ID', '=', $parent_section->parent_section_ID))->first();
    $parent_sections[] = $parent_section;
}
$parent_sections = array_reverse($parent_sections);

$subject_class = $db->get('subject_class', array('subject_class_ID', '=', $section->subject_class_ID))->first();
$subject = $db->get('subject', array('subject_ID', '=', $subject_class->subject_ID))->first();
$assigned_by = $db->get('users', array('uid', '=', $homework->assigned_by))->first();

$submitted = $db->get('submissions', array('homework_ID', '=', $homework_id), array('student_ID', '=', $user->data()->uid))->count() ? true : false;
$submission = null;
if ($submitted) {
    $submission = $db->get('submissions', array('homework_ID', '=', $homework_id), array('student_ID', '=', $user->data()->uid))->first();
    $submitted_by = $db->get('users', array('uid', '=', $submission->student_ID))->first();
    if ($submission->marked_by != 0) {
        $submission->marked_by = $db->get('users', array('uid', '=', $submission->marked_by))->first()->name;
    }
}

$homework_files_location = FRONTEND_ASSET . "sections/";
foreach ($parent_sections as $s) {
    $homework_files_location .= $s->section_ID . "/";
}
$homework_files_location .= $section->section_ID . "/homework/" . $homework->homework_ID . "/";
$file_types = $db->query("SELECT * FROM file_types")->results();

//feedback form post. Update submission
if (Input::exists()) {
    if (Token::check('feedback_form', Input::get('csrf_token'))) {
        $validate = new Validation();
        $validation_file = $validate->check($_FILES, array(
            'feedback_file' => array(
                'file' => true
            )
        ));

        $validation = $validate->check($_POST, array(
            'comment' => array(
                'max' => 255
            ),
            'grade' => array(
                'max' => 3
            )
        ));

        if ($validation->passed() && $validation_file->passed()) {
            try {
                $file = $_FILES['feedback_file'];
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                $file_size = $file['size'];
                $file_error = $file['error'];

                $location = $homework_files_location . "users/" . Input::get('user_id') . "/feedback/";
                if (!file_exists($location)) {
                    mkdir($location, 0777, true);
                }

                $max_size = 500000000; //500 mb
                for ($i = 0; $i < count($file_name); $i++) {
                    if ($file_error[$i] === 0) {
                        if ($file_size[$i] < $max_size) {
                            $file_destination = $location . $file_name[$i];
                            move_uploaded_file($file_tmp[$i], $file_destination);
                        }
                    }
                }

                $db->query("UPDATE submissions SET grade = ?, comment = ?, marked_by = ?, marked_date = ? WHERE homework_ID = ? AND student_ID = ?", array(
                    Input::get('grade'),
                    Input::get('comment'),
                    $user->data()->uid,
                    date('Y-m-d H:i:s'),
                    $homework_id,
                    Input::get('user_id')
                ));
                Redirect::to('aflevering?id=' . $homework_id);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $errors = $validation->errors();
        }
    }
}
