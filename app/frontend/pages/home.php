<div class="row">
  <div class="col-md-8">
    <div class="left-box" style="height: 350px; background-color: lightblue;">
      <!-- Content for left box -->
      afleveringer
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="col-md-12">
        <div class="right-box" style="height: 350px; background-color: lightgreen;">
          <!-- Insert image of schedule to fit box from frontend/assets/images/dagSkemaScreenshot.png -->
          <img src="<?php echo FRONTEND_ASSET . "images/dagSkemaScreenshot.png" ?>" class="w-100 h-100">
        </div>
      </div>
      <!-- <div class="col-md-12 mt-md-3">
        <div class="right-box" style="height: 150px; background-color: lightcoral;">
          
          Nyheder
        </div>
      </div> -->
    </div>
  </div>

</div>

<style>
  .schedule {
    display: grid;
    grid-template-columns: 60px 1fr;
    grid-template-rows: repeat(1440, 1px);
    border: 1px solid #ddd;
    border-radius: 5px;
    position: relative;
  }

  .timestamps,
  .events {
    display: grid;
    grid-template-columns: 1fr;
    grid-auto-rows: 1px;
    position: relative;
  }

  .timestamp {
    text-align: center;
  }

  .event {
    background-color: #e9ecef;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    white-space: nowrap;
  }
</style>
<script>
  //Make grid-template-rows start from first hour of today_schedule[0] and end at last hour of today_schedule[today_schedule.length - 1]
  const first_hour = <?php echo $first_hour; ?>;
  const last_hour = <?php echo $last_hour; ?>;
  const schedule = document.querySelector('.schedule');
  schedule.style.gridTemplateRows = `repeat(${last_hour - first_hour}, 1px)`;
  
</script>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="schedule">
        <!-- Timestamps -->
        <div class="timestamps">
          <?php
          //Create timestamps from first hour to last hour based on today_schedule
          for ($i = $first_hour; $i < $last_hour; $i++) {
            echo "<div class='timestamp' style='grid-row: " . $i * 60 . " / " . ($i + 1) * 60 . ";'>" . date('H:i', strtotime('00:00') + $i * 60 * 60) . "</div>";
          }
          ?>
        </div>
        <div class="events">
          <?php foreach ($today_schedule as $event) : ?>

            <div class='event ml-2 py-2' style='grid-row: <?php echo $event->first_minute; ?>/<?php echo $event->last_minute; ?>;'>
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
          <?php endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>