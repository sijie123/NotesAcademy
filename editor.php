<?php
include "check.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Editor</title>
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="plugins/jquery.min.js"></script>
  <style type="text/css" media="screen">
    .ace_editor {
        position: relative !important;
        border: 1px solid lightgray;
        margin: auto;
        height: 700px;
        width: 80%;
    }
    .ace_editor.fullScreen {
        height: auto;
        width: auto;
        border: 0;
        margin: 0;
        position: fixed !important;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 10;
    }
    .fullScreen {
        overflow: hidden
    }
    .scrollmargin {
        height: 100px;
        text-align: center;
    }
    .large-button {
        color: lightblue;
        cursor: pointer;
        font: 30px arial;
        padding: 20px;
        text-align: center;
        border: medium solid transparent;
        display: inline-block;
    }
    .large-button:hover {
        border: medium solid lightgray;
        border-radius: 10px 10px 10px 10px;
        box-shadow: 0 0 12px 0 lightblue;
    }
  </style>
</head>
<body>
<div class="scrollmargin">
    <span onclick="scroll()" class="large-button">
    Save &dArr;
    </span>
</div>
<form class="form-horizontal" action="editor.php" method="POST">
                                    <div class="form-group has-feedback">
                                        <label for="urls" class="col-sm-2 control-label">URL</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="urls" name="urls" placeholder="URL" value="
                                            <?php
                                            if (isset($_POST['urls'])) echo $_POST['urls'];?>">
                                            <button type="submit" class="btn btn-default btn-sm">Submit</button>
                                        </div>
                                    </div>
<pre id="editor">
<?php
if (isset($_POST['urls'])) {
    echo htmlspecialchars(file_get_contents("/var/www/html/".$_POST['urls']));
}
?>
</pre>

<!-- load ace -->
<script src="ace-builds/src/ace.js"></script>
<!-- load ace themelist extension -->
<script src="ace-builds/src/ext-themelist.js"></script>
<script>

// create first editor
var editor = ace.edit("editor");
editor.setTheme("ace/theme/twilight");
editor.session.setMode("ace/mode/php");


function scroll(speed) {
   var cont = editor.getValue();
    $.ajax({
        url: "process.php",
        type: "POST",
        data: {
            cont: cont
        },
        success: function( data ) {
            
        }
    });
}
</script>

</body>
</html>