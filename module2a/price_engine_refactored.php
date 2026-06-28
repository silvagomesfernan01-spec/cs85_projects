<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>T-Shirt Price Engine (Refactored)</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f6f8; color: #333; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .receipt { background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 400px; border-top: 5px solid #005a9c; }
        h1 { text-align: center; color: #005a9c; }
        ul { list-style: none; padding: 0; }
        li { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .total { font-size: 1.5em; color: #28a745; }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Order Summary</h1>
        <?php
            // --- Configuration: Change these values to test all business rules! ---
            $size = 'XL'; // Options: 'S', 'M', 'L', 'XL'
            $color = 'Sunset Orange'; // Any string, but test with 'Sunset Orange' or 'Ocean Blue'
            $isCustomized = true; // Options: true, false
            $customerFirstName = 'Nanda'; // <-- IMPORTANT: REPLACE WITH YOUR ACTUAL FIRST NAME

            // Part B: Refactiored logic using if/elseif/else and compound operators
            $finalPrice = 22.50;
            $details = "<li>Base Price: <span>$" . number_format($finalPrice, 2) . "</span></li>";

            // Size upcharge: a shirt is only ever S, M, L or XL
            // elseif instead of two separate ifs.
            if ($size == 'L') {
                $finalPrice += 1.75;
                $details .= "<li>Size (L) Upcharge: <span>+$1.75</span></li>";
            } elseif ($size == 'XL') {
                $finalPrice += 2.50;
                $details .= "<li>Size (XL) Upcharge: <span>+$2.50</span></li>";
            }

            // Premium color upcharge: for either color we use the same upcharge
            // a single || condition
            if ($color == 'Sunset Orange' || $color == 'Ocean Blue') {
                $finalPrice += 2.00;
                $details .= "<li>Premium Color Upcharge: <span>+$2.00</span></li>";
            }

            // Customization fees: "customized and XL" into one && check
            // instead of nesting. elseif handles "customized but not XL" case.
            if ($isCustomized && $size == 'XL') {
                $finalPrice += 8.00; // $5.00 base fee + $3.00 XL stencil handling fee
                $details .= "<li>Custom Text Fee: <span>+$5.00</span></li>";
                $details .= "<li>XL Stencil Handling Fee: <span>+$3.00</span></li>";
            } elseif ($isCustomized) {
                $finalPrice += 5.00;
                $details .= "<li>Custom Text Fee: <span>+$5.00</span></li>";
            }

            // Long Name discount
            if (strlen($customerFirstName) > 6) {
                $finalPrice -= 1.00;
                $details .= "<li>Long Name Discount: <span>-$1.00</span></li>";
            }

            // --- DO NOT EDIT BELOW THIS LINE ---
            echo "<ul>" . $details . "</ul>";
            echo "<ul><li><span class='total'>Final Price:</span> <span class='total'>$" . number_format($finalPrice, 2) . "</span></li></ul>";
 
        ?>
    </div>
</body>
</html>
 
<?php

/*
MY DEBUGGING LOG:
Problem: I had written an 'if ($isCustomized)' check nested inside my XL size block to add
the $8.00 (custom fee + stencil fee), but I also had a separate 'if ($isCustomized)'
block elsewhere in the code that added the same $8.00 again.
Solution: I went through the $details list line by line instead of just checking the
total, and noticed "Custom Text Fee" and "XL Stencil Handling Fee" each appeared twice
on the receipt. I removed the duplicate. 
*/
