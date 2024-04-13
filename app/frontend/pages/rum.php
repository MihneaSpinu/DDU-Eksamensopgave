<?php if ($section_id != null) :
    // Dette printer alting i det øverste rum, altså når man vælger et rum for et fag
    if ($chosen_section->parent_section_ID == 0) : ?>
        Dette skal vise mapper for det valgte rum.
        <div class="row">
            <div class="card-deck mx-auto w-100">
                <?php foreach ($all_sections as $section) :
                    if ($section->parent_section_ID == $chosen_section->section_ID) : ?>
                        <div class="col-lg-4 col-sm-6 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-title">
                                    <div class="row">
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
                                                <div><?php echo $section->teacher->name ?></div>
                                            </a>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <div class="dropdown" style="background-color: #FEF7FF;">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEF7FF;border: none; color:black;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>">Gå til</a>
                                                    <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>&edit=true">Rediger</a>
                                                    <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>&delete=true">Slet</a>
                                                    <a class="dropdown-item">Stjernemarker</a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endif;
                endforeach; ?>
            </div>
        </div>
        <!-- Dette printer alt for alle undermapper -->
    <?php else : ?>
        <div class="row">
            <div class="card-deck mx-auto w-100">
                <?php foreach ($all_sections as $section) :
                    if ($section->parent_section_ID == $chosen_section->section_ID) : ?>

                <?php endif;
                endforeach; ?>
            </div>
        </div>
        <!-- Print everything from section_files table with the section id -->
        
    <?php endif; ?>

<?php else : ?>
    Sorter stjernemarkeret, sorter alfabetisk
    <br><br>
    <div class="row">
        <div class="card-deck mx-auto w-100">
            <?php foreach ($all_sections as $section) :
                if ($section->parent_section_ID == 0) : ?>
                    <div class="col-lg-4 col-sm-6 col-md-6 mb-4">
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
                                            <div><?php echo $section->teacher->name ?></div>
                                        </a>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="dropdown" style="background-color: #FEF7FF;">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEF7FF;border: none; color:black;">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>">Gå til</a>
                                                <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>&edit=true">Rediger</a>
                                                <a class="dropdown-item" href="/rum?id=<?php echo $section->section_ID ?>&delete=true">Slet</a>
                                                <a class="dropdown-item">Stjernemarker</a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="rum?id=<?php echo $section->section_ID ?>">
                                <div class="mt-auto">
                                    <?php if (file_exists("assets/images/sections/" . $section->section_ID . "/dashboard_img")) : ?>
                                        <img src="<?php echo FRONTEND_ASSET . "sections/" . $section->section_ID . "/dashboard_img" ?>" class="w-100">
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