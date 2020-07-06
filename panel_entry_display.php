<?php
include("connection.php");
include("functions_entry_display.php");

$entry_id = $_POST['search'];


form_bundle_output($entry_id);

sense_bundle_output($entry_id);




?>

<script type='text/javascript' src="js/sound.js"></script>
<script type='text/javascript' src="js/image.js"></script>
<script type='text/javascript' src="js/entry_display_check.js"></script>
<script type='text/javascript' src="js/buttons_keys.js"></script>

<?php



    ?>