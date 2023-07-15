<?php include 'base.php' ?>

<?php
  $hashedTestAttemptId  = get_query_var('hashed_test_attempt_id');
?>

<?php startblock('title') ?>
Test Attempts
<?php endblock() ?>

<?php startblock('head') ?>
  <?php superblock() ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://ap-development.s3.amazonaws.com/autoproctor.2.7.8.min.css" />
  <script defer src="https://ap-development.s3.amazonaws.com/autoproctor.2.7.8.min.js"></script>
<?php endblock() ?>

<?php startblock('body') ?>

<body>
    <div class="container mx-auto mt-8 max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">Test Attempts Report <?php echo $attemptLabel; ?> </h1>
        <div id="ap-test-report-overview" class="max-w-5xl mx-auto"></div>
        <div id="ap-proctor-summary" class="p-4"></div>
    </div>
    </div>

</body>

<script>
  window.addEventListener('load', async function() {
      const apReportSettings = {
          tenantId: '<?php echo $clientId; ?>',
          testAttemptId: '<?php echo $attemptLabel; ?>',
          hashedTestAttemptId: '<?php echo $hashedTestAttemptId; ?>',
          domain: "<?php echo $domain; ?>"
      };
      try {
          autoProctorTest = await initAutoProctorReport(apReportSettings);
          autoProctorTest.renderProctoringSummary({
              renderOverview: true,
              proctorOverviewCtrId: "ap-test-report-overview",
              renderSummaryTable: true,
              proctorSummaryCtrId: "ap-proctor-summary",
              userDetails: {
                  name: "First Last",
                  email: "useremail@gmail.com",
              },
          });
      } catch (err) {
          console.log(err);
      }
  });
</script>
<?php endblock() ?>