<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8" />

    <title><?php echo @$title?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/app/views/assets/img/logo.png" type="image/png" />
    <link rel="stylesheet" href="/app/views/assets/styles/normalize.css">
    <link rel="stylesheet" href="/app/views/assets/styles/dashicons.css">
    <link rel="stylesheet" href="/app/views/assets/styles/font-awesome.min.css">
    <link rel="stylesheet" href="/app/views/assets/styles/style.css">
    <script>(function(e,t,n){var r=e.querySelectorAll('html')[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document, window,0);</script>
    <script src="/app/views/assets/js/tinymce/tinymce.js"></script>
    <script>
        tinymce.init({
            selector: "textarea#post_body",
            theme: "custom",
            plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker codesample"
            ],
            external_plugins: {
                //"moxiemanager": "/moxiemanager-php/plugin.js"
            },
            add_unload_trigger: false,
            autosave_ask_before_unload: false,

            toolbar1: " undo redo | fontsizeselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist",
           // toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media help code | insertdatetime preview | forecolor backcolor",
            toolbar2: "table | hr removeformat | subscript superscript | charmap emoticons | insertfile insertimage codesample | link unlink anchor image media help code ",
            menubar: false,
            toolbar_items_size: 'small',

            spellchecker_callback: function(method, data, success) {
                if (method == "spellcheck") {
                    var words = data.match(this.getWordCharPattern());
                    var suggestions = {};

                    for (var i = 0; i < words.length; i++) {
                        suggestions[words[i]] = ["First", "second"];
                    }

                    success({words: suggestions, dictionary: true});
                }

                if (method == "addToDictionary") {
                    success();
                }
            }
        });
    </script>
</head>
<body <?php echo body_tag_class() ?>>
<section id="header">
	<?php @include $admin_bar; ?>
</section>