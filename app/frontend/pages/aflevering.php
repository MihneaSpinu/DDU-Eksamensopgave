<!-- Show homework data if not submitted, as well as submit button -->
<?php if (!$submitted) : ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Aflevering</h1>
                <h2 class="text-center"><?php echo $subject->subject_name; ?></h2>
                <h3 class="text-center"><?php echo $section->section_name; ?></h3>
                <h4 class="text-center"><?php echo $homework->homework_title; ?></h4>
                <p class="text-center"><?php echo $homework->homework_description; ?></p>
                <form action="/backend/auth/aflever_lektie.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Vælg fil</label>
                        <input class="form-control" type="file" name="file" id="file" required>
                    </div>
                    <p name="homework_id"><?php echo $homework->homework_ID; ?></p>
                    <p name="student_id"><?php echo $user->data()->name; ?></p>
                    <p name="submitted_at"><?php echo date('Y-m-d H:i:s'); ?></p>
                    <p name="assigned_by"><?php echo $assigned_by->name; ?></p>
                    <p name="due_date">Skal afleveres: <?php echo $homework->due_date; ?></p>
                    <p name="subject_name"><?php echo $subject->subject_name; ?></p>
                    <p name="section_name"><?php echo $section->section_name; ?></p>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Aflevering</h1>
                <h2 class="text-center"><?php echo $subject->subject_name; ?></h2>
                <h3 class="text-center"><?php echo $section->section_name; ?></h3>
                <h4 class="text-center"><?php echo $homework->title; ?></h4>
                <p class="text-center"><?php echo $homework->description; ?></p>
                <p class="text-center">Afleveret af: <?php echo $submitted_by->name; ?></p>
                <p class="text-center">Afleveret: <?php echo $submission->submitted_at; ?></p>
                <p class="text-center">Bedømt af: <?php echo $marked_by->name; ?></p>
                <p class="text-center">Bedømt: <?php echo $submission->marked_at; ?></p>
                <p class="text-center">Karakter: <?php echo $submission->grade; ?></p>
                <p class="text-center">Bedømmelse: <?php echo $submission->comment; ?></p>
                <form action="/backend/auth/submit_homework.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Vælg fil</label>
                        <p class="form-control" type="file" name="file" id="file" required>
                    </div>
                    <p name="homework_id"><?php echo $homework->homework_ID; ?></p>
                    <p name="student_id"><?php echo $user->data()->uid; ?></p>
                    <p name="submitted_at"><?php echo date('Y-m-d H:i:s'); ?></p>
                    <p name="submitted_by"><?php echo $user->data()->uid; ?></p>
                    <p name="section_id"><?php echo $section->section_ID; ?></p>
                    <p name="assigned_by"><?php echo $homework->assigned_by; ?></p>
                    <p name="due_date"><?php echo $homework->due_date; ?></p>
                    <p name="title"><?php echo $homework->title; ?></p>
                    <p name="description"><?php echo $homework->description; ?></p>
                    <p name="subject_id"><?php echo $subject->subject_class_ID; ?></p>
                    <p name="subject_name"><?php echo $subject->subject_name; ?></p>
                    <p name="section_name"><?php echo $section->section_name; ?></p>
                    <p name="assigned_by_name"><?php echo $assigned_by->name; ?></p>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>


<!-- Else show submission data, and option to edit submit -->