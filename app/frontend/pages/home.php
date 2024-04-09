<div class="row">
  <div class="col-8 mx-auto">
    <div class="row">
      <div class="col-8 col-lg-6 col-md-12 pr-0 mx-auto">
        <h3 class="border-bottom pl-3">Lektier</h3>
        <div class="homework-container pr-2" style="<?php echo count($all_homework) - $submitted_homework > 5 ? 'overflow-y: auto;' : ''; ?>">
          <?php foreach ($all_homework as $homework) : ?>
            <?php if (strtotime($homework->due_date) > strtotime(date('Y-m-d H:i:s')) && !$homework->submitted) : ?>
              <div class="w-100 rounded border row mx-auto mb-2">
                <?php if ($homework->important) : ?>
                  <div class="pl-2" style="position: absolute;">!</div>
                <?php endif; ?>
                <div class="col-auto">
                  <div class="my-3" style="width: 50px;">
                    <div class="rounded-top d-flex align-items-center justify-content-center font-weight-bold bg-primary" style="height: 40%">
                      <?php echo date('M', strtotime($homework->due_date)); ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-center bg-offwhite" style="height: 55%;">
                      <?php echo date('d', strtotime($homework->due_date)); ?>
                    </div>
                  </div>
                </div>
                <div class="col pl-0">
                  <div class="text-truncate mb-1" style="max-width: 250px">
                    <a class="text-primary" href="/aflevering?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->homework_title; ?></a>
                  </div>
                  <div class="text-truncate" style="max-width: 250px">
                    <a href="/rum?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->subject_name; ?></a>
                  </div>
                  <div class="text-truncate text-muted mt-1">
                    <div class="d-flex justify-content-between mt-auto">
                      <div class="text-truncate font-weight-bold"><?php echo $dage[date('D', strtotime($homework->due_date))] . ". " . date('H:i', strtotime($homework->due_date)); ?></div>
                      <div class="text-truncate">
                        <?php
                        $today = date('Y-m-d');
                        $due_date = $homework->due_date;
                        $diff = abs(strtotime($due_date) - strtotime($today));
                        $days = floor($diff / (60 * 60 * 24));
                        $hours = floor($diff / (60 * 60)) - ($days * 24);
                        if ($days > 1) {
                          echo $days . " dage, " . $hours . " timer";
                        } else {
                          echo $hours . " timer";
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-md-12 col-sm-12 mx-auto">
        <h3 class="border-bottom pl-3">Status</h3>
        <div class="homework-container pr-2" style="<?php echo $submitted_homework > 5 ? 'overflow-y: auto;' : ''; ?>">
          <?php
          usort($all_homework, function ($a, $b) {
            return strtotime($b->due_date) - strtotime($a->due_date);
          });
          foreach ($all_homework as $homework) : ?>
            <?php if (strtotime($homework->due_date) < strtotime(date('Y-m-d H:i:s')) || $homework->submitted) : ?>
              <div class="w-100 rounded border row mx-auto mb-2">
                <div class="col-auto">
                  <div class="my-3" style="width: 50px;">
                    <div class="rounded-top d-flex align-items-center justify-content-center font-weight-bold bg-primary">
                      <?php echo date('M', strtotime($homework->due_date)); ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-center bg-offwhite">
                      <?php echo date('d', strtotime($homework->due_date)); ?>
                    </div>
                  </div>
                </div>
                <div class="col pl-0">
                  <div class="text-truncate mb-1" style="max-width: 250px">
                    <a class="text-primary" href="/aflevering?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->homework_title; ?></a>
                  </div>
                  <div class="text-truncate" style="max-width: 250px">
                    <a href="/rum?id=<?php echo $homework->homework_ID; ?>"><?php echo $homework->subject_name; ?></a>
                  </div>
                  <div class="text-muted mt-1">
                    <div class="d-flex justify-content-between">
                      <div class="font-weight-bold"><?php echo $dage[date('D', strtotime($homework->due_date))] . ". " . date('H:i', strtotime($homework->due_date)); ?></div>
                      <?php if (strtotime($homework->due_date) < strtotime(date('Y-m-d H:i:s')) && !$homework->submitted) : ?>
                        <div style="color: red;">
                          <?php
                          $today = date('Y-m-d');
                          $due_date = $homework->due_date;
                          $diff = abs(strtotime($due_date) - strtotime($today));
                          $days = floor($diff / (60 * 60 * 24));
                          $hours = floor($diff / (60 * 60)) - ($days * 24);
                          if ($days > 1) {
                            echo "-" . $days . " dage, " . $hours . " timer";
                          } else {
                            echo "-" . $hours . " timer";
                          }
                          ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="rounded-right" style="border-right: 10px solid <?php echo $homework->submitted ? ($homework->marked ? "#AFFBAF" : "#FFEF9E") : "#FA8B8B"; ?>"></div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <style>
    .schedule {
      display: grid;
      grid-template-columns: 1fr;
      grid-template-rows: repeat(<?php echo $last_hour * 60 - $first_hour * 60 ?>, 1px);
      width: 100%;
      min-height: 420px;
    }
  </style>
  <div class="col col-lg-4 col-md-8 mx-auto">
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
  <div class="w-100 border mt-5" style="height: 200px;">Måned</div>
</div>