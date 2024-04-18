<?php if ($section_id != null) : ?>
    <h3 class="font-weight-bold">
        <a href="rum?id=<?php echo $parent_section->section_ID; ?>"><?php echo $parent_section->section_name; ?></a>
    </h3>
    <?php foreach ($parent_sections as $section) {
        if ($section != $parent_section)
            echo "<h5><a href='rum?id=" . $section->section_ID . "'>" . $section->section_name . "</a></h5>";
    } ?>
    <?php if ($parent_section != $chosen_section) : ?>
        <h5 class="font-italic">
            <a href="rum?id=<?php echo $chosen_section->section_ID; ?>"><?php echo $chosen_section->section_name; ?></a>
        </h5>
    <?php endif; ?>
    <p class="border-bottom pb-2"><?php echo $chosen_section->section_description; ?></p>

    <?php if ($user->hasPermission("edit_homework")) : ?>
        <div class="row d-flex justify-content-end">
            <div class="col-auto">
                <button class="btn btn-secondary rounded-pill" onclick="clickOverlay('edit_section')">
                    Rediger rum
                </button>
            </div>
            <div class="col-auto">
                <form action="" method="post">
                    <input class="btn btn-secondary rounded-pill" name="delete_section" type="hidden" value="<?php echo $chosen_section->section_ID; ?>">
                    <input type="submit" class="btn btn-secondary rounded-pill" value="Slet rum">
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php if (count($child_sections) > 0) : ?>
        <div class="row border-bottom pt-2">
            <div class="card-deck mx-auto w-100">
                <?php foreach ($child_sections as $section) :
                    if ($section->parent_section_ID == $chosen_section->section_ID) : ?>
                        <div class="col-lg-4 col-sm-6 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-title mb-0 container">
                                    <div class="row py-3">
                                        <div class="col">
                                            <a href="rum?id=<?php echo $section->section_ID ?>">
                                                <h5 class="mb-0"><?php echo $section->section_name; ?></h5>
                                            </a>
                                        </div>
                                        <?php if ($user->hasPermission("edit_homework")) : ?>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEF7FF;border: none; color:black;">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <form action="" method="post">
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>">Gå til</a>
                                                            <input class="dropdown-item" type="hidden" name="edit_section" value="<?php echo $section->section_ID ?>">
                                                            <input type="submit" class="dropdown-item" value="Rediger">
                                                            <input class="dropdown-item" type="hidden" name="delete_section" value="<?php echo $section->section_ID ?>">
                                                            <input type="submit" class="dropdown-item" value="Slet">
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <a class="mt-auto" href="rum?id=<?php echo $section->section_ID ?>">
                                    <div>
                                        <?php if (file_exists(FRONTEND_ASSET . "sections/" . $chosen_section->section_ID . "/" . $section->section_ID . "/dashboard_img.png")) : ?>
                                            <img src="<?php echo FRONTEND_ASSET . "sections/" . $chosen_section->section_ID . "/" . $section->section_ID . "/dashboard_img.png" ?>" class="w-100 rounded-bottom">
                                        <?php else : ?>
                                            <img src="<?php echo FRONTEND_ASSET . "images/placeholder.png" ?>" class="w-100 rounded-bottom">
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php endif;
                endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="section_content">
        <!-- Display all files and all homework, automatically sorted by date -->
        <div class="files my-2">
            <?php foreach ($section_files as $file) : ?>
                <div class="card mb-2">
                    <div class="container m-2">
                        <?php if ($file->file_type != "Text" && $file->file_type != "Image" && $file->file_type != "Video") :
                            if ($file->file_type != "Link") : ?>
                                <a class="col row" href="<?php echo FRONTEND_ASSET . "sections/";
                                                            foreach ($parent_sections as $section) {
                                                                echo $section->section_ID . "/";
                                                            } ?><?php echo $chosen_section->section_ID . "/" . $file->file_name . "." . $file->extension; ?>" download>
                                <?php else : ?>
                                    <a class="col row" href="<?php echo $file->file_name; ?>" target="_blank">
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="my-auto" style="width: 50px">
                                            <!-- Get file type table from $file->file_type id -->
                                            <img src="<?php echo FRONTEND_ASSET . "images/" . $file->file_type . ".png"; ?>" class="w-100">
                                        </div>
                                        <div class="col-10 d-flex">
                                            <div class="my-auto">
                                                <h5 class="card-title mb-0"><?php echo $file->file_name; ?></h5>
                                                <p class="card-text text-muted font-italic"><?php echo date('d. M, Y - h:i', strtotime($file->date_created)); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                    <?php if ($user->hasPermission("edit_homework")) : ?>
                                        <div class="col-auto d-flex align-items-center ml-auto mb-auto">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEF7FF;border: none; color:black;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <form action="" method="post">
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <button class="dropdown-item" onclick="clickOverlay('edit_file')" value="<?php echo $file->section_file_ID ?>">Rediger</button>
                                                        <input class="dropdown-item" type="hidden" name="delete_file" value="<?php echo $file->section_file_ID ?>">
                                                        <input type="submit" class="dropdown-item" value="Slet">
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                    </div>
                <?php endif;
                        if ($file->file_type == "Text" || $file->file_type == "Image" || $file->file_type == "Video") : ?>
                    <div class="row">
                        <?php if ($file->file_type == "Text") : ?>
                            <div class="row col">
                                <div class="my-auto col">
                                    <h5 class="card-title mb-0"><?php echo $file->file_name; ?></h5>
                                </div>
                            </div>
                        <?php elseif ($file->file_type == "Image") : ?>
                            <div class="row col">
                                <div class="my-auto col">
                                    <img src="<?php echo FRONTEND_ASSET . "sections/";
                                                foreach ($parent_sections as $section) {
                                                    echo $section->section_ID . "/";
                                                } ?><?php echo $chosen_section->section_ID . "/" . $file->file_name . "." . $file->extension; ?>" class="w-100">
                                </div>
                            </div>
                        <?php elseif ($file->file_type == "Video") : ?>
                            <div class="row col">
                                <div class="my-auto col">
                                    <video class="w-100 h-100" controls>
                                        <source src="<?php echo FRONTEND_ASSET . "sections/";
                                                        foreach ($parent_sections as $section) {
                                                            echo $section->section_ID . "/";
                                                        } ?><?php echo $chosen_section->section_ID . "/" . $file->file_name . "." . $file->extension; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($user->hasPermission("edit_homework")) : ?>
                            <div class="col-auto d-flex align-items-center ml-auto mb-auto">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEF7FF;border: none; color:black;">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <form action="" method="post">
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item" onclick="clickOverlay('edit_file')" value="<?php echo $file->section_file_ID ?>">Rediger</button>
                                            <input class="dropdown-item" type="hidden" name="delete" value="<?php echo $file->section_file_ID ?>">
                                            <input type="submit" class="dropdown-item" value="Slet">
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="homework">
        <?php if ($section_homework) {
            echo "<h5 class='mt-3'>Afleveringer</h5>";
        }
        foreach ($section_homework as $homework) : ?>
            <div class="card mb-2">
                <div class="container m-2">
                    <a class="col row" href="aflevering?id=<?php echo $homework->homework_ID; ?>">
                        <div class="row">
                            <div class="my-auto" style="width: 50px">
                                <img src="<?php echo FRONTEND_ASSET . "images/aflevering.png"; ?>" class="w-100">
                            </div>
                            <div class="col-10 d-flex">
                                <div class="my-auto">
                                    <h5 class="card-title mb-0"><?php echo $homework->homework_title; ?></h5>
                                    <p class="card-text text-muted font-italic">Afleveringsdato: <?php echo date('d. M, Y - h:i', strtotime($homework->due_date)); ?></p>
                                </div>
                            </div>
                    </a>
                    <?php if ($user->hasPermission("edit_homework")) : ?>
                        <div class="col-auto d-flex align-items-center ml-auto">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEF7FF;border: none; color:black;">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <form action="" method="post">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" onclick="clickOverlay('edit_homework')" value="<?php echo $homework->homework_ID ?>">Rediger</button>
                                        <input class="dropdown-item" type="hidden" name="delete" value="<?php echo $homework->homework_ID ?>">
                                        <input type="submit" class="dropdown-item" value="Slet">
                                    </ul>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
    </div>
