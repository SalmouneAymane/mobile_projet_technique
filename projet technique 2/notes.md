# Backend structure (request flow)

1. `backend/api.php` — entry point; routes `POST` to `store()`, other requests to `index()`.
2. `backend/GenreController.php` — handles the request and returns JSON.
3. `backend/GenreGestionnaire.php` — reads/writes genres and creates genre records.
4. `backend/Genre.php` — genre model: `id`, `name`.
5. `backend/database/database.json` — JSON data store:

   ```json
   [{ "id": 1, "name": "pop" }]
   ```
