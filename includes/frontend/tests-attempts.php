<?php
$autoproctor_plugin_settings = get_option('autoproctor_settings');
$clientId                    = $autoproctor_plugin_settings['client_id'];
$test_id                     = get_query_var('test_id');
$results                     = getAllAttemptsDataByTestId($test_id);

if ($results) {
 foreach ($results as $row) {
  $hashedLabel     = getHashedTestAttemptId($row->test_attempt_label);
  $row->report_url = home_url() . '/test-attempt-report/' . $row->test_attempt_label . '/?hashed_test_attempt_id=' . $hashedLabel;
 }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Attempts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://ap-development.s3.ap-south-1.amazonaws.com/socTable.css">
    <script src="https://ap-development.s3.ap-south-1.amazonaws.com/socTable.js"></script>
</head>
<body>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Test Attempts of test <?php echo $test_id; ?> </h1>
        <div id="ap-test-attempts"></div>
    </div>
</body>
<script>
    const attempts = <?php echo json_encode($results); ?>;
    window.addEventListener('load', function() {
        const columns = [
                { id: "index", header: "S.No" },
                { id: "label" },
                { id: "started_at", cell: (props) => {
                        return props.getValue() === null ? "-" : props.getValue();
                    }, },
                { id: "finished_at", cell: (props) => {
                        return props.getValue() === null ? "-" : props.getValue();
                    }, },
                {
                    id: "finished",
                    header: "Test Completed",
                    cell: (props) => {
                        return props.getValue() === "true" ? "Yes" : "No";
                    },
                },
                {
                    id: "report",
                    header: "Report",
                    enableSorting: false,
                    enableGlobalFilter: false,
                    cell: (props) => {
                        return `<a class="text-blue-500 hover:underline hover:text-blue-600" href="${props.getValue()}" target="_blank">
                                View Report
                            </a>`;

                    },
                },
            ];

            const tableData = [];
            attempts.forEach((d, index) => {
                tableData.push([index + 1, d.test_attempt_label,d.started_at, d.finished_at, d.finished, d.report_url]);
            });

            socTable.initialize("ap-test-attempts", {
                columns,
                data: tableData,
            });
    });
</script>
</html>


