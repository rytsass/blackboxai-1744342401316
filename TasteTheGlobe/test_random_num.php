<?php
// Include the functions file if the function is defined there
// include 'functions.php'; // Uncomment this line if your function is in a separate file

function random_num($length) {
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);

    // Corrected loop condition
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}

// Test the function with different lengths
$test_lengths = [5, 10, 15, 20, 25];

foreach ($test_lengths as $length) {
    $result = random_num($length);
    echo "Random number of length $length: $result\n";
}
?>