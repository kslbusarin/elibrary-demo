<?php
//Define Access-Control-Allow-Origi
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set("memory_limit","2048M");

include("../backend/class/connect_db.php");
$uid = $_POST['uid'];
$bookid = $_POST['bookid'];
// echo "Generate";
// echo $uid;
// echo $bookid;
$arr = array();
$response = array();
$imageDir = "";
$sql = "select * from  borrow br
join book
on book.bookid = br.bookid
join users usr
on br.userid = usr.userid
join psu_passport psu
on psu.userid = usr.userid 
join borrow_level bl
on usr.borrowlevelid = bl.borrowlevelid
where book.bookid = $bookid
and psu.uid = '$uid'";


// // For generate file master
// $sql = "select * from  book
// where book.bookid = $bookid
// limit 1";

            $result = pg_query($db_connection, $sql);
            while ($row = pg_fetch_assoc($result)) {
                $arr[] = $row;
            }
            // echo $arr[0]["bookfileurl"];
            $uname = $arr[0]["fullname_en"];
            $userid = $arr[0]["userid"];
            // Create a DateTime object with the input date and time
            $dateTime = new DateTime($arr[0]["borrowstartdate"]);

            // Format the DateTime object to the desired output format
            $borrowstartdate = $dateTime->format("Y-m-d H:i:s");
            $borrowdaylimit = $arr[0]["borrowdaylimit"];

            // Number of days to add
            $nextdate = "$borrowdaylimit days";

            // Add the number of days to the output date and time
            $expiredatetime = date("Y-m-d H:i:s", strtotime($borrowstartdate . " + " . $nextdate));

            // Update viewcount
            if($result){    
                // Remote URL of the PDF file
                // $pdfUrl = 'https://fs-elibrary.psu.ac.th/file-server?filePath=18e55fced981085aa7e80e7c670f45a8&fileName=424402.pdf./files/416/64675f79d2950.pdf';
                $pdfUrl = $arr[0]["bookfileurl"];
                // echo $arr[0]["bookid"];

                if(isset($arr[0]["bookid"]) && !empty($arr[0]["bookid"]) && !is_null($arr[0]["bookid"])){
                    // Directory where the generated images will be saved
                    $imageDir = './files/'.$arr[0]["bookid"].'/master/';

                    // Create the image directory if it doesn't exist
                    if (!file_exists($imageDir)) {
                            mkdir($imageDir, 0755, true);
                            
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

                                if ($returnCode === 0) {
                                    //echo 'PDF converted to images successfully!';
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

                    $status = add_watermark($uname, $uid, $userid, $bookid, $borrowstartdate, $borrowdaylimit, $expiredatetime);
                    $page_count = count_page($imageDir);

                    // header('Content-Type: application/json');
                    // Encode the response as JSON and send it
                    $response['status'] = $status;
                    $response['page_count'] = $page_count;

                    echo json_encode($response);
                }
                else{
                    $arr = ['Can not create image'];
                }
            }
            else{
                $arr = ['empty'];
            }
            

        // echo json_encode($arr);

function add_watermark($uname, $uid, $userid, $bookid, $borrowstartdate, $borrowdaylimit, $expiredatetime){
    // Path to the image directory
    $imageDir = 'files/'.$bookid.'/master/';

    // Output directory for watermarked images
    $outputDir = 'files/'.$bookid.'/'.$uid.'/';
    if (!file_exists($outputDir)) {
        // Get all JPEG images in the directory
        $imageFiles = glob($imageDir . '*.jpg');

        // Watermark text
        $watermarkText = $uname."\n".$uid;

        // Font file path
        $fontPath = '../fornts/LiberationSans-Regular.ttf';

        // Font size (adjust as needed)
        $fontSize = 50;

        $angle = 45; // Rotate text by 45 degrees

        
        // Create the output directory if it doesn't exist
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Iterate through the image files and process them
        foreach ($imageFiles as $index => $imageFile) {
            // Create a new image resource from the file
            $image = imagecreatefromjpeg($imageFile);

            // Set the watermark properties
            $textColor = imagecolorallocatealpha($image, 192, 192, 192, 60); // Black color for watermark

            // Calculate the watermark position (centered)
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $textMetrics = imagettfbbox($fontSize, 0, $fontPath, $watermarkText);
            $textWidth = $textMetrics[4] - $textMetrics[6];
            $textHeight = $textMetrics[3] - $textMetrics[5];
            $x = ($imageWidth - $textWidth) / (mt_rand(5, 15) / 10);
            $y = ($imageHeight + $textHeight) / (mt_rand(15, 20) / 10);

            // Add the watermark to the image
            // imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $fontPath, $watermarkText);

            // imagettftext($image, 20, 0, 5, 30, $textColor, $fontPath, "Borrow start: $borrowstartdate\nBorrow end: $expiredatetime\n$uname");
            // Generate the output filename for the watermarked image
            $outputFile = $outputDir . '/page-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '.jpg';

            // Save the watermarked image to the output directory
            imagejpeg($image, $outputFile);

            // Free up memory
            imagedestroy($image);
        }

        // Output the watermarked images
        $response['status'] = "success";
        // echo  $response['status'];
        foreach (glob($outputDir . '*.jpg') as $outputFile) {
        // echo("test1");
        // echo("\n".$outputFile);
            // // Set the content type header
            // header('Content-Type: image/jpeg');

            // // Output the image file
            // readfile($outputFile);

            // Add a line break between images
            
        }
    }
    else{
        $response['status'] = "success";
    }

    return $response['status'];
}

function count_page($imageDir){
    $fileCount = 0;
    // Open the directory
    if ($handle = opendir($imageDir)) {
        // Loop through each file in the directory
        while (false !== ($file = readdir($handle))) {
            // Check if the file is a regular file with a .jpg extension
            if (is_file($imageDir . $file) && strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'jpg') {
                $fileCount++;
            }
        }

        // Close the directory handle
        closedir($handle);

        // Print the total count of JPEG files
        // $response['page_count'] = $fileCount;
        // echo "Total JPEG files in directory: " . $fileCount;
        // $response['page_count'] = $fileCount;


    } else {
        // Failed to open the directory
        // echo "Unable to open directory: " . $imageDir;
    }
    return $fileCount;
}
?>
