<?php
require "db.php";

$stmt = $conn->query(
    "SELECT s.*, a.ArtistName, g.genreName
     FROM Songs s
     LEFT JOIN Artists a ON a.id = s.artist_id
     LEFT JOIN Genre g ON g.id = s.genre_id
     ORDER BY s.id ASC"
);
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <a href="addSong.php" class="add-btn">Add Song</a>
        </div>

        <h1>Songs list</h1>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Song</th>
                        <th>Genre</th>
                        <th>Status</th>
                        <th>Creation Date</th>
                        <th>Publication Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($songs) > 0): ?>
                        <?php foreach ($songs as $song): ?>
                            <?php
                                $coverValue = $song['ProfilePicture'] ?? '';
                                $songPathValue = $song['songFilePath'] ?? '';
                            ?>
                            <tr>
                                <td><?= htmlspecialchars((string) ($song['id'] ?? '')); ?></td>
                                <td>
                                    <?php if (!empty($coverValue)): ?>
                                        <img src="<?= htmlspecialchars($coverValue); ?>" alt="<?= htmlspecialchars($song['SongTitle'] ?? 'Song'); ?>" width="60">
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($song['SongTitle'] ?? ''); ?></td>
                                <td><?= htmlspecialchars($song['ArtistName'] ?? 'Unknown'); ?></td>
                                <td>
                                    <?php if (!empty($songPathValue)): ?>
                                        <audio controls src="<?= htmlspecialchars($songPathValue); ?>"></audio>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($song['genreName'] ?? 'Unknown'); ?></td>
                                <td><?= htmlspecialchars($song['status'] ?? ''); ?></td>
                                <td><?= htmlspecialchars($song['dateOfCreation'] ?? ''); ?></td>
                                <td><?= htmlspecialchars($song['dateOfPublication'] ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No songs found in the database.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>