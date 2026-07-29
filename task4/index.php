<?php

// Problem 1

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $age = trim($_POST['age'] ?? '');
    if(!filter_var($age, FILTER_VALIDATE_INT, $options = ['options' => ['min_range' => 0, 'max_range' => 120]])){
        $errors[] = "Invalid age!! Enter only positive integers.";
    }else{
        if($age >= 18){
            $errors[] = "Welcome!! You are  $age Years old";
        }else{
            $errors[] = "Unfortunately you are under the age. Can't Login.";
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 2

function calculate(float $a, float $b): string{
    $multiply = $a * $b;
    $subtract = $a - $b;
    $mod = $a % $b;
    return "Multiplication: $a * $b = $multiply\nSubtraction: $a - $b = $subtract\nModulus: $a % $b = $mod";
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $n1 = trim($_POST['num1'] ?? '');
    $n2 = trim($_POST['num2'] ?? '');
    if(!filter_var($n1, FILTER_VALIDATE_INT) || !filter_var($n2, FILTER_VALIDATE_INT)){
        $output = "Enter Numbers only";
    }else{
        $output = calculate($n1, $n2);
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 3

function sumArray(array $nums): int {
    return array_sum($nums);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nums = trim($_POST['nums']);
    $array_nums = explode(' ', $nums);
    $sum = sumArray($array_nums);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend Tasks</title>
</head>
<body>
    <h2>Problem 1</h2>
    <form method="POST" action="index.php">
        <input type="text" name="age" placeholder="Enter your age: ">
        <button type="submit">Login</button>
    </form>
    <?php foreach($errors as $e): ?>
        <p> <?= htmlspecialchars($e) ?> </p>
    <?php endforeach; ?>
    
    <hr>

    <h2>Problem 2</h2>
    <form method="POST" action="index.php">
        <input type="text" name="num1" placeholder="Enter Number 1: ">
        <input type="text" name="num2" placeholder="Enter Number 2: ">
        <button type="submit">Calculate</button>
    </form>
    <p><?= nl2br(htmlspecialchars($output ?? '')) ?></p>

    <hr>

    <h2>Problem 3</h2>
    <form method="POST" action="index.php">
        <label for="nums">
            Enter Numbers with space between them: <br>
            <input type="text" name="nums" placeholder="Enter Numbers: ">
        </label>
        <button type="submit">Get the Sum</button>
    </form>
    <p>Summation: <?= htmlspecialchars($sum ?? '')?></p>
</body>
</html>