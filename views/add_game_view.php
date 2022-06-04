<?php
$api_url = 'http://localhost/vanilla/taniver-game/api/genre/read.php';
$api_json = file_get_contents($api_url);
// echo $api_json;
$api_array = json_decode($api_json, true);
?>

<div class="card-main m-3">
    <div class="card-header">Add Game: </div>
    <div class="card-body">
        <form method="POST" action="actions/game/create.php" enctype="multipart/form-data">
            <label class="form-label" for="title">Title:</label><br>
            <input class="form-control" type="text" id="title" name="title"><br>
            <label class="form-label" for="image">Thumbnail:</label><br>
            <input class="form-control" type="file" id="image" name="image"><br>
            <label class="form-label" for="link">Link:</label><br>
            <input class="form-control" type="text" id="link" name="link"><br><br>
            <label class="form-label" for="video_link">Video Link:</label><br>
            <input class="form-control" type="text" id="video_link" name="video_link"><br><br>
            <label class="form-label" for="genre_id">Genre:</label><br>
            <select class="form-select" name="genre_id" id="genre_id">
                <?php foreach ($api_array['data'] as $key) {
                ?>
                    <option value="<?= $key['id'] ?>"><?= $key['name'] ?></option>
                <?php } ?>
            </select>
            <div class="mt-2">
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>