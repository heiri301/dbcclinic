<?php

// configuration
$url = 'index.php';
$file = 'files/gary.txt';

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>
<!-- HTML form -->
<form action="" method="post">
<textarea name="text" style="resize: none;" rows="10" cols="50"><?php echo htmlspecialchars($text) ?></textarea>
<input type="submit" />
<input type="reset" />
</form>
