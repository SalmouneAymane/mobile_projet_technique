<?php
require "db.php";

$genres = [];
$message = "";

try {
    $genreStmt = $conn->query("SELECT id, genreName FROM Genre ORDER BY genreName ASC");
    $genres = $genreStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Unable to load genres: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $songTitle = trim($_POST['SongTitle'] ?? "");
    $genreId = (int) ($_POST['genre_id'] ?? 0);
    $status = $_POST['status'] ?? 'Draft';
    $songUpload = $_FILES['songFile'] ?? [];
    $coverUpload = $_FILES['coverImage'] ?? [];

    if (!$songTitle || !$genreId || !in_array($status, ['Draft', 'published'], true)
        || $songUpload['error'] !== UPLOAD_ERR_OK
        || $coverUpload['error'] !== UPLOAD_ERR_OK) {
        $message = "Please fill all fields and upload both files.";
    } else {
        $uploadDir = __DIR__ . "/songs_files/";

        $fileId = time();
        $songName = $fileId . "_" . preg_replace('/[^A-Za-z0-9_-]+/', '_', $songTitle)
            . "." . strtolower(pathinfo($songUpload['name'], PATHINFO_EXTENSION));
        $coverName = "cover_" . $fileId . "."
            . strtolower(pathinfo($coverUpload['name'], PATHINFO_EXTENSION));

        if (!move_uploaded_file($songUpload['tmp_name'], $uploadDir . $songName)
            || !move_uploaded_file($coverUpload['tmp_name'], $uploadDir . $coverName)) {
            $message = "The files could not be uploaded.";
        } else {
            try {
                $stmt = $conn->prepare(
                    "INSERT INTO Songs (SongTitle, ProfilePicture, songFilePath, artist_id, genre_id, status)
                     VALUES (?, ?, ?, ?, ?, ?)"
                );
                $stmt->execute([
                    $songTitle,
                    "songs_files/" . $coverName,
                    "songs_files/" . $songName,
                    1,
                    $genreId,
                    $status,
                ]);
                header("Location: index.php");
                exit;
            } catch (PDOException $e) {
                $message = "Database error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Song</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <a href="index.php" class="add-btn">Back to List</a>
        </div>

        <h1>Add a new song</h1>

        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="song-form">
            <div class="form-row">
                <label for="SongTitle">Song Title</label>
                <input type="text" id="SongTitle" name="SongTitle" placeholder="Enter your song title" required>
            </div>

            <div class="form-row">
                <label for="songFile">Song File</label>
                <input type="file" id="songFile" name="songFile" accept="audio/*" required>
            </div>

            <div class="form-row">
                <label for="coverImage">Song Cover</label>
                <input type="file" id="coverImage" name="coverImage" accept="image/*" required>
            </div>

            <div class="form-row">
                <label for="genre_id">Genre</label>
                <select id="genre_id" name="genre_id" required>
                    <option value="">Choose a genre</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= htmlspecialchars($genre['id']); ?>"><?= htmlspecialchars($genre['genreName']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <input type="hidden" name="artist_id" value="1">

            <button type="submit" class="submit-btn">Save Song</button>
        </form>
    </div>
</body>
</html>