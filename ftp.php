
$dir = '/public_html/';

if(isset($_POST['l1'])) {


    $file = $_POST['l1'];

    $renamefile = $_POST['n1'];


    $newfile = basename($file);


    if (!copy($file, $newfile)) {
        echo "failed to copy file $file...\n";
    }


    $file = $newfile;
    $remote_file = "/$dir/$renamefile.zip";

    $ftp = ftp_connect('ftp_ip');
    $login_result = ftp_login($ftp, 'frp_username', 'ftpp_password');

    if (ftp_put($ftp, $remote_file, $file, FTP_BINARY)) {
        echo "<p style='color: #14b214;'>$file upload :) </p>";

        if (!unlink($file)) {
            echo("<p style='color: #f30b3b;'>Error deleting file $file </p><br>");
        } else {
            echo("<p style='color: #14b214;'>$file Delete :) </p><br>");
        }


    } else {
        echo "<p style='color: #f30b3b;'>file $file NOT upload ! :( </p><br>";
    }

    ftp_close($ftp);


}
?>