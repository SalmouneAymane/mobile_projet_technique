# Add asynchronous UI features

Use the existing form and API (`GET` returns a genre array; `POST` adds `{ "name": "..." }`).

## 1. Add loading and error helpers

- Get `btn-enregistrer-categorie` and `toast-container` from the DOM.
- Disable the submit button while saving; change its text to `Enregistrement…`, then restore it.
- Add a `showToast(message, type)` helper that appends a success/error message to `toast-container` and removes it after a few seconds.

## 2. Make API requests handle errors

- Check `response.ok` before parsing JSON.
- Catch network/JSON errors and show an error toast.
- In `getData()`, keep rendering the returned array (`id`, `name`) into `tBody`.

```js
async function request(url, options) {
    const response = await fetch(url, options);
    if (!response.ok) throw new Error(`HTTP ${response.status}`);
    return response.json();
}
```

## 3. Wait for save before refreshing

- Make `pushData(name)` `async`.
- POST `{ name }`, and only after it succeeds: close/reset the form, show a success toast, and `await getData()`.
- Remove the immediate `getData()` after `pushData(name)` in the submit handler; otherwise the list may refresh before the POST finishes.
- Use `try/catch/finally` so errors are shown and the button is always re-enabled.

## 4. Improve form interactions

- On submit, call `event.preventDefault()` and trim/validate the name.
- On cancel, hide the form and reset it.
- Optionally show the form while loading the initial list, then render the list when `getData()` completes.

