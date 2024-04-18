<table class="table">
    <thead>
        <tr>
            <th></th>
            <th scope="col">Opgave</th>
            <th scope="col">Fag</th>
            <th scope="col">Afleveringsdato</th>
            <th scope="col"><?php echo $type == 'homework' ? "Tid tilbage" : "Opgave Status"; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($type == "homework") : foreach ($deadlines as $homework) : ?>
                <tr onclick="window.location='/aflevering?id=<?php echo $homework->homework_ID; ?>';">
                    <td>
                        <div style="width: 50px;">
                            <div class="rounded-top d-flex align-items-center justify-content-center font-weight-bold bg-secondary">
                                <?php echo date('M', strtotime($homework->due_date)); ?>
                            </div>
                            <div class="d-flex align-items-center justify-content-center bg-offwhite">
                                <?php echo date('d', strtotime($homework->due_date)); ?>
                            </div>
                        </div>
                    </td>
                    <td class="text-primary"><?php echo $homework->homework_title ?></td>
                    <td><?php echo $homework->subject_name ?></td>
                    <td><?php echo $dage[date('D', strtotime($homework->due_date))] . ". " . date('d M h:t', strtotime($homework->due_date)) ?></td>
                    <td><?php echo $homework->time_remaining ?></td>
                </tr>
            <?php endforeach;
        else : foreach ($submissions as $homework) : ?>
                <tr onclick="window.location='/aflevering?id=<?php echo $homework->homework_ID; ?>';">
                    <td style="width: 5%;">
                        <div style="width: 50px;">
                            <div class="rounded-top d-flex align-items-center justify-content-center font-weight-bold bg-secondary">
                                <?php echo date('M', strtotime($homework->due_date)); ?>
                            </div>
                            <div class="d-flex align-items-center justify-content-center bg-offwhite">
                                <?php echo date('d', strtotime($homework->due_date)); ?>
                            </div>
                        </div>
                    </td>
                    <td class="text-primary col-3"><?php echo $homework->homework_title ?></td>
                    <!-- Find subject in $all_subjects based on $homework->section_ID and its subject_class_ID -->
                    <td class="col-2"><?php echo $homework->subject_name;
                                        echo $user_type == "teacher" ? " - " . $homework->class->class_name : "" ?></td>
                    <td><?php echo $dage[date('D', strtotime($homework->due_date))] . ". " . date('d M h:t', strtotime($homework->due_date)) ?></td>
                    <?php if ($user_type == "student") : ?>
                        <td class="rounded-right" style="border-right: 10px solid <?php echo $homework->submitted ? ($homework->marked ? "#AFFBAF" : "#FFEF9E") : "#FA8B8B"; ?>">
                            <?php if ($user_type == "student") {
                                if ($homework->submitted) {
                                    echo $homework->marked ? "Opgave besvaret (" . $homework->grade . ")" : "Venter på besvarelse";
                                } else {
                                    echo "<a style='color: red'>-" . $homework->time_remaining;
                                }
                            } ?>
                        </td>
                    <?php else : ?>
                        <td>
                            <!-- Amount of students who have submitted (__ / max submitted) -->
                            <?php echo $db->get('submissions', array('homework_ID', '=', $homework->homework_ID))->count() . " / " . count($db->get('student_class', array('class_ID', '=', $homework->class->class_ID))->results()); ?>
                            Elever afleveret
                        </td>
                    <?php endif; ?>
                </tr>
        <?php endforeach;
        endif; ?>
    </tbody>
</table>