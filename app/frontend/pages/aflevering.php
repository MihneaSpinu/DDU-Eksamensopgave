<h3 class="font-weight-bold">
    <a href="rum?id=<?php echo $parent_section->section_ID; ?>"><?php echo $parent_section->section_name; ?></a>
</h3>
<?php foreach ($parent_sections as $s) {
    if ($s != $parent_section)
        echo "<h5><a href='rum?id=" . $s->section_ID . "'>" . $s->section_name . "</a></h5>";
} ?>
<?php if ($parent_section != $section) : ?>
    <h5 class="font-italic mb-0">
        <a href="rum?id=<?php echo $section->section_ID; ?>"><?php echo $section->section_name; ?></a>
    </h5>
<?php endif; ?>
<div class="border-top border-bottom py-2 my-2">
    <a class="font-weight-bold">Åbnet: </a>
    <?php echo $dage[date('l', strtotime($homework->date_unlocked))] . date(' d. M, Y - H:i', strtotime($homework->date_unlocked)); ?>
    <br><a class="font-weight-bold">Aflevering: </a>
    <?php echo $dage[date('l', strtotime($homework->due_date))] . date(' d. M, Y - H:i', strtotime($homework->due_date)); ?>
    <br><a class="font-weight-bold">Fordybelsestid: </a>
    <?php echo $homework->immersion_time; ?> time<?php echo $homework->immersion_time > 1 ? "r" : ""; ?>
    <?php if ($submission) : ?>
        <br><a class="font-weight-bold">Afleveret: </a>
        <?php echo $homework->time_remaining;
        echo strtotime($submission->submission_date) < strtotime($homework->due_date) ? " før" : " efter"; ?>
        <?php else : if (strtotime($homework->due_date) < strtotime(date('Y-m-d'))) : ?>
            <br><a class="font-weight-bold">Afleveringsdato overskredet med: </a>
        <?php echo $homework->time_remaining;
        else : ?>
            <br><a class="font-weight-bold">Tid tilbage: </a>
    <?php echo $homework->time_remaining;
        endif;
    endif; ?>
</div>
<div class="border-bottom">
    <h4><?php echo $homework->homework_title; ?></h4>
    <p class="mb-2"><?php echo $homework->homework_description; ?></p>
    <?php
    //Foreach file in $homework_file_location, print out the file name and a download link
    if (!file_exists($homework_files_location . "assigned_files")) {
        mkdir($homework_files_location . "assigned_files", 0777, true);
    }
    foreach (scandir($homework_files_location . "assigned_files") as $file) :
        if ($file != "." && $file != "..") : ?>
            <div class="card mb-2">
                <div class="container m-2">
                    <a href="<?php echo $homework_files_location . "assigned_files/" . $file; ?>" download>
                        <div class="row">
                            <div class="my-auto" style="width: 50px">
                                <img class="w-100" src="<?php echo FRONTEND_ASSET . "images/" .
                                                            $file_types[array_search(pathinfo($file, PATHINFO_EXTENSION), array_column($file_types, 'extension'))]->file_type
                                                            . ".png"; ?>">
                            </div>
                            <div class="col-10 d-flex">
                                <div class="my-auto">
                                    <h5 class="card-title mb-0"><?php echo substr($file, 0, strrpos($file, ".")); ?></h5>
                                    <p class="card-text text-muted font-italic"><?php echo date('d. M, Y - h:i', filemtime($homework_files_location . "assigned_files/" . $file)); ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    <?php endif;
    endforeach; ?>
</div>

