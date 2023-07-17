<?php include 'base.php' ?>

<?php startblock('title') ?>
Instructions
<?php endblock() ?>

<?php startblock('body') ?>
<body
    class="min-h-screen bg-gradient-to-b from-blue-200 to-white"
    style="font-family: lato"
  >
    <div class="container mx-auto mt-8 pb-96">
      <div class=" w-11/12 mx-auto shadow-bottom">
        <h1
          class="text-3xl md:text-5xl font-bold my-14 text-blue-900 p-5 border-b-2 border-green-700"
        >
          AutoProctor WordPress Plugin Guide
        </h1>
        <p
          class="text-blue-900 mb-4 font-bold text-lg md:text-2xl tracking-wide"
        >
          Hello there, this page will show you instructions on how to test
          AutoProctor's installation on
          your WordPress</span> site.
          It will also give you instructions on how you can integrate it with
          your testing/quizzing solution.
        </p>
        <p class="text-blue-900 mb-4 text-base md:text-xl ">
          If you have just installed the plugin, we <strong>highly recommend</strong> you finish these Sections one-by-one.
        </p>
      </div>

      <div
        class=" w-11/12 mx-auto  "
      >
        <h1 class="text-2xl md:text-4xl font-bold mt-14 mb-6 text-blue-900">
          1. Demo Tests
        </h1>
        <p class="text-blue-900 mb-4 text-base md:text-xl ">
          Below, you see two cards. Each card refers to a separate test. These
          tests are dummy tests we have created and are part of the plugin. They
          are here only so that you can see how
          AutoProctor works. You
          shouldn't use these tests for your end users.
        </p>
        <p class="text-blue-900 mb-4 text-base md:text-xl ">
          Within each test, you see two buttons. If you click on the Start Test
          button, another tab will open where you will see three buttons to
          manage proctoring. Once you start proctoring, you must follow the
          AutoProctor instructions. After
          AutoProctor has been successfully
          started, the Google Form Quiz is loaded as an IFrame.
        </p>
        <p class="text-blue-900 mb-4 text-base md:text-xl ">
          You can then click on End Proctoring and you will then see a link to
          the Proctoring Report for that attempt. You can try the tests a few
          times and can click on the View Report button to see the results of
          all attempts
        </p>
      </div>

      <div class=" w-11/12 mx-auto p-5 md:p-20 my-14 bg-blue-900 rounded-2xl shadow-xl">
        <div class="flex flex-col md:flex-row justify-around">
          <div
            class="bg-white transition-all rounded-lg p-5 mb-5"
          >
            <h6 class="text-3xl font-bold text-green-700 mb-5">Test 1</h6>
            <p class="text-blue-900 text-2xl">
              Proctoring without auxiliary device
            </p>
            <div class="flex flex-col md:flex-row items-center mb-3  mt-5 justify-center md:justify-around">
              <a
                target="_blank"
                href="<?php echo home_url(); ?>/ap/dummy-tests/1/<?php echo $testAttemptId; ?>/"
                class="bg-green-600 rounded-full transition-all mb-3 md:mb-0 text-white text-xs md:text-sm lg:text-base font-normal py-2 px-4 rounded uppercase tracking-wide"
                >Start Test</a
              >
              <a
                target="_blank"
                href="<?php echo home_url(); ?>/ap/results/1/"
                class="bg-none border-2 border-green-600 rounded-full transition-all text-green-600 text-xs md:text-sm lg:text-base font-normal md:ml-3 py-2 px-4 rounded uppercase tracking-wide"
                >View Attempts</a
              >
            </div>
          </div>
          <div
            class="bg-white transition-all rounded-lg p-5"
          >
            <h6 class="text-3xl font-bold text-green-700 mb-5">Test 2</h6>
            <p class="text-blue-900 text-2xl">
              Proctoring with auxiliary device
            </p>
            <div class="flex flex-col md:flex-row items-center mb-3  mt-5 justify-center md:justify-around">
              <a
                target="_blank"
                href="<?php echo home_url(); ?>/ap/dummy-tests/2/<?php echo $testAttemptId; ?>/"
                class="bg-green-600 rounded-full transition-all mb-3 md:mb-0 text-white text-xs md:text-sm lg:text-base font-normal py-2 px-4 rounded uppercase tracking-wide"
                >Start Test</a
              >
              <a
                target="_blank"
                href="<?php echo home_url(); ?>/ap/results/2/"
                class="bg-none border-2 border-green-600 rounded-full transition-all text-green-600 text-xs md:text-sm lg:text-base font-normal md:ml-3 py-2 px-4 rounded uppercase tracking-wide"
                >View Attempts</a
              >
            </div>
          </div>
        </div>
      </div>

      <div
        class=" w-11/12 mx-auto shadow-bottom mt-24 "
      >
        <h1 class="text-2xl md:text-4xl font-bold  mb-6 text-blue-900">
          2. How The Plugin Works
        </h1>
        <ol class="text-blue-900 list-decimal">
          <p class="text-blue-900 mb-4 text-base md:text-xl ">
            In this plugin, AutoProctor is
            integrated as a JavaScript SDK. The SDK can:
          </p>
          <li class="ml-10 text-lg">Start a new test attempt</li>
          <li class="ml-10 text-lg">Resume an existing test attempt</li>
          <li class="ml-10 text-lg">Load the results of a test attempt</li>
        </ol>

        <div class="my-10"
        >
          <h1 class="text-xl md:text-3xl font-bold mt-4 mb-6 text-blue-900">
            2.1 Starting a Test
          </h1>
          <ol class="text-blue-900 list-decimal mt-10">
            <p class="text-blue-900 mb-4 text-sm md:text-lg ">
              If you click on the "Start Test" button, the URL that gets loaded is
              of the form
              <code
                >"/ap/dummy-tests/&lt;test_id&gt;/&lt;test_attempt_id&gt;"</code
              >. Here:
            </p>
            <li class="ml-10 text-lg">
              <code class=" "
                >test_id</code
              >
              is either 1 or 2, which refers to Test 1 or Test 2
            </li>
            <li class="ml-10 text-lg">
              <code class=" "
                >test_attempt_id</code
              >
              is a unique string that identifies a single user's attempt
              for a given test. For example, if a user attempts the same test 3
              times, there will be three different
              <code class=" "
                >test_attempt_id</code
              >
            </li>
          </ol>

          <ol class="text-blue-900 list-decimal mt-10">
            <p class="text-blue-900 my-4 text-base md:text-xl ">
              If you look at the source code in
              <code
                >autoproctor.php</code
              >, you will see that we are generating a random string with
              <code class=" "
                >generateRandomString()</code
              >
              function, whose value is used for the
              <code class=" "
                >test_attempt_id</code
              >. When an actual test attempt URL is loaded:
            </p>
            <li class="ml-10 text-lg my-1">
              We load the test as an IFrame but we don't set the URL of the
              IFrame
            </li>
            <li class="ml-10 text-lg my-1">
              On the Start Proctoring button being clicked, the AutoProctor SDK
              is initialized with the
              <code class=" "
                >.init</code
              >
              method
            </li>
            <li class="ml-10 text-lg my-1">
              You can see that many parameters are passed as arguments to this
              method. They fall into three categories:
              <ol
                class="list-disc leading-[3rem] bg-white my-4 py-5 md:px-5 rounded-lg shadow"
              >
                <li class="ml-10 text-lg leading-[2rem]">
                  <span class="text-lg font-bold underline"
                    >Value identifying, the attempt</span
                  >
                  -
                  <code class=" "
                    >testAttemptId</code
                  >
                  . <a class="text-green-700 underline" href="<?php echo home_url(); ?>/ap-docs/#init-params">Click here</a> to see what these parameters are
                  and what they mean
                </li>
                <li class="ml-10 text-lg leading-[2rem]">
                  <span class="text-lg font-bold underline"
                    >Authentication information</span
                  >
                  -
                  <code class=" "
                    >hashedTestAttemptId</code
                  >,
                  <code class=" "
                    >tenantId</code
                  >. <a class="text-green-700 underline" href="<?php echo home_url(); ?>/ap-docs/#init-params">Click here</a> to understand why this is needed
                  and how to calculate it
                </li>
                <li class="ml-10 text-lg leading-[2rem]">
                  <span class="text-lg font-bold underline"
                    >AutoProctor Settings</span
                  >
                  - camera, audio, screen etc.. <a class="text-green-700 underline" href="<?php echo home_url(); ?>/ap-docs/#ap-settings">Click here</a> to understand what
                  these settings mean
                </li>
              </ol>
            </li>
            <li class="ml-10 text-lg leading-[2rem]">
              Once AutoProctor is ready, it emits an event
              <code class=" "
                >apStartTest</code
              >
            </li>
            <li class="ml-10 text-lg leading-[2rem]">
              We listen to this event and then load the test by setting the src
              of the IFrame. AutoProctor may take a few seconds to set up,
              especially if it is the first time. This is why the test must be
              loaded after AutoProctor is ready
            </li>
            <li class="ml-10 text-lg leading-[2rem]">
              AutoProctor continues to run in the background and when you click
              on End Proctoring,<code class=" "
                >.stop</code
              >
              method is called which emits
              <code class=" "
                >apStopMonitoring</code
              >
              event and makes a request to the AutoProctor server to mark the
              attempt as finished and calculate the Trust Score.
            </li>
            <li class="ml-10 text-lg leading-[2rem]">
              You should use this
              <code class=" "
                >apStopMonitoring</code
              >
              to submit the actual test rather than providing users with a
              dedicated button to submit a test. Because if you provide the
              users a way to submit their test without ending the proctoring,
              they might submit the test and not click End Proctoring ever. In
              such case the SDK will keep monitoring and will keep taking record
              of the evidence of any violations as it doesn't know the test
              has ended and
              <code class=" "
                >apStopMonitoring</code
              >
              event was never emitted
            </li>
          </ol>
        </div>

        <div class="my-10"
        >
          <h1 class="text-xl md:text-3xl font-bold mt-4 mb-6 text-blue-900">
            2.2 Loading the results of a Test
          </h1>
          <p
            class="text-blue-900 mb-4 text-base md:text-lg  md:leading-[4rem]"
          >
            If you click on VIEW ATTEMPTS you will be
            taken to the URL
            <code
              >“ap/results/&lt;test_id&gt;”</code
            >
            , where
            <code
              >test_id</code
            >
            corresponds to 1 for Test 1 and 2 for Test 2. This page will show
            you all the attempts for the corresponding test along with
            <code
              >start_time</code
            >,
            <code
              >finish_time</code
            >
            along and their unique
            <code
              >test_label</code
            >.
          </p>
          <p
            class="text-blue-900 mb-4 text-base md:text-lg  md:leading-[4rem]"
          >
            An important thing to note here is that only
            <code
              >test_attempt_label</code
            >
            of these tests are stored in AutoProctor database and the
            information about which
            <code
              >test_attempt_id</code
            >
            maps to which
            <code
              >test_id</code
            >
            is not passed on to the AutoProctor database but is stored in local
            database only. Therefore if you look at
            <code
              >getAllAttemptsDataByTestId()</code
            >method inside
            <code
              >autoproctor.php</code
            >, all these results are first queried from local database based on
            the
            <code
              >test_id</code
            >
            that they belong to and then the proctoring results for all the
            filtered test attempts are fetched from AutoProctor database.
          </p>

          <ol
            class="text-blue-900 list-disc leading-[3rem] bg-white my-4 p-5 rounded-lg shadow"
          >
            <p class="text-blue-900 mb-4 text-base md:text-xl ">
              When you visit the page you will see all the test attempts for
              that specific test in a tabulated form. The table has following
              columns:
            </p>
            <li class="ml-10 text-lg my-3">
              <span class="text-green-700 mr-1">LABEL-</span>
              It is a unique label for each test attempt
            </li>
            <li class="ml-10 text-lg my-3">
              <span class="text-green-700 mr-1">STARTED_AT-</span>
              Specifies Date and Time when test attempt was started
            </li>
            <li class="ml-10 text-lg my-3">
              <span class="text-green-700 mr-1">FINISHED_AT-</span>
              Specifies Date and Time when test attempt was finished. This field
              will be empty if the attempt was not submitted
            </li>
            <li class="ml-10 text-lg my-3">
              <span class="text-green-700 mr-1">TEST COMPLETED-</span>
              It says either YES or NO based on the whether or not the user
              completed the test
            </li>
            <li class="ml-10 text-lg my-3">
              <span class="text-green-700 mr-1">TRUST SCORE-</span>
              This column will display the trust score of a candidate in for
              each attempt in percentage. Trust score will be based upon the
              evidence collected while the session was in progress
            </li>
            <li class="ml-10 text-lg my-3">
              <span class="text-green-700 mr-1">REPORT-</span>
              The links to each
              <code
                >test_attempt_report</code
              >
              are listed in this column. Clicking on the listed link will load
              the report of that
              <code
                >test_attempt</code
              >test_attempt
            </li>
          </ol>
        </div>

        <div class="my-10"
        >
          <h1 class="text-xl md:text-3xl font-bold mt-4 mb-6 text-blue-900">
            2.3 Loading the Report of a Test Attempt
          </h1>
          <p
            class="text-blue-900 mb-4 text-base md:text-lg  md:leading-[4rem]"
          >
            All the test attempt reports are available at the URL of the form
            <code
              >“ap/report/&lt;test_attempt_id&gt;/?hashed_test_attempt_id=&lt;hashedTestAttemptId&gt;”</code
            >.
            <code
              >test_attempt_id</code
            >
            has already been explained.
            <code
              >hashedTestAttemptId</code
            >
            is generated using
            <code
              >getHashedTestAttemptId</code
            >
            method inside
            <code
              >autoproctor.php</code
            >. This method takes the
            <code
              >testAttemptId</code
            >
            as argument and generates a SHA-256 HMAC of the
            <code
              >testAttemptId</code
            >
            with your
            <code
              >CLIENT_SECRET</code
            >.
          </p>

          <ol class="text-blue-900 list-decimal">
            <p
              class="text-blue-900 mb-1 text-base md:text-lg  md:leading-[4rem]"
            >
              There are two ways you can end up at this URL:
            </p>
            <li class="ml-5">
              By clicking the
              <span class="text-green-700">'view report'</span> link from the
              results page
            </li>
            <li class="ml-5">
              By clicking the
              <span class="text-green-700">'view report'</span> link provided
              when the test is finished
            </li>
          </ol>

          <p
            class="text-blue-900 mb-1 text-xl md:text-xl mt-10  font-bold md:leading-[4rem]"
          >
            When you visit a particular report, you will see the following two
            sections there:
          </p>
          <ol
            class="text-blue-900 flex flex-col md:flex-row justify-around mt-5 "
          >
            <li
              class="ml-5 text-white p-5 rounded shadow-xl md:px-20 text-center bg-green-700 text-xl font-bold mb-4 md:mb-0"
            >
              1. &nbsp; Report Overview
            </li>
            <li
              class="ml-5 text-white p-5 rounded shadow-xl md:px-20 text-center bg-green-700 text-xl font-bold"
            >
              2. &nbsp; Proctor Summary
            </li>
          </ol>

          <div class="text-blue-900 list-decimal mt-12">
            <p
              class="text-blue-900 mb-1 text-base md:text-lg  md:leading-[4rem]"
            >
              These sections are populated in a
              <code
                >renderProctoringSummary</code
              >
              function whenever the page loads. You can see the function being
              called in the script inside
              <code
                >report.php</code
              >. This function takes a javascript object as argument. This
              object has various properties which are explained below:
            </p>

            <ol
              class="text-blue-900 list-disc leading-[3rem] bg-white my-4 p-5 rounded-lg shadow"
            >
              <li class="ml-10 text-base my-3">
                <code class="text-green-700 mr-1">renderOverview-</code>
                This key takes a boolean value implying whether or not you want
                to display the Report Overview section in your UI
              </li>
              <li class="ml-10 text-base my-3">
                <code class="text-green-700 mr-1">proctorOverviewCtrId-</code>
                This key expects a string value. The value of this property is
                the id of the
                <code>html</code> container inside which you want to render the
                Report Overview
              </li>
              <li class="ml-10 text-base my-3">
                <code class="text-green-700 mr-1">renderSummaryTable-</code>
                This key also takes a boolean value implying whether or not you
                want to display the Proctor Summary section in your UI
              </li>
              <li class="ml-10 text-base my-3">
                <code class="text-green-700 mr-1">proctorOverviewCtrId-</code>
                This key expects a string value. The value of this key is the id
                of the <code>html</code>
                container inside which you want to render the Proctor Summary
              </li>
              <li class="ml-10 text-base my-3">
                <code class="text-green-700 mr-1">userDetails-</code>
                This key maps to a javascript object containing the details of
                the user. In our demo test we have hard-coded the fields of this
                object, you can populate the fields according to your preference
              </li>
            </ol>
          </div>
        </div>

        <div class="my-10"
        >
          <h1 class="text-xl md:text-3xl font-bold mt-4 mb-6 text-blue-900">
            2.4 Resuming a Test Attempt
          </h1>
          <p
            class="text-blue-900 mb-4 text-base md:text-lg  md:leading-[4rem]"
          >
            Occasionally, users may accidentally close the test tab or window,
            or they may refresh the page. In such situations, the AutoProctor
            test can be resumed as long as the
            <code
              >test_attempt_id</code
            >
            in the URL remains the same. Users can locate the URL on their
            auxiliary devices and utilize it to resume the test, ensuring that
            all previously recorded evidence is preserved.
          </p>

          <p
            class="text-blue-900 mb-4 text-base md:text-lg  md:leading-[4rem]"
          >
            However, if the user has already concluded the test, submitted the
            evidence, and generated a trust score, resuming the test is not
            possible. If users attempt to do so, they will receive a prompt
            informing them that the test with the specified
            <code
              >test_attempt_id</code
            >
            has already been completed and cannot be resumed.
          </p>
        </div>
      </div>

      <div
        class=" w-11/12 mx-auto shadow-bottom mt-24 "
      >
        <h1 class="text-2xl md:text-4xl font-bold mb-6 text-blue-900">
          3. How To Integrate With Your Quizzing Solution
        </h1>

        <ol class="text-blue-900 list-decimal">
          <p class="text-blue-900 mb-4 text-base md:text-xl ">
            The Section above explained how AutoProctor worked with our dummy
            tests. Getting it to work with your quizzing solution is fairly
            straightforward (in principle, at least!). Let's say your tests
            are being loaded on a route like /tests. You will need to:
          </p>
          <li class="ml-10 text-lg">
            Call the
            <code
              >.init()</code
            >
            method with the right set of parameters as mentioned above. The most
            important parameters are the
            <code
              >testAttemptId</code
            >,
            <code
              >tenantId</code
            >
            and
            <code
              >hashedTestAttemptId</code
            >
          </li>
          <li class="ml-10 text-lg">
            Listen to the event that confirms AutoProctor has successfully
            started
          </li>
          <li class="ml-10 text-lg">Load Your Test</li>
          <li class="ml-10 text-lg">
            When the test taker finishes the test, call the
            <code
              >autoProctorTest.stop()</code
            >method. You can trigger this by having an explicit Stop Proctoring
            button in your UI, or by somehow knowing that the user has finished
            the test.
          </li>
          <li class="ml-10 text-lg">
            To load the results of a test attempt, initialize the AutoProctor
            SDK with the relevant parameters
          </li>
        </ol>
      </div>
    </div>
  </body>
<?php endblock() ?>