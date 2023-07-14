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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&display=swap" rel="stylesheet">
    <title>Instructions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-blue-100" style="font-family: lato" >
    <div class="container mx-auto mt-8">
        <div class="w-11/12 mx-auto shadow-bottom">
            <h1 class="text-3xl md:text-5xl font-bold mb-8 text-blue-900">AutoProctor WordPress Plugin Guide</h1>
            <p class="text-blue-900 mb-4 font-bold text-lg md:text-2xl"> Following is the list of <span class="text-green-600">available tests</span> that you can take. You can <span class="text-green-600">start</span> each test independently and also <span class="text-green-600">view the previous attempts</span> of the test. </p>
            <ol class="text-blue-900 mb-14 ">
                <li><p>
                    Click on the <code class="uppercase text-green-600 font-bold">"start test"</code> button to start a new instance of that test in a new tab
                </p></li>
                <li><p>
                    Click on the <code class="uppercase text-green-600 font-bold">"view attempts"</code> button to open the previous attempts of the test in a new tab
                </p></li>
            </ol>
        </div>

        <ul>
            <li class="m-3 md:m-0 md:mb-4 p-8 bg-blue-900 text-white rounded-xl shadow-lg flex flex-col md:flex-row items-center justify-between">
                <div class="w-full md:w-2/3 mb-5 md:mb-0">
                    <h2 class="text-2xl tracking-widest uppercase font-bold mb-2">Test 1</h2>
                    <p class="font-light">This is a brief description of test</p>
                </div>
                <div class="flex flex-row w-full md:w-1/3 justify-end">
                    <a target="_blank" href="<?php echo home_url(); ?>/ap/tests/1/<?php echo $testAttemtId; ?>/" class="bg-green-600 rounded-full hover:scale-95 transition-all text-white text-xs md:text-sm lg:text-base font-normal py-2 px-4 rounded mr-2 uppercase tracking-wide">Start Test</a>
                    <a target="_blank" href="<?php echo home_url(); ?>/ap/results/1/" class="bg-none border-2 border-green-600 rounded-full hover:scale-95 transition-all text-green-600 text-xs md:text-sm lg:text-base font-normal ml-3 py-2 px-4 rounded uppercase tracking-wide">View Attempts</a>
                </div>
            </li>

            <li class="m-3 md:m-0 md:mb-4 p-8 bg-blue-900 text-white rounded-xl shadow-lg flex flex-col md:flex-row items-center justify-between">
                <div class="w-full md:w-2/3 mb-5 md:mb-0">
                    <h2 class="text-2xl tracking-widest uppercase font-bold mb-2">Test 2</h2>
                    <p class="font-light">This is a long description of test. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, ut vitae distinctio natus tenetur quisquam rerum similique itaque aperiam error placeat quam reprehenderit nam quis ipsa corrupti. Repudiandae, illo pariatur.</p>
                </div>
                <div class="flex flex-row w-full md:w-1/3 justify-end">
                    <a target="_blank" href="<?php echo home_url(); ?>/ap/tests/2/<?php echo $testAttemtId; ?>/" class="bg-green-600 rounded-full hover:scale-95 transition-all text-white text-xs md:text-sm lg:text-base font-normal py-2 px-4 rounded mr-2 uppercase tracking-wide">Start Test</a>
                    <a target="_blank" href="<?php echo home_url(); ?>/ap/results/2/" class="bg-none border-2 border-green-600 rounded-full hover:scale-95 transition-all text-green-600 text-xs md:text-sm lg:text-base font-normal ml-3 py-2 px-4 rounded uppercase tracking-wide">View Attempts</a>
                </div>
            </li>
        </ul>
    </div>
</body>
</html>
