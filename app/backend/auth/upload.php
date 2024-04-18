<?php
if (!Input::exists()) {
    Redirect::to('/');
}

$parent_sections = array();
$section_id = $db->get('homework', array('homework_ID', '=', Input::get('homework_id')))->first()->section_ID;
$parent_section = $db->get('subject_class_sections', array('section_ID', '=', $section_id))->first();
while ($parent_section->parent_section_ID != 0) {
    $parent_section = $db->get('subject_class_sections', array('section_ID', '=', $parent_section->parent_section_ID))->first();
    $parent_sections[] = $parent_section;
}
$parent_sections = array_reverse($parent_sections);

$homework_files_location = FRONTEND_ASSET . "sections/" . $parent_section->section_ID . "/";
foreach ($parent_sections as $s) {
    $homework_files_location .= $s->section_ID . "/";
}
$homework_files_location .= "homework/" . Input::get('homework_id') . "/users/" . $user->data()->uid . "/";

if (!file_exists($homework_files_location)) {
    mkdir($homework_files_location, 0777, true);
    if (!file_exists($homework_files_location . "submissions/")) {
        mkdir($homework_files_location . "submissions/", 0777, true);
    }
    if (!file_exists($homework_files_location . "feedback/")) {
        mkdir($homework_files_location . "feedback/", 0777, true);
    }
}

if (Token::check('upload_file_form', Input::get('csrf_token'))) {
    $validate = new Validation();
    $validation_file = $validate->check($_FILES, array(
        'file' => array(
            'required' => true
        )
    ));
    $validate = new Validation();
    $validation_text = $validate->check($_POST, array(
        'text' => array(
            'required' => true
        )
    ));

    if ($validation_file->passed() && $validation_text->passed()) {
        try {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
            $max_size = 500000000; //500 mb
            error_log("File uploaded");

            for ($i = 0; $i < count($file_name); $i++) {
                if ($file_error[$i] === 0) {
                    if ($file_size[$i] < $max_size) {
                        $file_destination = $homework_files_location . "submissions/" . $file_name[$i];
                        move_uploaded_file($file_tmp[$i], $file_destination);
                    }
                }
            }

            $db->insert('submissions', array(
                'homework_ID' => Input::get('homework_id'),
                'student_ID' => $user->data()->uid,
                'submission_text' => Input::get('text'),
                'submission_date' => date('Y-m-d H:i:s')
            ));
            Redirect::to('aflevering?id=' . Input::get('homework_id'));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        echo '<div class="alert alert-danger"><strong></strong>' . cleaner($validation->error()) . '</div>';
    }
}
