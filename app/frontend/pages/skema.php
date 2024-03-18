<div class="calendar" style="height:500px;overflow:auto;">
    <div class="timeline">
        <div class="spacer"></div>
        <?php
        //For each hour in the day, print a line 00:00, 01:00, 02:00 etc.
        for ($i = 0; $i < 24; $i++) {
            echo "<div class='hour'>" . str_pad($i, 2, "0", STR_PAD_LEFT) . ":00</div>";
        }

        ?>
    </div>
    <div class="days">
        <?php
        $days = array('Mon', 'Tues', 'Wed', 'Thurs', 'Fri');
        $today = date('D');
        $today = array_search($today, $days);
        for ($i = 0; $i < 5; $i++) {
            $day = $days[($today + $i) % 5];
            $date = date('d', strtotime("monday this week +$i days"));

            echo "<div class='day $day'>";
            echo "<div class='date'>";
            echo "<p class='date-num'>$date</p>";
            echo "<p class='date-day'>$day</p>";
            echo "</div>";
            echo "<div class='events'>";
            foreach ($schedule as $s) {
                if (date('d', strtotime($s->date)) == $date) {
                    echo "<div class='event' style='grid-row-start: " . date('H', strtotime($s->date)) + 1 . "; grid-row-end: " . date('H', strtotime($s->date . " + $s->period hours")) + 1 . ";'>";

                    echo "<p class='title'>$s->subject_name</p>";
                    //Print time fx 10:00 - 12:00. Date is written as 2021-09-13 13:10:56, but only want to print 10:00 - 10:00 + period
                    echo "<p class='time'>" . date('H:i', strtotime($s->date)) . " - " . date('H:i', strtotime($s->date . " +$s->period hours")) . "</p>";

                    echo "<p class='room'>$s->room</p>";
                    echo "</div>";
                }
            }
            echo "</div>";
            echo "</div>";
        }

        ?>
    </div>
</div>

<div class="container">
    <!-- Create calendar using table instead. Put classes by hours and minutes, not only hours -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Time</th>
                <th scope="col">Monday</th>
                <th scope="col">Tuesday</th>
                <th scope="col">Wednesday</th>
                <th scope="col">Thursday</th>
                <th scope="col">Friday</th>
            </tr>
        </thead>
        <div style="height: 500px; overflow: auto;">
            <tbody>
                <?php
                for ($i = 0; $i < 24; $i++) {
                    echo "<tr>";
                    echo "<td>" . str_pad($i, 2, "0", STR_PAD_LEFT) . ":00</td>";
                    for ($j = 0; $j < 5; $j++) {
                        echo "<td>";
                        foreach ($schedule as $s) {
                            if (date('H', strtotime($s->date)) == $i && date('D', strtotime($s->date)) == $days[$j]) {
                                echo "<div class='event'>";
                                echo "<p class='title'>$s->subject_name</p>";
                                echo "<p class='time'>" . date('H:i', strtotime($s->date)) . " - " . date('H:i', strtotime($s->date . " +$s->period hours")) . "</p>";
                                echo "<p class='room'>$s->room</p>";
                                echo "</div>";
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </div>
    </table>
</div>