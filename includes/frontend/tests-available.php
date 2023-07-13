<?php
function generateRandomString($length = 10)
{
 $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $charactersLength = strlen($characters);
 $randomString     = '';
 for ($i = 0; $i < $length; $i++) {
  $randomString .= $characters[random_int(0, $charactersLength - 1)];
 }
 return $randomString;
}

$testAttemtId = generateRandomString();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests Available</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Tests Available</h1>
        <div class="mb-4">
            <h2 class="text-xl font-bold mb-2">Test 1</h2>
            <div class="flex">
                <a target="_blank" href="<?php echo home_url(); ?>/start-test/1/<?php echo $testAttemtId; ?>/" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">Start Test 1</a>
                <a target="_blank" href="<?php echo home_url(); ?>/test-attempts/1/" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded">View Attempts of Test 1</a>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold mb-2">Test 2</h2>
            <div class="flex">
                <a target="_blank" href="<?php echo home_url(); ?>/start-test/2/<?php echo $testAttemtId; ?>/" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">Start Test 2</a>
                <a target="_blank" href="<?php echo home_url(); ?>/test-attempts/2/" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded">View Attempts of Test 2</a>
            </div>
        </div>
    </div>
</body>
</html>
