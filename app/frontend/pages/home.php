<div class="row">
  <div class="col-8 mx-auto">
    <div class="row">
      <div class="col-12 col-lg-6 col-md-12 pr-0 mx-auto">
        <div class="border-bottom mb-1">
          <div class="row pl-3">
            <h3 class="col mb-0">Lektier</h3>
            <div class="col-auto">
              <a href="/alle-afleveringer?lektie=1">
                <div class="btn btn-outline-primary px-3 py-1 rounded-pill">
                  Se mere
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="homework-container pr-2" style="<?php echo count($all_homework) - $submitted_homework > 5 ? 'overflow-y: auto;' : ''; ?>">
          <?php foreach ($all_homework as $homework) : ?>
            <?php if (strtotime($homework->due_date) > strtotime(date('Y-m-d H:i:s')) && !$homework->submitted) : ?>
              <div class="w-100 rounded border row mx-auto mb-2">
                <?php if ($homework->important) : ?>
                  <div class="pl-2" style="position: absolute;">!</div>
                <?php endif; ?>
                <div class="col-auto">
                  <div class="my-3" style="width: 50px;">
                    <div class="rounded-top d-flex align-items-center justify-content-center font-weight-bold bg-secondary" style="height: 40%">
                      <?php echo date('M', strtotime($homework->due_date)); ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-center bg-offwhite" style="height: 55%;">
                      <?php echo date('d', strtotime($homework->due_date)); ?>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-sm-8 col-md-8 pl-2 pr-0">
                  <div class="text-truncate mb-1" style="max-width: 250px">
                    <a class="text-primary" href="/aflevering?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->homework_title; ?></a>
                  </div>
                  <div class="text-truncate" style="max-width: 250px">
                    <a href="/rum?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->subject_name; ?></a>
                  </div>
                  <div class="text-truncate text-muted mt-1">
                    <div class="d-flex justify-content-between mt-auto">
                      <div class="text-truncate font-weight-bold"><?php echo $dage[date('D', strtotime($homework->due_date))] . ". " . date('H:i', strtotime($homework->due_date)); ?></div>
                      <div class="text-truncate"><?php echo $homework->time_remaining ?></div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-md-12 col-sm-12 mx-auto">
        <div class="border-bottom mb-1">
          <div class="row pl-3">
            <h3 class="col mb-0">Status</h3>
            <div class="col-auto">
              <a href="/alle-afleveringer?lektie=0">
                <div class="btn btn-outline-primary px-3 py-1 rounded-pill">
                  Se mere
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="homework-container pr-2" style="<?php echo $submitted_homework > 5 ? 'overflow-y: auto;' : ''; ?>">
          <?php
          usort($all_homework, function ($a, $b) {
            return strtotime($b->due_date) - strtotime($a->due_date);
          });
          foreach ($all_homework as $homework) : ?>
            <?php if (strtotime($homework->due_date) < strtotime(date('Y-m-d H:i:s')) || $homework->submitted) : ?>
              <div class="w-100 rounded border row mx-auto mb-2">
                <div class="col-3">
                  <div class="my-3" style="width: 50px;">
                    <div class="rounded-top d-flex align-items-center justify-content-center font-weight-bold bg-secondary">
                      <?php echo date('M', strtotime($homework->due_date)); ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-center bg-offwhite">
                      <?php echo date('d', strtotime($homework->due_date)); ?>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-sm-8 col-md-8 pl-2 pr-0">
                  <div class="text-truncate mb-1" style="max-width: 250px">
                    <a class="text-primary" href="/aflevering?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->homework_title; ?></a>
                  </div>
                  <div class="text-truncate" style="max-width: 250px">
                    <a href="/rum?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->subject_name; ?></a>
                  </div>
                  <div class="text-muted mt-1">
                    <div class="d-flex justify-content-between">
                      <div class="font-weight-bold text-truncate ">
                        <?php echo $dage[date('D', strtotime($homework->due_date))] . ". " . date('H:i', strtotime($homework->due_date)); ?>
                      </div>
                      <?php if (strtotime($homework->due_date) < strtotime(date('Y-m-d H:i:s')) && !$homework->submitted && $user_type == "student") : ?>
                        <div class="text-truncate" style="color: red;">-<?php echo $homework->time_remaining ?></div>
                      <?php elseif ($user_type != "student") : ?>
                        <div class="text-truncate"><?php echo $db->get('submissions', array('homework_ID', '=', $homework->homework_ID))->count() . " / " . count($db->get('student_class', array('class_ID', '=', $homework->class->class_ID))->results()); ?>
                          Afleveret</div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php if ($user_type == "student") : ?>
                  <div class="rounded-right" style="border-right: 10px solid <?php echo $homework->submitted ? ($homework->marked ? "#AFFBAF" : "#FFEF9E") : "#FA8B8B"; ?>"></div>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <?php if ($user_type != "censor") : ?>
    <style>
      .schedule {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: repeat(<?php echo $last_hour * 60 - $first_hour * 60 ?>, 1px);
        width: 100%;
        min-height: 420px;
      }
    </style>
    <div class="col-12 col-lg-4 col-md-8 mx-auto">
      <div class="row">
        <h3 class="border-bottom pl-3 w-100"><?php echo $dage[date('D', strtotime($today))] . " " . date('d M'); ?></h3>
        <div class="schedule card pb-3">
          <?php if ($today_schedule) : ?>
            <!-- Timestamps
          <div class="timestamps">
            <?php
            //Create timestamps from first hour to last hour based on today_schedule
            for ($i = $first_hour; $i < $last_hour; $i++) {
              echo "<div class='timestamp' style='grid-row: " . $i * 60 . " / " . ($i + 1) * 60 . ";'>" . date('H:i', strtotime('00:00') + $i * 60 * 60) . "</div>";
            }
            ?>
          </div> -->
            <div class="events px-3">
              <?php foreach ($today_schedule as $event) : ?>
                <div class='event py-2' style='grid-row: <?php echo $event->first_minute - $first_hour * 60; ?>/<?php echo $event->last_minute - $first_hour * 60; ?>;
              background-color: <?php echo isset($event->color) ? $event->color : "#e9ecef"; ?>;
              border-color: <?php echo isset($event->color) ? darken($event->color, 30) : "#e9ecef"; ?>;'>
                  <div class="row px-2">
                    <div class="col-8">
                      <h6><?php echo $event->subject_name; ?></h6>
                      <a><?php echo $event->time . " - " . date('H:i', strtotime($event->time) + $event->period * 60 * 60); ?></a>
                      <a><?php echo $event->teacher; ?></a>
                    </div>
                    <div class="col-4">
                      <a>Room: <?php echo $event->room; ?></a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Create monthly schedule, make it 100% width -->
    <div class="w-100 mt-5"></div>
    <img src="<?php echo FRONTEND_ASSET . "images/Kalender.png" ?>" class="w-100 h-100">
</div>
<?php endif; ?>