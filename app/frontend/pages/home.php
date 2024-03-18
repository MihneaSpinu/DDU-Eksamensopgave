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
          <!-- Content for first right box -->
          Skema
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
:root {
  --numDays: 1;
  --numMinutes: 720;
  --timeHeight: 1px;
  --calBgColor: #fff1f8;
  --eventBorderColor: #f2d3d8;
  --eventColor1: #ffd6d1;
  --eventColor2: #fafaa3;
  --eventColor3: #e2f8ff;
  --eventColor4: #d1ffe6;
}

.calendar {
  display: grid;
  gap: 10px;
  grid-template-columns: auto 1fr;
  margin: 2rem;
}

.timeline {
  display: grid;
  grid-template-rows: repeat(var(--numMinutes * 60), var(--timeHeight));
}

.days {
  display: grid;
  grid-column: 2;
  gap: 5px;
  grid-template-columns: repeat(auto-fit, minmax(150px, 0.5fr));
}

.events {
  display: grid;
  grid-template-rows: repeat(var(--numMinutes), var(--timeHeight));
  border-radius: 5px;
  background: var(--calBgColor);
}

.title {
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.event {
  border: 1px solid var(--eventBorderColor);
  border-radius: 5px;
  padding: 0.5rem;
  margin: 0 0.5rem;
  background: white;
}

.space,
.date {
  height: 60px;
}

.spacer {
  height: 16px;
}

body {
  font-family: system-ui, sans-serif;
}

.corp-fi {
  background: var(--eventColor1);
}

.ent-law {
  background: var(--eventColor2);
}

.writing {
  background: var(--eventColor3);
}

.securities {
  background: var(--eventColor4);
}

.date {
  display: flex;
  gap: 1em;
}

.date-num {
  font-size: 3rem;
  font-weight: 600;
  display: inline;
}

.date-day {
  display: inline;
  font-size: 3rem;
  font-weight: 100;
}
</style>
<div class="calendar">
  <div class="timeline">
    <div class="spacer"></div>
    <?php 
    //Round first_minute down and last_minute up to nearest hour
      for ($i = floor($first_minute / 60); $i <= ceil($last_minute / 60); $i++) {
        echo "<div class='time-marker'>$i:00</div>";
      }
    ?>
    <!-- <div class="time-marker">06:00</div>
    <div class="time-marker">07:00</div>
    <div class="time-marker">08:00</div>
    <div class="time-marker">09:00</div>
    <div class="time-marker">10:00</div>
    <div class="time-marker">11:00</div>
    <div class="time-marker">12:00</div>
    <div class="time-marker">13:00</div>
    <div class="time-marker">14:00</div>
    <div class="time-marker">15:00</div>
    <div class="time-marker">16:00</div>
    <div class="time-marker">17:00</div> -->
  </div>
  <div class="days">
    <div class="day mon">
      <div class="date">
        <?php
          $date = date('Y-m-d');
          echo "<p class='date-num'>" . date('d', strtotime($date)) . "</p>";
          echo "<p class='date-day'>" . date('D', strtotime($date)) . "</p>";
        ?>
      </div>
      <div class="events">
        <?php
          foreach ($today_schedule as $event) {
            if (date('D', strtotime($event->date)) == date('D')) {
              echo "<div class='event securities' style='grid-row-start: " . $event->minute - $first_hour * 60 . "; grid-row-end: " .$event->minute - $first_hour * 60 + $event->period * 60 . "'>";
              echo "<p class='title'>" . $event->subject_name . "</p>";
              echo "<p class='time'>" . date('H:i', strtotime($event->time)) . "-" . date('H:i', strtotime($event->time) + 60 * ($event->period * 60)) . "</p>";
              echo "</div>";
            }
          }
        ?>
        <!-- <div class="event securities" style="grid-row-start: 1; grid-row-end: 250">
          <p class="title">Securities Regulation</p>
          <p class="time">08:00 - 10:10</p>
        </div>
        <div class="event corp-fi" style="grid-row-start: 260; grid-row-end: 360">
          <p class="title">Corporate Finance</p>
          <p class="time">10:20 - 12:00</p>
        </div>
        <div class="event ent-law" style="grid-row-start: 420; grid-row-end: 540">
          <p class="title">Entertainment Law</p>
          <p class="time">13:00 - 15:00</p>
        </div>
        <div class="event securities" style="grid-row-start: 180; grid-row-end: 320">
          <p class="title">Securities Regulation</p>
          <p class="time">09:00 - 11:20</p>
        </div> -->
      </div>
    </div>
  </div>
</div>

<script>
  let numMinutes = <?php echo $amount_of_minutes; ?>;
  document.documentElement.style.setProperty("--numMinutes", numMinutes); 
</script>