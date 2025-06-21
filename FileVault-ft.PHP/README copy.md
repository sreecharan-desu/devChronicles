# Key Takeaways from FileVault: PHP Full-Stack Edition

Congrats on building FileVault! Here’s the shit to remember—methods, tricks, and hacks that’ll make PHP coding less of a headache.

## Key PHP Methods & Concepts

### 1. Session Handling
- **`session_start()`**: Kick off every session-using file with this. No session, no user tracking.
- **`$_SESSION`**: Your go-to for storing user data (e.g., `$_SESSION['user']['name']`). Lives until the session dies.
- **`session_destroy()`**: Nukes the session (see `logout.php`). Clear `$_SESSION = array()` first for a clean slate.

### 2. Form Handling
- **`$_SERVER['REQUEST_METHOD'] === 'POST'`**: Detects form submissions. Simple and clutch.
- **`$_POST`**: Grabs form inputs (e.g., `$_POST['username']`). Use `empty()` or `isset()` to avoid fuck-ups.
- **`$_FILES`**: Manages file uploads (e.g., `$_FILES['fileToUpload']`). Key bits: `name`, `tmp_name`, `size`, `type`.

### 3. File Uploads
- **`move_uploaded_file($tmp_name, $target)`**: Shifts uploaded files to your folder. True = success.
- **`basename()`**: Strips paths from filenames—keeps it safe.
- **`pathinfo($path, PATHINFO_EXTENSION)`**: Gets file extensions. Pair with `strtolower()` for consistency.
- **`file_exists()` & `mkdir()`**: Checks/creates directories (e.g., `uploads/`). No folder, no upload.

### 4. Database Stuff
- **`queryDB($query)`**: Your custom SQL runner (from `db.php`). Raw SQL = watch for injection.
- **`mysqli_num_rows($result)`**: Counts result rows. Perfect for “is there data?” checks.
- **`foreach($result as $row)`**: Loops through query results (e.g., file list display).

### 5. Redirection
- **`header("Location: somepage.php")`**: Sends users elsewhere. Always add `exit()` after.
- **`htmlspecialchars()`**: Escapes output (e.g., `$_SESSION['user']['name']`). Stops XSS bullshit.

### 6. Error Handling
- **`die()`**: Kills the script with a message if shit hits the fan (e.g., missing fields).
- **Validation**: Check file size (`$_FILES['size']`), type (`in_array()`), and emptiness (`empty()`).

## CSS Tricks That Made It Awesome

### 1. Layout
- **`max-width` & `margin: auto`**: Centers forms, keeps them tidy.
- **`box-shadow`**: Adds depth to forms and images. Looks pro.
- **`border-radius`**: Rounds edges for that sleek vibe.

### 2. Interactivity
- **`:hover`**: Changes colors on hover (buttons, links). Smooth with `transition`.
- **`transition`**: Eases color/size shifts (e.g., `transition: background 0.3s ease`).
- **`:focus`**: Highlights inputs when clicked (e.g., border color swap).

### 3. Visuals
- **`linear-gradient()`**: Sexy background fade.
- **`text-shadow`**: Subtle text pop—classy, not cheesy.

## JavaScript/jQuery Bits

### 1. jQuery
- **`$(selector)`**: Fast DOM grabs (e.g., `$("#fileToUpload")`).
- **`.change()`**: Fires on file input changes—great for previews.
- **`.attr()` & `.show()`/`.hide()`**: Updates image `src` and toggles visibility.

### 2. File Preview
- **`URL.createObjectURL(file)`**: Makes temp URLs for image previews. Fucking genius.

## Pro Tips to Save Your Ass
- **Always `exit()` after `header()`**: Stops rogue code from running post-redirect.
- **Check `isset()` first**: Avoid undefined index errors (e.g., `isset($_FILES['fileToUpload'])`).
- **Keep CSS separate**: `styles.css` = reusable and tweakable.
- **Test uploads locally**: XAMPP or similar—permissions can screw you.
- **Backup your DB**: One bad query, and your data’s gone.

## Shit That’ll Make Life Easier Next Time
- **Reuse this structure**: Session + form + upload = solid app base.
- **Memorize `$_FILES`**: Tricky bastard, but it’s upload central.
- **Steal your CSS**: Gradient + shadow combo is gold—keep it.

---

You’ve got the core of a badass PHP app down. These methods and tricks are your cheat sheet—`$_FILES` might still be a pain, but you’ll tame it. What’s next on your coding hitlist?