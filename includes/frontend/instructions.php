<?php include 'base.php' ?>

<?php startblock('title') ?>
Instructions
<?php endblock() ?>

<?php startblock('body') ?>

<body class="min-h-screen bg-gradient-to-b from-blue-200 to-white" style="font-family: lato">
    <div class="container mx-auto mt-8 pb-96">
        <div class="w-11/12 mx-auto shadow-bottom">
            <h1 class="text-3xl md:text-5xl font-bold my-14 text-blue-900 p-5 border-b-2 border-green-700">
                <span class="text-green-700">AutoProctor</span> WordPress Plugin Guide
            </h1>
            <p class="text-blue-900 mb-4 font-bold text-lg md:text-2xl tracking-wide">
                Hello there, this page will show you instructions on how to test
                <span class="text-green-700">AutoProctor&apos;s</span> installation on
                your <span class="text-green-700 tracking-wide">WordPress</span> site.
                It will also give you instructions on how you can integrate it with
                your testing/quizzing solution.
            </p>
            <p class="text-blue-900 mb-4 text-base md:text-xl text-justify">
                If you have just installed the plugin, we recommend you take a couple
                of demo tests to see if
                <span class="text-green-700 tracking-wide">AutoProctor</span> is
                working properly. You can then read an explainer of how we have got
                those tests to work. Finally, you can read developer documentation on
                how you can integrate it with your quizzing solution.
            </p>
        </div>

        <div class="w-11/12 mx-auto shadow-bottom">
            <h1 class="text-2xl md:text-4xl font-bold mt-14 mb-6 text-blue-900">
                1. Demo Tests
            </h1>
            <p class="text-blue-900 mb-4 text-base md:text-xl text-justify">
                Below, you see two cards. Each card refers to a separate test. These
                tests are dummy tests we have created and are part of the plugin. They
                are here only so that you can see how <span class="text-green-700">AutoProctor</span> works. You
                shouldn&apos;t
                use these tests for your end users.
            </p>
            <p class="text-blue-900 mb-4 text-base md:text-xl text-justify">
                Within each test, you see two buttons. If you click on the Start Test
                button, another tab will open where you will see three buttons to
                manage proctoring. Once you start proctoring, you must follow the
                <span class="text-green-700">AutoProctor</span> instructions. After <span
                    class="text-green-700">AutoProctor</span> has been successfully
                started, the Google Form Quiz is loaded as an IFrame.
            </p>
            <p class="text-blue-900 mb-4 text-base md:text-xl text-justify">
                You can then click on End Proctoring and you will then see a link to
                the Proctoring Report for that attempt. You can try the tests a few
                times and can click on the View Report button to see the results of
                all attempts
            </p>
        </div>

        <div class="p-20 my-14 bg-blue-900 rounded-2xl shadow-xl">
            <div class="flex flex-col md:flex-row justify-around">
                <div class="bg-white hover:shadow-[0_1px_40px_-5px_white] transition-all rounded-lg p-10">
                    <h6 class="text-3xl font-bold text-green-700 mb-5">Test 1</h6>
                    <p class="text-blue-900 text-2xl">
                        Proctoring with auxiliary device
                    </p>
                    <div class="flex flex-row w-full mt-10 justify-around">
                        <a target="_blank" href="<?php echo home_url(); ?>/ap/tests/1/<?php echo $testAttemptId; ?>/"
                            class="bg-green-600 rounded-full hover:scale-95 transition-all text-white text-xs md:text-sm lg:text-base font-normal py-2 px-4 rounded uppercase tracking-wide">Start
                            Test</a>
                        <a target="_blank" href="<?php echo home_url(); ?>/ap/results/1/"
                            class="bg-none border-2 border-green-600 rounded-full hover:scale-95 transition-all text-green-600 text-xs md:text-sm lg:text-base font-normal ml-3 py-2 px-4 rounded uppercase tracking-wide">View
                            Attempts</a>
                    </div>
                </div>
                <div class="bg-white hover:shadow-[0_1px_40px_-5px_white] transition-all rounded-lg p-10">
                    <h6 class="text-3xl font-bold text-green-700 mb-5">Test 2</h6>
                    <p class="text-blue-900 text-2xl">
                        Proctoring without auxiliary device
                    </p>
                    <div class="flex flex-row w-full mt-10 justify-around">
                        <a target="_blank" href="<?php echo home_url(); ?>/ap/tests/1/<?php echo $testAttemptId; ?>/"
                            class="bg-green-600 rounded-full hover:scale-95 transition-all text-white text-xs md:text-sm lg:text-base font-normal py-2 px-4 rounded uppercase tracking-wide">Start
                            Test</a>
                        <a target="_blank" href="<?php echo home_url(); ?>/ap/results/1/"
                            class="bg-none border-2 border-green-600 rounded-full hover:scale-95 transition-all text-green-600 text-xs md:text-sm lg:text-base font-normal ml-3 py-2 px-4 rounded uppercase tracking-wide">View
                            Attempts</a>
                    </div>
                </div>
            </div>
            <h1 class="text-2xl md:text-4xl font-bold mt-14 text-white text-center">
                You should start with the first test
            </h1>
        </div>

        <div class="w-11/12 mx-auto shadow-bottom mt-24 border-t-2">
            <h1 class="text-2xl md:text-4xl font-bold mt-14 mb-6 text-blue-900">
                2. How The Plugin Works
            </h1>
            <ol class="text-blue-900 list-decimal">
                <p class="text-blue-900 mb-4 text-base md:text-xl text-justify">
                    In this plugin, <span class="text-green-700">AutoProctor</span> is
                    integrated as a JavaScript SDK. The SDK can:
                </p>
                <li class="ml-10 text-lg">Start a new test attempt</li>
                <li class="ml-10 text-lg">Resume an existing test attempt</li>
                <li class="ml-10 text-lg">Load the results of a test attempt</li>
            </ol>

            <div class="w-4/5 mx-auto p-10 my-5 rounded-2xl shadow bg-gradient-to-t from-blue-200 to-slate-100">
                <h1 class="text-xl md:text-3xl font-bold mt-4 mb-6 text-blue-900">
                    2.1 Starting a Test
                </h1>
                <ol class="text-blue-900 list-decimal mt-10">
                    <p class="text-blue-900 mb-4 text-base md:text-xl text-justify">
                        If you click on the Start Test button, the URL that gets loaded is
                        of the form
                        <span
                            class="text-green-700 mr-1 p-1 px-3 rounded bg-slate-200">"/ap/dummy-tests/&lt;test_id&gt;/&lt;test_attempt_id&gt;"</span>.
                        Here:
                    </p>
                    <li class="ml-10 text-lg">
                        <code
                            class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200 leading-[2.5rem]">test_id</code>
                        is either 1 or 2, which refers to Test 1 or Test 2
                    </li>
                    <li class="ml-10 text-lg">
                        <code
                            class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200 leading-[2.5rem]">test_attempt_id</code>
                        is a unique string that identifies a single user&apos;s attempt for a
                        given test. For example, if a user attempts the same test 3 times,
                        there will be three different
                        <code class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200">test_attempt_id</code>
                    </li>
                </ol>

                <ol class="text-blue-900 list-decimal mt-10">
                    <p class="text-blue-900 my-4 text-base md:text-xl text-justify">
                        If you look at the source code in
                        <span
                            class="text-green-700 mr-1 p-1 px-3 rounded bg-slate-200 my-1">autoproctor.php</span>,
                        you will see that we are generating a random
                        string with <code
                            class="text-green-700 mr-1 p-1 text-base rounded bg-slate-200 my-1">generateRandomString()</code>
                        function,
                        whose value is used for the
                        <code
                            class="text-green-700 mr-1 p-1 px-3 text-base rounded bg-slate-200 my-1">test_attempt_id</code>.
                        When an actual test attempt URL is loaded:
                    </p>
                    <li class="ml-10 text-lg my-1">
                        We load the test as an IFrame but we don&apos;t set the URL of the IFrame
                    </li>
                    <li class="ml-10 text-lg my-1">
                        On the Start Proctoring button being clicked, the AutoProctor SDK is initialized with the <code
                            class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200">.init</code> method
                    </li>
                    <li class="ml-10 text-lg my-1">
                        You can see that many parameters are passed as arguments to this method. They fall into three
                        categories:
                        <ol class=" list-disc leading-[3rem] bg-white my-4 p-5 rounded-lg shadow">
                            <li class="ml-10 text-lg leading-[2rem]"><em class="text-lg font-bold underline">Values
                                    identifying the user, the attempt, the
                                    session</em> - <code
                                    class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200">testAttemptId</code>,
                                <code
                                    class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200">first_name</code>,
                                reload. <a href="">Click here</a> to see what these parameters are and what they mean
                            </li>
                            <li class="ml-10 text-lg leading-[2rem]"><em
                                    class="text-lg font-bold underline">Authentication information</em> - <code
                                    class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200">hashedTestAttemptId</code>.
                                <a href="">Click here</a> to understand why this is needed and how to calculate it
                            </li>
                            <li class="ml-10 text-lg leading-[2rem]"><em class="text-lg font-bold underline">AutoProctor
                                    Settings</em> - camera, audio. Click
                                here to understand what these settings mean</li>
                        </ol>
                    </li>
                    <li class="ml-10 text-lg leading-[2.5rem]">
                        Once AutoProctor is ready, it emits an event <code
                            class="text-green-700 text-base mr-1 p-1 px-3 rounded bg-slate-200">apStartTest</code>
                    </li>
                    <li class="ml-10 text-lg leading-[2.5rem]">
                        We listen to this event and then load the test by setting the src of the IFrame. AutoProctor may
                        take a few seconds to set up, especially if it is the first time. This is why the test must be
                        loaded after AutoProctor is ready
                    </li>
                    <li class="ml-10 text-lg leading-[2.5rem]">
                        AutoProctor continues to run in the background and when you click on Stop Proctoring, it makes a
                        request to the AutoProctor server to mark the attempt as finished and calculate the Trust Score
                    </li>
                </ol>
            </div>

        </div>
    </div>
</body>
<?php endblock() ?>