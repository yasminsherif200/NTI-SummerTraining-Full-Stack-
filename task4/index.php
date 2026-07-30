<?php

// Problem 1

$errors_1 = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $age = trim($_POST['age'] ?? '');
    if(!filter_var($age, FILTER_VALIDATE_INT, $options = ['options' => ['min_range' => 0, 'max_range' => 120]])){
        $errors_1[] = "Invalid age!! Enter only positive integers.";
    }else{
        if($age >= 18){
            $errors_1[] = "Welcome!! You are  $age Years old";
        }else{
            $errors_1[] = "Unfortunately you are under the age. Can't Login.";
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
    $nums = trim($_POST['nums'] ?? '');
    $array_nums = explode(' ', $nums);
    foreach ($array_nums as $n) {
        if (!is_numeric($n)) {
            $errors_2[] = "Please enter numbers only, separated by spaces.";
            break;
        }
    }
    $sum = sumArray($array_nums);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 4

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $words = strtolower(trim($_POST['words'] ?? ''));
    $array_words = explode(' ', $words);
    $key = strtolower(trim($_POST['key'] ?? ''));
    $flag = false;
    foreach($array_words as $w){
        if($w == $key){
            $flag = true;
            break;
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 5

function RouteBubble(array $arr): array{
    $sz = count($arr);
    for($i = 0; $i < $sz - 1; $i++){
        for($j = 0; $j < $sz-$i-1; $j++){
            if($arr[$j] > $arr[$j+1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
        }
    }
    return $arr;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $numbers = trim($_POST['numbers'] ?? '');
    $array_numbers = explode(' ', $numbers);
    foreach ($array_numbers as $n) {
        if (!is_numeric($n)) {
            $errors_3[] = "Please enter numbers only, separated by spaces.";
            break;
        }
    }

    $sorted_array = RouteBubble($array_numbers);
    $sorted = implode(', ', $sorted_array);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 6

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $max = trim($_POST['max'] ?? '');
    $arrayForMax = explode(' ', $max);
    foreach ($arrayForMax as $n) {
        if (!is_numeric($n)) {
            $errors_4[] = "Please enter numbers only, separated by spaces.";
            break;
        }
    }

    $maxNum = max($arrayForMax);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 7

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $sentence = strtolower(trim($_POST['sentence'] ?? ''));
    $array_sentence = explode(' ', $sentence);
    $keyWord = strtolower(trim($_POST['keyWord'] ?? ''));
    $repeat = 0;
    foreach($array_sentence as $s){
        if($s == $keyWord){
            $repeat++;
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 8

function RouteRandomPass($n): string {
    $ranStr = bin2hex(random_bytes($n / 2));
    return "Random String: " . $ranStr . " It's length: " . strlen($ranStr); 
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $random = trim($_POST['random'] ?? '');
    if(is_numeric($random)){
        $randomString = RouteRandomPass($random);
    }else{
        $errors_5[] = "Enter Numbers only";
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 9

echo "<h2> Problem 9</h2>";
echo "<h4> Using for loop</h4>";
$tests = array(1,"tariq",1.5,true,7,'s',false);
for($i = 0; $i < count($tests); $i++){
    if(is_bool($tests[$i])){
        echo $tests[$i] ? "Yes <br>" : "No <br>";
    }else{
        echo $tests[$i] . "<br>";
    }
}

echo "<h4> Using while loop</h4>";
$j = 0;
while ($j < count($tests)) {
    if(is_bool($tests[$j])){
        echo $tests[$j] ? "Yes <br>" : "No <br>";
    }else{
        echo $tests[$j] . "<br>";
    }
    $j++;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 10

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $arr = trim($_POST['arr'] ?? '');
    $arr_numbers = explode(' ', $arr);
    foreach ($arr_numbers as $n) {
        if (!is_numeric($n)) {
            $errors_6[] = "Please enter numbers only, separated by spaces.";
            break;
        }
    }

    sort($arr_numbers);
    $sort_str = implode(' ', $arr_numbers);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 11

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $arr1 = trim($_POST['arr1'] ?? '');
    $arr_1 = explode(' ', $arr1);
    $arr2 = trim($_POST['arr2'] ?? '');
    $arr_2 = explode(' ', $arr2);
    $result = array_intersect($arr_1, $arr_2);
    $common = implode('-', $result);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////

// Problem 12

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $prodPrice = trim($_POST['prodPrice'] ?? '');
    $prodNum =  trim($_POST['prodNum'] ?? '');
    if(!filter_var($prodPrice, FILTER_VALIDATE_INT, $options = ['options' => ['min_range' => 0]]) && !filter_var($prodNum, FILTER_VALIDATE_INT, $options = ['options' => ['min_range' => 0]])){
        $errors_7[] = "Invalid Price!! Enter only positive numbers.";
    }else{
        $totalBeforeDiscount = $prodPrice * $prodNum;
        if($totalBeforeDiscount >= 1000){
            $discount = $totalBeforeDiscount * 0.15;
            $purchase = $totalBeforeDiscount - $discount;
        }else{
            $discount = $totalBeforeDiscount * 0.10;
            $purchase = $totalBeforeDiscount - $discount;
        }
    }
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
    <?php foreach($errors_1 as $e): ?>
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
    <p>
        <?php if(!empty($errors_2)): ?>
            <?php foreach($errors_2 as $err): ?>
                <?= htmlspecialchars($err) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Summation: <?= htmlspecialchars($sum ?? '')?></p>
        <?php endif; ?>
    </p>

    <hr>

    <h2>Problem 4</h2>
    <form method="POST" action="index.php">
        <label for="words">
            Enter words with space between them: <br>
            <input type="text" name="words" placeholder="Enter words: ">
        </label>
        <br>
        <label for="key">
            Enter the word you want to check its presence: <br>
            <input type="text" name="key" placeholder="Enter the keyword: ">
        </label>
        <br> <br>
        <button type="submit">Check</button>
    </form>
    <p>
        <?php if($flag ?? false): ?>
            YES, <?= htmlspecialchars($key) ?> exists
        <?php else: ?>
            NO, <?= htmlspecialchars($key) ?> does not exists
        <?php endif; ?>
    </p>

    <hr>

    <h2>Problem 5</h2>
    <form method="POST" action="index.php">
        <label for="numbers">
            Enter Numbers with space between them: <br>
            <input type="text" name="numbers" placeholder="Enter Numbers: ">
        </label>
        <button type="submit">Sort</button>
    </form>
    <p>
        <?php if(!empty($errors_3)): ?>
            <?php foreach($errors_3 as $err): ?>
                <?= htmlspecialchars($err) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Sorted array: <?= htmlspecialchars($sorted ?? '')?></p>
        <?php endif; ?>
    </p>

    <hr>

    <h2>Problem 6</h2>
    <form method="POST" action="index.php">
        <label for="max">
            Enter Numbers with space between them: <br>
            <input type="text" name="max" placeholder="Enter Numbers: ">
        </label>
        <button type="submit">Get Max</button>
    </form>
    <p>
        <?php if(!empty($errors_4)): ?>
            <?php foreach($errors_4 as $err): ?>
                <?= htmlspecialchars($err) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Max. number is: <?= htmlspecialchars($maxNum ?? '')?></p>
        <?php endif; ?>
    </p>

    <hr>

    <h2>Problem 7</h2>
    <form method="POST" action="index.php">
        <label for="sentence">
            Enter words with space between them: <br>
            <input type="text" name="sentence" placeholder="Enter words: ">
        </label>
        <br>
        <label for="keyWord">
            Enter the word you want to check its presence times: <br>
            <input type="text" name="keyWord" placeholder="Enter the keyword: ">
        </label>
        <br> <br>
        <button type="submit">Check</button>
    </form>
    <p>
        <?php if($flag ?? false): ?>
            YES, <?= htmlspecialchars($keyWord) ?> exists <?= htmlspecialchars($repeat) ?> times
        <?php else: ?>
            NO, <?= htmlspecialchars($keyWord) ?> does not exists
        <?php endif; ?>
    </p>

    <hr>

    <h2>Problem 8</h2>
    <form method="POST" action="index.php">
        <label for="random">
            Enter Number<br>
            <input type="text" name="random" placeholder="Enter Number: ">
        </label>
        <button type="submit">Get Random string</button>
    </form>
    <p>
        <?php if(!empty($errors_5)): ?>
            <?php foreach($errors_5 as $e): ?>
                <?= htmlspecialchars($e) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <?= htmlspecialchars($randomString ?? '') ?>
        <?php endif; ?>
    </p>

    <hr>

    <h2>Problem 10</h2>
    <form method="POST" action="index.php">
        <label for="arr">
            Enter Numbers with space between them: <br>
            <input type="text" name="arr" placeholder="Enter Numbers: ">
        </label>
        <button type="submit">Sort</button>
    </form>
    <p>
        <?php if(!empty($errors_6)): ?>
            <?php foreach($errors_6 as $err): ?>
                <?= htmlspecialchars($err) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Sorted array: <?= htmlspecialchars($sort_str ?? '')?></p>
        <?php endif; ?>
    </p>

    <hr>

    <h2>Problem 11</h2>
    <form method="POST" action="index.php">
        <label for="arr1">
            Enter array with space between elements: <br>
            <input type="text" name="arr1" placeholder="Type: ">
        </label>
        <br>
        <label for="arr2">
        Enter array with space between elements: <br>
            <input type="text" name="arr2" placeholder="Type: ">
        </label>
        <br> <br>
        <button type="submit">Get Common</button>
    </form>        
    <p>Common: <?= htmlspecialchars($common ?? '')?></p>

    <hr>

    <h2>Problem 12</h2>
    <form method="POST" action="index.php">
        <label for="prodPrice">
            Enter Product Price: <br>
            <input type="text" name="prodPrice" placeholder="Type: ">
        </label>
        <br>
        <label for="prodNum">
            Enter Product Number: <br>
            <input type="text" name="prodNum" placeholder="Type: ">
        </label>
        <button type="submit">Purchase</button>
    </form>
    <?php if(!empty($errors_7)): ?>
        <?php foreach($errors_7 as $e): ?>
            <p> <?= htmlspecialchars($e) ?> </p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>
           Price before discount: <?= htmlspecialchars($totalBeforeDiscount) ?> <br>
           Price after discount: <?= htmlspecialchars($purchase) ?>
        </p>
    <?php endif; ?>
</body>
</html>