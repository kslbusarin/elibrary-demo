<?php
//Define Access-Control-Allow-Origi
header("Access-Control-Allow-Origin: *");

// header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set("memory_limit","2048M");

include("../backend/class/connect_db.php");

$arr = array();
$response = array();
$arr_folder  = array(); 
$arr_book = array();
$imageDir = "";
$directory = 'files/';

    $sql = "select * from book where bookid > 428";

    $result = pg_query($db_connection, $sql);
    while ($row = pg_fetch_assoc($result)) {
        $arr[] = $row["bookid"];
    }

    //    echo var_dump($arr);

    // Check if the directory exists
    if (is_dir($directory)) {
        // Open the directory
        if ($handle = opendir($directory)) {
            // Iterate through each entry in the directory
            while (($entry = readdir($handle)) !== false) {
                // Exclude the current directory (.) and parent directory (..)
                if ($entry != "." && $entry != "..") {
                    // Check if the entry is a subdirectory
                    if (is_dir($directory . $entry)) {
                        // echo $entry . "<br>";
                        $arr_folder[] = $entry ;
                    }
                }
            }
            // Close the directory handle
            closedir($handle);
        }

        // echo var_dump($arr_master);
    }

    // print_r($arr_folder);

    // print_r($arr);

    // Find the values in $arr_master that are not present in $arr
    $difference = array_diff($arr, $arr_folder);
    // var_dump($difference);

    // Output the difference
    // echo "Difference: ";
    foreach ($difference as $bookid) {
        // echo $bookid . " ";
        create_master_file($bookid,$db_connection);
    }


function create_master_file($bookid,$db_connection){
    $imageDir = './files/'.$bookid.'/master/';

    $sql = "select * from book where bookid = $bookid";

    $result = pg_query($db_connection, $sql);
    while ($row = pg_fetch_assoc($result)) {
        $arr_book[] = $row;
    }
    $pdfUrl = $arr_book[0]["bookfileurl"];
    // Create the image directory if it doesn't exist
    if (!file_exists($imageDir)) {
            mkdir($imageDir, 0755, true);

            // Set the owner to "www-data:www-data"
            chown($directory, 'www-data');
            chgrp($directory, 'www-data');
            
        // Disable SSL verification in the stream context
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ]);

        // Download the PDF file with SSL verification disabled
        $pdfContent = file_get_contents($pdfUrl, false, $context);

        if ($pdfContent !== false) {
                // Generate a unique local filename for the PDF
                $pdfFileName = uniqid() . '.pdf';
                $pdfPath = $imageDir . '/' . $pdfFileName;

                // Save the PDF file locally
                file_put_contents($pdfPath, $pdfContent);

                // Convert PDF to images using pdftoppm
                $command = sprintf('pdftoppm -jpeg %s %s/page', escapeshellarg($pdfPath), escapeshellarg($imageDir));
                exec($command, $output, $returnCode);

                chown($pdfPath, 'www-data');
                chgrp($pdfPath, 'www-data');
                
                if ($returnCode === 0) {
                    $logEntryFormat = "$bookid PDF converted to images successfully!";
                    echo $logEntryFormat;

                    $logFile = '/var/www/html/elibrary/file_preview/files/log.txt'; // Path to the log file
                    
                    // Create or open the log file in append mode
                    $fileHandle = fopen($logFile, 'a');

                    if ($fileHandle) {
                        // Create a DateTime object with the current time in UTC
                        $dateTime = new DateTime('now', new DateTimeZone('UTC'));

                        // Convert the DateTime object to the Bangkok timezone
                        $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok'));

                        // Format the datetime string
                        $timeInBangkok = $dateTime->format('Y-m-d H:i:s');

                        $message = $timeInBangkok . " File $bookid PDF converted to images successfully\n";

                        // Write the message to the log file
                        fwrite($fileHandle, $message);

                        // Close the file handle
                        fclose($fileHandle);

                        echo "Log entry added successfully.";
                    } else {
                        echo "Unable to open the log file.";
                    }

                } else {
                    echo 'Failed to convert PDF to images.';

                }

                // Remove the downloaded PDF file
                unlink($pdfPath);
        } else {
            echo 'Failed to download PDF file.';
        }


    }
    else{
        //echo "Already Files<br>";;
    }
}
?>
