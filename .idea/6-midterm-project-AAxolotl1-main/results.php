<?php
    $inputs = filter_input(INPUT_GET, "inputs", FILTER_VALIDATE_INT);
    $sumScore = 0;
    $sumTotal = 0;
    $average = 0;
    $score = [];
    $total = [];
    $percentage = [];

    for ($i = 0; $i < $inputs; $i++) {
        $score[$i] = filter_input(INPUT_GET, "score".$i, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($score[$i] == "") {
            $score[$i] = 0;
        }
        $total[$i] = filter_input(INPUT_GET, "total".$i, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($total[$i] == "") {
            $total[$i] = 0;
        }
        if ($total[$i] == 0) {
            $percentage[$i] = "Cannot Divide by 0";
            $score[$i] = "Total Input was blank or = 0";
        } else {
            $percentage[$i] = number_format($score[$i] / $total[$i] * 100, 2).'%';
            $sumScore += $score[$i]; 
            $sumTotal += $total[$i];
        }
    }
    $average = number_format($sumScore / $sumTotal * 100, 2).'%';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        p {
            margin: 10px 0;
        }

        .input-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .column {
            flex: 0 0 calc(24% - 10px);
            box-sizing: border-box;
            padding: 0 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        @media only screen and (max-width: 600px) {
            .column {
                flex: 0 0 100%;
                margin-bottom: 10px;
            }
        }

        form {
            margin-top: 20px;
        }

        button[type="submit"] {
            padding: 12px;
            margin: 8px 5px;
            cursor: pointer;
        }

    </style>
    <title>Test</title>
</head>
<body>
    <div class="input-row">
        <div class="column">
            <label for="assignment">Assignments</label>
            <?php
                for ($i = 0; $i < $inputs; $i++) {
                    echo '<input type="text" value="Assignment '.($i+1).'" readonly />';
                }
            ?>
            <input type="text" value="Total" readonly />
        </div>
        <div class="column">
            <label for="score">Points Earned</label>
            <?php
                for ($i = 0; $i < $inputs; $i++) {
                    echo '<input type="text" name="score'.$i.'" value="'.htmlspecialchars($score[$i]).'" id="score'.$i.'" readonly />';
                }
            ?>
            <input type="text" name="sumScore" value="<?php echo $sumScore; ?>" readonly />
        </div>
        <div class="column">
            <label for="total">Points Possible</label>
            <?php
                for ($i = 0; $i < $inputs; $i++) {
                    echo '<input type="text" name="total'.$i.'" value="'.htmlspecialchars($total[$i]).'" id="total'.$i.'" readonly />';
                }
            ?>
            <input type="text" name="sumTotal" value="<?php echo $sumTotal; ?>" readonly />
        </div>
        <div class="column">
            <label for="percentage">Percentage</label>
            <?php
                for ($i = 0; $i < $inputs; $i++) {
                    echo '<input type="text" name="percentage'.$i.'" value="'.htmlspecialchars($percentage[$i]).'" id="percentage'.$i.'" readonly />';
                }
            ?>
            <input type="text" name="average" value="<?php echo $average; ?>" readonly />
        </div>
    </div>
    <form method="get" action="index.php">
        <button type="submit">Back</button><br>
    </form>
</body>
</html>
