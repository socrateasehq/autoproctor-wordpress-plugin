<?php include 'base.php' ?>

<?php startblock('title') ?>
Test Results
<?php endblock() ?>


<?php startblock('head') ?>
<?php superblock() ?>
<link rel="stylesheet" href="https://ap-development.s3.ap-south-1.amazonaws.com/socTable.css">
<script src="https://ap-development.s3.ap-south-1.amazonaws.com/socTable.js"></script>
<?php
echo '<script src="' . esc_url(plugins_url('utils/utilities.js', dirname(__FILE__))) . '" ></script> ';
?>

<?php endblock() ?>



<?php startblock('body') ?>

    <body class="min-h-screen bg-gradient-to-b from-blue-200 to-white" style="font-family: lato">
        <div class="container mx-auto mt-8">
            <h1 class="text-3xl font-bold mb-4">Test Attempts of test <?php echo $test_id; ?> </h1>
            <div id="ap-test-attempts"></div>
        </div>
    </body>
    <script>
    const attempts = <?php echo json_encode($results); ?>;

   document.addEventListener("socTable.rendered", function() {
        const deleteButtons = document.querySelectorAll('.ap-test-attempt-delete');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                const testAttemptId = e.target.dataset.attemptid;
                console.log('testAttemptId', testAttemptId )
                deleteAttempt(testAttemptId);
            });
        });
    });

		document.addEventListener("socTable.updated", function() {
        const deleteButtons = document.querySelectorAll('.ap-test-attempt-delete');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                const testAttemptId = e.target.dataset.attemptid;
                console.log('testAttemptId', testAttemptId )
                deleteAttempt(testAttemptId);
            });
        });
    });



    window.addEventListener('load', function() {
        const columns = [{
                id: "index",
                header: "S.No"
            },
            {
                id: "label"
            },
            {
                id: "started_at",
                header: "Started At",
                cell: (props) => !props.getValue() ? "-" : convertISOStringToLocalDateTime(props.getValue()),

            },
            {
                id: "finished_at",
                header: "Finished At",
                cell: (props) => !props.getValue() ? "-" : convertISOStringToLocalDateTime(props.getValue()),
            },
            {
                id: "finished",
                header: "Test Completed",
                cell: (props) => {
                    return !props.getValue() ? "No" : "Yes";
                },
            },
            {
                id: "trust_score",
                header: "Trust Score",
                cell: (props) => `${props.getValue() !== null ? `${props.getValue() * 100} %` : "-"}`,
            },
            {
                id: "report",
                header: "Report",
                enableSorting: false,
                enableGlobalFilter: false,
                cell: (props) => `<a class="font-normal flex flex-col items-center justify-center text-blue-600 hover:underline text-blue-700 hover:text-blue-800 inline-flex items-center justify-center whitespace-nowrap" href="${props.getValue()}" target="_blank"><strong>View Report</strong></a>`,

            },
			{
                id: "action",
                header: "Action",
                enableSorting: false,
                enableGlobalFilter: false,
                cell: (props) => `<button class="font-normal flex flex-col items-center justify-center text-red-600 hover:underline text-red-700 hover:text-red-800 inline-flex items-center justify-center whitespace-nowrap ap-test-attempt-delete" onclick="deleteAttempt()" data-attemptid='${props.getValue()}'>Delete Attempt</button>`,

            },
        ];

        const tableData = [];
        attempts.forEach((d, index) => {
            tableData.push([index + 1, d.tenantTestAttemptId, d.startedAt, d.finishedAt,d.finishedAt, d.trustScore, d
                .report_url,d.tenantTestAttemptId
            ]);
        });

        socTable.initialize("ap-test-attempts", {
            columns,
			tableOptions : {
defaultPageSize: 200,
			},
            data: tableData,
        });
    });


	function deleteAttempt(testAttemptId) {
        deleteTestAttempt(testAttemptId, '<?php echo $ajax_url; ?>');
    }
    </script>
<?php endblock() ?>