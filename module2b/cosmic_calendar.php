<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cosmic Calendar</title>
    <!-- All styling for the final output page is included below -->
    <style>
        body { font-family: sans-serif; background-color: #1a202c; color: #e2e8f0; }
        .container { max-width: 800px; margin: 2rem auto; padding: 2rem; background-color: #2d3748; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        h1 { text-align: center; color: #9f7aea; }
        .calendar-grid { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .day-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 5px; background-color: #4a5568; font-size: 1.2rem; }
        .cosmic-name { background-color: #9f7aea; color: #fff; transform: scale(1.1); box-shadow: 0 0 15px #9f7aea; }
        .cosmic-month { border: 2px solid #f6e05e; }
        .cosmic-both { background-color: #ed8936; color: #fff; border: 2px solid #f6e05e; transform: scale(1.1); box-shadow: 0 0 15px #ed8936; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cosmic Calendar</h1>
        <div class="calendar-grid">
            <?php

            // Step 1: Set up name and fetch API data
            $firstName = "Fernanda";
            $nameLength = strlen($firstName);

            $jsonString = file_get_contents('https://timeapi.io/api/time/current/zone?timeZone=America%2FLos_Angeles');
            $apiData = json_decode($jsonString);

            // Guard against the API call failing 
            if ($apiData) {

                // Step 2: Define the loop range
                $dateTimeString = $apiData->dateTime;
                $date = new DateTime($dateTimeString);
                $dayOfYear = (int)$date->format('z') + 1;
                $month = $apiData->month;
            
                // Step 3 & 4: Loop through the range, applying cosmic logic
                for ($i = $nameLength; $i <= $dayOfYear; $i++) {
                    $cssClass = "day-box";

                    if ($i % $nameLength === 0 && $i % $month === 0) {
                        $cssClass .= " cosmic-both";
                    } elseif ($i % $nameLength === 0) {
                        $cssClass .= " cosmic-name";
                    } elseif ($i % $month === 0) {
                        $cssClass .= " cosmic-month";
                    }

                    // Step 5: Display the box
                    echo "<div class='$cssClass'>$i</div>";
                }

            } else {
                echo "<p>Could not load calendar data &mdash; the API request failed.</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>

/*
MY DEBUGGING LOG:
Problem: After fixing a syntax error, I still got a "resource not found" error
trying to load cosmic_calendar.php in the browser. I had started the PHP
built-in server with `php -S localhost:8000` from inside my module2b folder
and was requesting localhost:8000/module2b/cosmic_calendar.php.
Solution: I learned that php -S treats whatever folder you launch it from as
the server's document root. Since I launched it from inside module2b itself,
that folder WAS the root — there was no nested module2b folder inside it for
the URL to find. I fixed it by requesting localhost:8000/cosmic_calendar.php
instead (dropping the /module2b/ prefix), which matched where the server was
actually rooted.
*/
        
        