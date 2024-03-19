<?php
//When submitted a file, check backend/auth/uploads/homework/ if homework_id folder exists, if not create it. Then create a folder with the student_id and move the file there.
//Afterward, create submission in database with relevant information
//If file already exists, overwrite it
//If submission already exists, update it

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $homework_id = $_POST['homework_id'];
    $student_id = $_POST['student_id'];
    $submitted_at = $_POST['submitted_at'];
    $assigned_by = $_POST['assigned_by'];
    $due_date = $_POST['due_date'];
    $subject_name = $_POST['subject_name'];
    $section_name = $_POST['section_name'];

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'zip', 'rar', '7z', 'tar', 'gz', 'mp3', 'mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv', 'wma', 'wav', 'aac', 'ogg', 'flac', 'm4a', 'm4v', 'webm', 'pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'zip', 'rar', '7z', 'tar', 'gz', 'mp3', 'mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv', 'wma', 'wav', 'aac', 'ogg', 'flac', 'm4a', 'm4v', 'webm');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 100000000) {
                $section_id = $db->get('homework', array('homework_ID', '=', $homework_id))->first()->section_ID;
                $homework_dir = 'uploads/' . $section_id . 'homework/' . $homework_id;
                if (!file_exists($homework_dir)) {
                    mkdir($homework_dir, 0777, true);
                }
                $student_dir = $homework_dir . '/' . $student_id;
                if (!file_exists($student_dir)) {
                    mkdir($student_dir, 0777, true);
                }
                $file_destination = $student_dir . '/' . $file_name;
                move_uploaded_file($file_tmp_name, $file_destination);
                $db->insert('submissions', array(
                    'homework_ID' => $homework_id,
                    'student_ID' => $student_id,
                    'submitted_at' => $submitted_at,
                    'assigned_by' => $assigned_by,
                    'due_date' => $due_date,
                    'subject_name' => $subject_name,
                    'section_name' => $section_name,
                    'file_path' => $file_destination
                ));
                Redirect::to('/aflevering.php?id=' . $homework_id);
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}