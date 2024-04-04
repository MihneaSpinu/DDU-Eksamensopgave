<style>
    .schedule {
        display: grid;
        grid-template-rows: repeat(660, 1px);
        border: 1px solid #ddd;
        border-radius: 5px;
        position: relative;
    }

    .timestamps,
    .events {
        display: grid;
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

    .events {
        display: grid;
        grid-template-columns: 60px 1fr;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <?php if ($schedule) : ?>
            <div class="col-md-8 offset-md-2">
                <div class="schedule">
                    <!-- Timestamps -->
                    <div class="timestamps" style="grid-column: 1;">
                        <?php
                        for ($i = $first_hour; $i < $last_hour; $i++) {
                            echo "<div class='timestamp border-top' style='grid-row: " . $i * 60 - ($first_hour * 60) . " / " . ($i + 1) * 60 - ($first_hour * 60) . ";'>" . date('H:i', strtotime('00:00') + $i * 60 * 60) . "</div>";
                        }
                        ?>
                    </div>
                    <?php $i = 0;
                    foreach ($week_schedule as $day) :
                        $i++; ?>
                        <div class="events border-left" style="grid-row: 1/660; grid-column: <?php echo $i + 1; ?>">
                            Day
                            <?php foreach ($day as $event) : ?>
                                <div class='event ml-2 py-2' style='grid-row: <?php echo $event->first_minute - ($first_hour * 60) . "/" . $event->last_minute - ($first_hour * 60); ?>;'>
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
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                No schedule
            <?php endif; ?>
            </div>
    </div>
</div>