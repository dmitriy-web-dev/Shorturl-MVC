<?php
if (isset($_POST['submit'])) {
    require_once('../backend/models/url_functions.php');
    $function = new url_functions();
    $long_url = htmlspecialchars(filter_var($_POST['long_url'], FILTER_SANITIZE_URL));

    if($function->isDomainAvailable($long_url))
    {
        $short_url = hash("crc32b", $long_url);
        $data = ['id' => NULL, 'long_url' => $long_url, 'short_url' => $short_url];
        $shortened = $function->add($data);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Short URL creator</title>
</head>
<body>
<div class="jumbotron vertical-center">
    <div class="container">
        <h1>Short URL creator</h1>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { if (!empty($shortened)): ?>
            <div class="alert alert-success" role="alert">
                Your URL has been shortened! <?php echo "http://localhost/" . $shortened ?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                You entered an invalid URL!
            </div>
        <?php endif; } else { ?>
            <form method="POST">
                <div class="form-group">
                    <label for="url">Enter the URL to be shortened:</label>
                    <input type="text" class="form-control" id="long_url" name="long_url" aria-describedby="urlInsert" placeholder="Enter URL">
                    <small id="urlInsert" class="form-text text-muted">URL to be shortened</small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } ?>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>