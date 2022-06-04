<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$api_url = 'http://localhost/vanilla/taniver-game/api/game/read.php?page=' . $page;
$api_json = file_get_contents($api_url);
// echo $api_json;
$api_array = json_decode($api_json, true);
$pagination = $api_array['page'];

?>
<table class="table table-striped">
    <tr>
        <th>No </th>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Action</th>
    </tr>
    <?php
    $no = 1;
    foreach ($api_array['data'] as $key) {
    ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $key['title']; ?></td>
            <td><?= $key['author']; ?></td>
            <td><?= $key['genre_name']; ?></td>
            <td>
                <a class="btn btn-primary mb-2" href="<?= BASE_URL . '?menu=detail&id=' . $key['id'] ?>">Detail</a>
                <?php
                if (isset($_SESSION['token'])) { ?>

                    <form action="actions/game/delete.php" method="POST">
                        <input type="hidden" name="id" value="<?= $key['id'] ?>">
                        <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                <?php }
                ?>

            </td>
        </tr>
    <?php
        $no = $no + 1;
    }
    ?>
</table>
<ul class="pagination">
    <li class="page-item">
        <a class="page-link" href="<?= BASE_URL . '?page=' . $pagination['0']['previous_page'] ?>">Previous</a>
    </li>
    <li class="page-item active">
        <a class="page-link" href="#"><?= $pagination['0']['current_page'] ?></a>
    </li>
    <li class="page-item">
        <a class="page-link" href="<?= BASE_URL . '?page=' . $pagination['0']['next_page'] ?>">Next</a>
    </li>
</ul>