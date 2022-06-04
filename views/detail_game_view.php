<?php
$id = $_GET['id'];
$api_url = 'http://localhost/vanilla/taniver-game/api/game/read_single.php?id=' . $id;
$api_json = file_get_contents($api_url);
$api_array = json_decode($api_json, true)['data'];
if (isset($_SESSION['token'])) { ?>
    <div class="container mt-2 mb-4">
        <div class="card-main m-3">
            <div class="card-header">Detail Game: </div>
            <div class="card-body">
                <form method="POST" action="actions/game/update.php" enctype="multipart/form-data">
                    <input type="hidden" name="_METHOD" value="PUT" />
                    <input type="hidden" id="id" name="id" value="<?= $api_array['id'] ?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $api_array['user_id'] ?>">
                    <input type="hidden" id="current_image" name="current_image" value="<?= $api_array['image'] ?>">
                    <label class="form-label" for="title">Title:</label><br>
                    <input class="form-control" type="text" id="title" name="title" value="<?= $api_array['title'] ?>"><br>
                    <label class="form-label" for="image">Thumbnail:</label><br>
                    <input class="form-control" type="file" id="image" name="image"><br>
                    <img src="http://localhost/vanilla/taniver-game/<?= $api_array['image'] ?>" alt=""><br>
                    <label class="form-label" for="link">Link:</label><br>
                    <input class="form-control" type="text" id="link" name="link" value="<?= $api_array['link'] ?>"><br><br>
                    <label class="form-label" for="video_link">Video Link:</label><br>
                    <input class="form-control" type="text" id="video_link" name="video_link" value="<?= $api_array['video_link'] ?>"><br><br>
                    <input type="hidden" id="genre_id" name="genre_id" value="<?= $api_array['genre_id'] ?>">
                    <div class="mt-2">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } else { ?>

    <div class="container mt-2 mb-4">
        <h3 for="title"><?= $api_array['title'] ?></h3>
        <p><?= date('d F Y, h:i a', strtotime($api_array['created_at'])); ?></p><br>
        <img src="http://localhost/vanilla/taniver-game/<?= $api_array['image'] ?>" alt=""><br>
        <h6 class="mt-2">Link: <a target="_blank" href="<?= $api_array['link'] ?>"><?= $api_array['link'] ?></a></h6>
        <h6>Video Link: <a target="_blank" href="<?= $api_array['video_link'] ?>"><?= $api_array['video_link'] ?></a></h6>
    </div>

<?php } ?>