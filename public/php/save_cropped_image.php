<?php
    $upload_dir = 'public/avatars/';
    $img = $_POST['canvasData'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $file = $upload_dir . uniqid() . '.png';
    if (file_put_contents($file, base64_decode($img))) {
        echo "File saved successfully.";
    } else {
        echo "Error saving file.";
}
?>

<?php
    $upload_dir = 'public/storage/avatars/';
    $canvasData = $_POST['canvasData'];
    $img = str_replace('data:image/png;base64,', '', $canvasData);
    $img = str_replace(' ', '+', $img);
    $file = $upload_dir . uniqid() . '.png';
    file_put_contents($file, base64_decode($img));
?>
