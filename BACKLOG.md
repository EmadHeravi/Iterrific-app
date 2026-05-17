# Backlog

## Security hardening

- Tighten avatar upload handling:
  - Restrict allowed avatar uploads to `jpg`, `jpeg`, `png`, and `webp`.
  - Keep SVG blocked for avatars.
  - Re-encode uploaded images server-side before storage to strip metadata and unusual payloads.
  - Confirm webserver rules prevent script execution from `/storage`.
  - Keep generated filenames and public-disk storage for uploaded avatars.