<?php if ($homework->group_work && $group) : ?>
    <div class="border-bottom">
        <div class="card my-2">
            <div class="container m-2">
                <div class="row">
                    <div class="my-auto" style="width: 50px">
                        <img src="<?php echo FRONTEND_ASSET . "images/gruppe.png"; ?>" class="w-100">
                    </div>
                    <div class="col-10 d-flex">
                        <div class="my-auto">
                            <h5 class="card-title mb-0">Grupper til <?php echo $homework->homework_title; ?></h5>
                            <?php if ($user_type == "teacher") : ?>
                                <p class="card-text text-muted font-italic"><?php echo count($group_students) . " elever i gruppe"; ?></p>
                            <?php else : ?>
                                <p class="card-text text-muted font-italic"><?php echo $group->group_name; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($user_type == "student") :
    if (!$submission) : ?>
        <h3 class="mt-2">Besvar Opgave</h3>
        <form action="/upload" enctype="multipart/form-data" id="upload-form" method="post">
            <div class="card mb-2">
                <label class="py-5 mb-0 d-flex justify-content-center" for="file">
                    <h5 class="card-title mb-0">Tilføj fil</h5>
                    <input type="file" name="file[]" id="file" style="display: none;" multiple>
                </label>
                <div id="file-name" class="text-muted m-2"></div>
            </div>
            <textarea name="text" id="text" placeholder="Skriv tekst" class="w-100 h-25"></textarea>
            <div class="row mt-5">
                <div class="col-1">
                    <input type="hidden" name="homework_id" value="<?php echo $homework->homework_ID; ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo Token::generate('upload_file_form'); ?>">
                    <input class="btn btn-primary rounded-pill" type="submit" name="submit" value="Aflever">
                </div>
                <div class="col-1">
                    <a class="btn btn-outline-secondary rounded-pill" href="/">Annuller</a>
                </div>
            </div>
        </form>
    <?php else : ?>
        <div class="border-bottom pb-2">
            <div class="row">
                <h3 class="mt-2 col">Opgavebesvarelse</h3>
                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-secondary rounded-pill">Rediger</button>
                </div>
            </div>
            <?php if (!file_exists($homework_files_location . "users/" . $user->data()->uid . "/submissions")) {
                mkdir($homework_files_location . "users/" . $user->data()->uid . "/submissions", 0777, true);
            } ?>
            <?php foreach (scandir($homework_files_location . "users/" . $user->data()->uid . "/submissions/") as $file) :
                if ($file != "." && $file != "..") : ?>
                    <div class="card mb-2">
                        <div class="container m-2">
                            <a href="<?php echo $homework_files_location . "users/" . $user->data()->uid . "/submissions/" . $file; ?>" download>
                                <div class="row">
                                    <div class="my-auto" style="width: 50px">
                                        <img class="w-100" src="<?php echo FRONTEND_ASSET . "images/" .
                                                                    $file_types[array_search(pathinfo($file, PATHINFO_EXTENSION), array_column($file_types, 'extension'))]->file_type
                                                                    . ".png"; ?>">
                                    </div>
                                    <div class="col-10 d-flex">
                                        <div class="my-auto">
                                            <h5 class="card-title mb-0"><?php echo substr($file, 0, strrpos($file, ".")); ?></h5>
                                            <p class="card-text text-muted font-italic"><?php echo date('d. M, Y - h:i', filemtime($homework_files_location . "users/" . $user->data()->uid . "/submissions/" . $file)); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif;
            endforeach;
            if ($submission->submission_text) : ?>
                <div class="card">
                    <div class="container my-2">
                        <p class="mb-0"><?php echo $submission->submission_text; ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <h3 class="mt-2">Feedback af opgave</h3>
        <?php if ($submission->marked_by) : ?>
            <a class="font-weight-bold">Lærer: </a>
            <?php echo $submission->marked_by; ?>
            <br><a class="font-weight-bold">Feedback: </a>
            <?php echo $dage[date('l', strtotime($submission->marked_date))] . date(' d. M, Y - H:i', strtotime($submission->marked_date)); ?>
            <br><a class="font-weight-bold">Karakter: </a>
        <?php echo $submission->grade;
        else : ?>
            <a>Ingen feedback endnu</a>
        <?php endif; ?>
        <?php if (!file_exists($homework_files_location . "users/" . $user->data()->uid . "/feedback")) {
            mkdir($homework_files_location . "users/" . $user->data()->uid . "/feedback", 0777, true);
        } ?>
        <?php foreach (scandir($homework_files_location . "users/" . $user->data()->uid . "/feedback/") as $file) : ?>
            <?php if ($file != "." && $file != "..") : ?>
                <div class="card mt-2">
                    <div class="container m-2">
                        <a href="<?php echo $homework_files_location . "users/" . $user->data()->uid . "/feedback/" . $file; ?>" download>
                            <div class="row">
                                <div class="my-auto" style="width: 50px">
                                    <img class="w-100" src="<?php echo FRONTEND_ASSET . "images/" .
                                                                $file_types[array_search(pathinfo($file, PATHINFO_EXTENSION), array_column($file_types, 'extension'))]->file_type
                                                                . ".png"; ?>">
                                </div>
                                <div class="col-10 d-flex">
                                    <div class="my-auto">
                                        <h5 class="card-title mb-0"><?php echo substr($file, 0, strrpos($file, ".")); ?></h5>
                                        <p class="card-text text-muted font-italic"><?php echo date('d. M, Y - h:i', filemtime($homework_files_location . "users/" . $user->data()->uid . "/feedback/" . $file)); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endif;
        endforeach;
        if ($submission->comment) : ?>
            <div class="card mt-2">
                <div class="container my-2">
                    <p class="mb-0"><?php echo $submission->comment; ?></p>
                </div>
            </div>
        <?php endif; ?>
    <?php endif;
