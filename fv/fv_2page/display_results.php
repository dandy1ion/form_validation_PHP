<?php
    // get the data from the form
    $investment = filter_input(INPUT_POST, "investment", FILTER_VALIDATE_INT);
    $interest_rate = filter_input(INPUT_POST, "interest_rate", FILTER_VALIDATE_INT);
    $years = filter_input(INPUT_POST, "years", FILTER_VALIDATE_INT);

    // validate investment inputs here
        
        // Investment
        //Make sure we are working with an integer
        if(!is_int($investment)) {
            $error_message = "Investment must be a number.";
        } elseif($investment <= 0) {
            $error_message = "Investment must be greater than zero.";
        }

        //Interest rate
        //Make sure we are working with an integer
        elseif(!is_int($interest_rate)) {
            $error_message = "Interest rate must be a number.";
        } elseif($interest_rate <= 0) {
            $error_message = "Interest rate must be greater than zero.";
        }   elseif($interest_rate > 15) {
            $error_message = "Interest rate must be less than or equal to 15.";
        }

        //Years
        //Make sure we are working with an integer
        elseif(!is_int($years)) {
            $error_message = "Years must be a whole number.";
        } elseif($years <= 0) {
            $error_message = "Years must be greater than zero.";
        } elseif($years >= 31) {
            $error_message = "Years must be less than 31.";
        } else {
            $error_message = "";
        }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit(); }

    // calculate the future value
    $future_value = $investment;
    for ($i = 1; $i <= $years; $i++) {
        $future_value = 
            $future_value + ($future_value * $interest_rate * .01); 
    }

    // apply currency and percent formatting
    $investment_f = '$'.number_format($investment, 2);
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = '$'.number_format($future_value, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>
    </main>
</body>
</html>
