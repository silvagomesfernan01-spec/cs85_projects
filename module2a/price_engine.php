<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>T-Shirt Price Engine</title>
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
            $customerFirstName = 'Fernanda'; // <-- IMPORTANT: REPLACE WITH YOUR ACTUAL FIRST NAME

            // --- Part A: Implement the logic below using ONLY simple, nested if-statements ---
            $finalPrice = 22.50;
            $details = "<li>Base Price: <span>$" . number_format($finalPrice, 2) . "</span></li>";

            // Rule: Size L upcharge
            if ($size == 'L') {
                $finalPrice = $finalPrice + 1.75;
                $details .= "<li>Size (L) Upcharge: <span>+$1.75</span></span></li>";
            }

            // Rule: Size XL Upcharge
            if ($size == 'XL') {
                $finalPrice = $finalPrice + 2.50;
                $details .="<li>Size (XL) Upcharge: <span>+$2.50</span></li>";
            }

            // Rule: Premium color upcharge - Sunset Orange
            if ($color == 'Sunset Orange') {
                $finalPrice = $finalPrice + 2.00;
                $details .= "<li>Premium Color Upcharge: <span>+$2.00</span></li>";
            }

            // Rule: Premium color upcharge - Ocean Blue
            if ($color == 'Ocean Blue') {
                $finalPrice = $finalPrice + 2.00;
                $details .= "<li>Premium Color Upcharge: <span>+$2.00</span></li>";
            }

            // Rule: Customization fee, with nested rule for the XL handling fee
            if ($isCustomized) {
                $finalPrice = $finalPrice + 5.00;
                $details .= "<li>Custom Text Fee: <span>+$5.00</span></li>";
    

            // Nested: Customized and size XL needs the extra stencil fee.
            if ($size == 'XL') {
                $finalPrice = $finalPrice + 3.00;
                $details .= "<li>XL Stencil Handling Fee: <span>+$3.00</span></li>";
            }
           }

           // Rule: Long Name discount
           if (strlen($customerFirstName) > 6) {
            $finalPrice = $finalPrice - 1.00;
            $details .= "<li>Long Name Discount: <span>-$1.00</span></li>";
           }


            // --- DO NOT EDIT BELOW THIS LINE ---
            echo "<ul>" . $details . "</ul>";
            echo "<ul><li><span class='total'>Final Price:</span> <span class='total'>$" . number_format($finalPrice, 2) . "</span></li></ul>";

        ?>
    </div>
</body>
</html>