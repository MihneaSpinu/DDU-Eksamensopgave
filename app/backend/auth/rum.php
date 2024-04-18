<?php
$section_id = null;
if (isset($_GET['id'])) {
    $section_id = $_GET['id'];
    if ($db->get('subject_class_sections', array('section_ID', '=', $section_id))->count() == 0) {
        Redirect::to('/');
    }
}

foreach ($all_sections as $section) {
    $subject = $db->get('subject_class', array('subject_class_ID', '=', $section->subject_class_ID))->first();
    $section->teacher = $db->get('users', array('uid', '=', $subject->subject_teacher_ID))->first();
    $section->class = $db->get('class', array('class_ID', '=', $subject->class_ID))->first();
}

if ($section_id) {
    $chosen_section = $db->get('subject_class_sections', array('section_ID', '=', $section_id))->first();
    $section_files = $db->get('section_files', array('section_ID', '=', $section_id))->results();
    foreach ($section_files as $file) {
        $file->extension = $db->get('file_types', array('file_type_ID', '=', $file->file_type_ID))->first()->extension;
        $file->file_type = $db->get('file_types', array('file_type_ID', '=', $file->file_type_ID))->first()->file_type;
    }
    //Sort by date. newest first
    usort($section_files, function ($a, $b) {
        return strtotime($b->date_created) - strtotime($a->date_created);
    });

    $parent_sections = array();
    $parent_section = $chosen_section;
    while ($parent_section->parent_section_ID != 0) {
        $parent_section = $db->get('subject_class_sections', array('section_ID', '=', $parent_section->parent_section_ID))->first();
        $parent_sections[] = $parent_section;
    }
    $parent_sections = array_reverse($parent_sections);

    $child_sections = array();
    $child_section = $chosen_section;
    while ($db->get('subject_class_sections', array('parent_section_ID', '=', $child_section->section_ID))->count() > 0) {
        $child_sections = array_merge($child_sections, $db->get('subject_class_sections', array('parent_section_ID', '=', $child_section->section_ID))->results());
        $child_section = $child_sections[count($child_sections) - 1];
    }

    $section_homework = $db->get('homework', array('section_ID', '=', $section_id))->results();

    //sort by date. newest first
    usort($section_homework, function ($a, $b) {
        return strtotime($b->due_date) - strtotime($a->due_date);
    });
}

//Form for edit_section
if (Input::exists() && Input::get('edit_section')) {
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        'section_name' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
        )
    ));

    if ($validation->passed()) {
        try {
            $db->update('subject_class_sections', array('section_ID', '=', $section_id), array(
                'section_name' => Input::get('section_name')
            ));
            Session::flash('success', 'Afsnittet blev opdateret');
            Redirect::to('afsnit?id=' . $section_id);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        $errors = $validation->errors();
    }
}