else : ?>
    <!-- Teacher ui -->
    <h3 class="mt-2">Besvarelser</h3>
    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>Navn</th>
                <th>Indsendt</th>
                <th>Feedback</th>
                <th>Kommentar</th>
                <th>Karakter</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($homework->student_submissions as $submission) : ?>
                <!-- add submission->uid to $overlay_value in php -->
                <tr onclick="clickOverlay('submission_overlay'); <?php echo $overlay_value = $submission->uid; ?>">
                    <form action="" method=" post" enctype="multipart/form-data">
                        <td><?php echo $submission->name; ?></td>
                        <td><?php echo $submission->submission_date; ?></td>
                        <td>
                            <input type="file" name="feedback_file[]" id="file" style="display: none;" multiple>
                            <label class="btn btn-secondary" for="file">Tilføj filer</label>
                            <div id="file-name" class="text-muted"></div>
                        </td>
                        <td>
                            <input type="text" name="comment" value="<?php echo $submission->comment; ?>">
                        </td>
                        <td>
                            <input type="number" name="grade" value="<?php echo $submission->grade; ?>">
                        </td>
                        <td>
                            <input type="hidden" name="submission_id" value="<?php echo $submission->submission_ID; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $submission->uid; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo Token::generate('feedback_form'); ?>">
                            <input class="btn btn-primary" type="submit" name="update" value="Opdater">
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div id="submission_overlay" class="overlay">
    <?php
    $overlay_submission = $db->get('submissions', array('homework_ID', '=', $homework->homework_ID), array('student_ID', '=', $overlay_value))->first();
    ?>
    <div class="overlay-content">
        <div class="close" onclick="clickOverlay('submission_overlay')">X</div>
        <h3><?php echo $db->get('users', array('uid', '=', $overlay_value))->first()->name; ?>'s Aflevering</h3>
        <div class="border-bottom py-2">
            <a class="font-weight-bold">Afleveret: </a>
            <?php echo $homework->time_remaining;
            echo strtotime($overlay_submission->submission_date) < strtotime($homework->due_date) ? " før" : " efter"; ?>
        </div>
        <div class="border-bottom py-2">
            <a class="font-weight-bold">Besvarelse</a>
            <p><?php echo $overlay_submission->submission_text; ?></p>
        </div>
        <div class="border-bottom py-2">
            <a class="font-weight-bold">Filer</a>
            <?php foreach (scandir($homework_files_location . "users/" . $overlay_value . "/submissions/") as $file) :
                if ($file != "." && $file != "..") : ?>
                    <div class="card mb-2">
                        <div class="container m-2">
                            <a href="<?php echo $homework_files_location . "users/" . $overlay_value . "/submissions/" . $file; ?>" download>
                                <div class="row">
                                    <div class="my-auto" style="width: 50px">
                                        <img class="w-100" src="<?php echo FRONTEND_ASSET . "images/" .
                                                                    $file_types[array_search(pathinfo($file, PATHINFO_EXTENSION), array_column($file_types, 'extension'))]->file_type
                                                                    . ".png"; ?>">
                                    </div>
                                    <div class="col-10 d-flex">
                                        <div class="my-auto">
                                            <h5 class="card-title mb-0"><?php echo substr($file, 0, strrpos($file, ".")); ?></h5>
                                            <p class="card-text text-muted font-italic"><?php echo date('d. M, Y - h:i', filemtime($homework_files_location . "users/" . $overlay_value . "/submissions/" . $file)); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </div>
</div>

<script>
    //When files are uploaded, show the file names
    document.getElementById("file").addEventListener("change", function() {
        let files = document.getElementById("file").files;
        let file_names = "";
        for (let i = 0; i < files.length; i++) {
            file_names += files[i].name + "<br>";
        }
        document.getElementById("file-name").innerHTML = file_names;
    });
</script>