<?php endforeach; ?>
</div>
</div>
<?php else : ?>
    <div class="row">
        <div class="card-deck mx-auto w-100">
            <?php foreach ($all_sections as $section) :
                if ($section->parent_section_ID == 0) : ?>
                    <div class="col-lg-4 col-sm-8 mx-auto col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-title mb-0 container">
                                <div class="row py-3">
                                    <div class="col-auto d-flex align-items-center">
                                        <a href="rum?id=<?php echo $section->section_ID ?>">
                                            <!-- small circle with user image -->
                                            <div class="rounded-circle bg-primary" style="width: 40px; height: 40px;">
                                                <img src="<?php echo FRONTEND_ASSET . "images/placeholder.png" ?>" class="w-100 h-100 rounded-circle">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="rum?id=<?php echo $section->section_ID ?>">
                                            <h5 class="mb-0"><?php echo $section->section_name; ?></h5>
                                            <div><?php echo $user_type == "student" ? $section->teacher->name : $section->class->class_name; ?></div>
                                        </a>
                                    </div>
                                    <?php if ($user->hasPermission("edit_homework")) : ?>
                                        <div class="col-auto d-flex align-items-center">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEF7FF;border: none; color:black;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <form action="" method="post">
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>">Gå til</a>
                                                        <button class="dropdown-item" onclick="clickOverlay('edit_section')" value="<?php echo $section->section_ID ?>">Rediger</button>
                                                        <input class="dropdown-item" type="hidden" name="delete" value="<?php echo $section->section_ID ?>">
                                                        <input type="submit" class="dropdown-item" value="Slet">
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <a class="mt-auto" href="rum?id=<?php echo $section->section_ID ?>">
                                <div>
                                    <?php if (file_exists(FRONTEND_ASSET . "sections/" . $section->section_ID . "/dashboard_img.png")) : ?>
                                        <!-- Fit image in box -->
                                        <img src="<?php echo FRONTEND_ASSET . "sections/" . $section->section_ID . "/dashboard_img.png" ?>" class="w-100 rounded-bottom">
                                    <?php else : ?>
                                        <img src="<?php echo FRONTEND_ASSET . "images/placeholder.png" ?>" class="w-100 rounded-bottom">
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="overlay" id="edit_section">
    <div class="overlay-content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="close" onclick="clickOverlay('edit_section')">X</div>
                    <h3>Rediger rum</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="section_name" class="form-label">Rum navn</label>
                            <input type="text" class="form-control" id="section_name" name="section_name" value="<?php echo $chosen_section->section_name; ?>">

                        </div>
                        <div class="mb-3">
                            <label for="section_description" class="form-label">Beskrivelse</label>
                            <textarea class="form-control" id="section_description" name="section_description" rows="3"><?php echo $chosen_section->section_description; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="dashboard_img" class="form-label">Dashboard billede</label>
                            <input class="form-control" type="file" id="dashboard_img" name="dashboard_img">
                        </div>
                        <!-- Tilføj filer -->
                        <div class="mb-3">
                            <label for="add_files" class="form-label">Tilføj filer</label>
                            <input class="form-control" type="file" id="add_files" name="add_files[]" multiple>
                        </div>
                        <!-- Tilføj lektie -->
                        <div class="mb-3">
                            <label for="add_homework" class="form-label">Tilføj lektie</label>
                            <!-- Homework title, description, date to be unlocked, due date, immersion time, group work, hidden, important -->
                            <input type="text" class="form-control" id="homework_title" name="homework_title" placeholder="Lektie titel">
                            <textarea class="form-control" id="homework_description" name="homework_description" rows="1" placeholder="Beskrivelse"></textarea>
                            <label for="homework_unlock_date" class="form-label">Dato for åbning</label>
                            <input type="datetime-local" class="form-control" id="homework_unlock_date" name="homework_unlock_date">
                            <label for="homework_due_date" class="form-label">Afleveringsdato</label>
                            <input type="datetime-local" class="form-control" id="homework_due_date" name="homework_due_date>">
                            <input type="number" class="form-control" id="homework_immersion_time" name="homework_immersion_time" placeholder="Fordybelsestid">
                            <div class="row ml-2">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="homework_group_work" name="homework_group_work">
                                    <label for="homework_group_work" class="form-check-label">Gruppearbejde</label>
                                </div>
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="homework_hidden" name="homework_hidden">
                                    <label for="homework_hidden" class="form-check-label">Skjult</label>
                                </div>
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="homework_important" name="homework_important">
                                    <label for="homework_important" class="form-check-label">Vigtig</label>
                                </div>
                            </div>
                            <input class="form-control" type="file" id="add_homework_files" name="add_homework_files[]" multiple>
                        </div>
                        <input type="hidden" name="csrf" value="<?php echo Token::generate('edit_section_form'); ?>">
                        <input type="submit" class="btn btn-primary" value="Gem">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="overlay" id="edit_file">

</div>

<div class="overlay" id="edit_homework">

</div> -->