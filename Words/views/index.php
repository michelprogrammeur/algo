<html>
<head>

    <style>
        .flex-container {
            padding: 0;
            margin: 0;
            list-style: none;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-flow: row wrap;
            justify-content: space-around;
            counter-reset: headings;
            width: 860px; margin: 0 auto;
        }

        .flex-item {
            background: tomato;
            padding: 5px;
            width: 200px;
            height: 150px;
            margin-top: 10px;
            line-height: 150px;
            color: white;
            font-weight: bold;
            font-size: 3em;
            text-align: center;
        }

        /*li.flex-item:before {*/
        /*counter-increment: headings;*/
        /*content: counter(headings);*/
        /*}*/
    </style>

</head>
<body>
<div class="flex-container">
    <?php foreach ($letters as $row) : ?>
        <?php foreach ($row as $c) : ?>
            <div class="flex-item"><?php echo $c; ?></div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
</body>
</html>