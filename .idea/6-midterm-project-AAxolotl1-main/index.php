<?php
    $inputs = filter_input(INPUT_GET, "inputs", FILTER_VALIDATE_INT);
    $score = [];
    $total = [];

    if (isset($inputs)) {
        for ($i = 0; $i < $inputs; $i++) {
            $score[$i] = filter_input(INPUT_GET, "score".$i, FILTER_SANITIZE_SPECIAL_CHARS);
            $total[$i] = filter_input(INPUT_GET, "total".$i, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }

    if ($inputs < 0) {
        $inputs = 0;
    }
    if (!isset($inputs)) {
        $inputs = 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Test</title>
</head>
<body>
    <form id="form" method="get" action="index.php">
        <div class="input-row">
            <div class="column">
                <label for="assignment">Assignments</label>
                <?php
                    for ($i = 0; $i < $inputs; $i++) {
                        echo '<input type="text" value="Assignment '.($i+1).'" readonly />';
                    }
                ?>
            </div>
            <div class="column">
                <label for="score">Points Earned</label>
                <?php
                    for ($i = 0; $i < $inputs; $i++) {
                        echo '<input type="text" name="score'.$i.'" value="'.htmlspecialchars($score[$i]).'" id="score'.$i.'" />';
                    }
                ?>
            </div>
            <div class="column">
                <label for="total">Points Possible</label>
                <?php
                    for ($i = 0; $i < $inputs; $i++) {
                        echo '<input type="text" name="total'.$i.'" value="'.htmlspecialchars($total[$i]).'" id="total'.$i.'" />';
                    }
                ?>
            </div>
        </div>

        <button type="button" onclick="addValue()">Add Text Box</button>
        <button type="button" onclick="subtractValue()">Remove Text Box</button>
        <input type="hidden" name="inputs" id="count" value="<?php echo htmlspecialchars($inputs) ?>">
    </form>

    <form id="calculate" method="get" action="results.php">
        <?php
            for ($i = 0; $i < $inputs; $i++) {
                echo '<input type="hidden" name="assignment'.$i.'" value="Assignment '.($i+1).'" id="calculateAssignment'.$i.'" />
                      <input type="hidden" name="score'.$i.'" value="" id="calculateScore'.$i.'"/>
                      <input type="hidden" name="total'.$i.'" value="" id="calculateTotal'.$i.'"/>';
            }
        ?>
        <input type="hidden" name="inputs" id="calculateCount" value="<?php echo htmlspecialchars($inputs) ?>"/>
        <button type="button" onclick="calculate()">Calculate</button>
    </form>

    <script>
        function addValue() {
            var count = parseInt(document.getElementById('count').value);
            count++;
            document.getElementById('count').value = count;
            document.getElementById('form').submit();
        }

        function subtractValue() {
            var count = parseInt(document.getElementById('count').value);
            count--;
            document.getElementById('count').value = count;
            document.getElementById('form').submit();
        }

        function calculate() {
            var count = parseInt(document.getElementById('count').value);
            document.getElementById('calculateCount').value = count;
            for (var i = 0; i < count; i++) {
                document.getElementById('calculateScore' + i).value = document.getElementById('score' + i).value;
                document.getElementById('calculateTotal' + i).value = document.getElementById('total' + i).value;
            }

            document.getElementById('calculate').submit();
        }
    </script>
</body>
</html>
