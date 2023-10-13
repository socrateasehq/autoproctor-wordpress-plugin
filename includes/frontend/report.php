<?php include 'base.php' ?>

<?php
$hashedTestAttemptId = get_query_var('hashed_test_attempt_id');
?>

<?php startblock('title') ?>
Test Report
<?php endblock() ?>

<?php startblock('head') ?>
<?php superblock() ?>
<link rel="stylesheet" href="https://ap-development.s3.amazonaws.com/autoproctor.3.0.1.min.css?v=7" />
<script defer src="https://ap-development.s3.amazonaws.com/autoproctor.3.0.1.min.js?v=7"></script>
<?php endblock() ?>

<?php startblock('body') ?>

  <body class="min-h-screen bg-gradient-to-b from-blue-200 to-white" style="font-family: lato">
      <div class="container mx-auto mt-8 max-w-5xl mx-auto">
          <h1 class="text-3xl font-bold mb-4">Test Attempts Report <?php echo $attemptLabel; ?> </h1>
          <div id="ap-report__overview"
              class="max-w-5xl mx-auto bg-gradient-to-r from-green-100/50 to-slate-100 p-10 px-20 rounded-2xl shadow-2xl my-20">
              <h1 class="text-2xl md:text-4xl text-center mb-14">
                  Report Overview
              </h1>
          </div>
          <div id="ap-report__proctor"
              class="max-w-5xl mx-auto bg-gradient-to-l from-green-100/50 to-slate-100 p-10 px-20 rounded-2xl shadow-2xl my-20">
              <h1 class="text-2xl md:text-4xl text-center mb-14">
                  Proctor Summary
              </h1>
          </div>
      </div>
      </div>

  </body>

  <script>
  window.addEventListener('load', async function() {
    const credentials = {
        clientId: '<?php echo $clientId; ?>',
        testAttemptId: '<?php echo $attemptLabel; ?>',
        hashedTestAttemptId: '<?php echo $hashedTestAttemptId; ?>',
        domain: "<?php echo $domain; ?>"
    };


      try {
        const apInst = new AutoProctor(credentials);
        apInst.showReport({
            showProctoringOverview: true,
            showProctoringSummary: true,
			showDownloadReportBtn: true,
            proctoringSummaryDOMId: "ap-report__proctor",
            proctoringOverviewDOMId: "ap-report__overview",
            groupReportsIntoTabs: false,
            insertTestReportTab: false,
            userDetails: {
                name: "First Last",
                email: "user@gmail.co",
            },
          });
      } catch (err) {
          console.log(err);
      }
  });
  </script>
<?php endblock() ?>