<?php

return [

    'cdn' => function () {
        return asset('vendor/js/tinymce/tinymce.min.js');
    },
    /*'baseUrl' => function(){
        return asset('/vendor/js/tinymce');
    },*/
    'params' => [
        "selector" => "#mytiny",
        "language" => 'pt_BR',
        "theme" => "modern",
        "skin" => "lightgray",
        "height" => 400,
        "plugins" => [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        "toolbar" => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    ]

];