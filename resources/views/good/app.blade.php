<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta id="vp" name="viewport" content="width=device-width, user-scalable=no,maximum-scale=1.0,initial-scale=1">
    <title>商品详情</title>
    <style>
        html,body,ul,ol,li,form,fieldset,div,img {
            margin: 0;
            padding: 0
        }

        h1,h2,h3,h4,h5,h6,p {
            margin: 0
        }

        body {
            text-align: center
        }

        img {
            max-width: 100%!important;
            display: block;
            margin: 0 auto
        }

        table {
            max-width: 100%!important;
            display: block;
            margin: 0 auto
        }

        .night {
            background: #343434
        }

        .night h1,.night h2,.night h3 {
            color: #B8B8B8
        }

        .night p {
            color: #999
        }

        .night img {
            -webkit-mask-image: -webkit-gradient(linear,0 0,0 100%,from(rgba(0,0,0,.7)),to(rgba(0,0,0,.7)))
        }

        .theme-lanting {
            font-family: FZLanTingHei-EL-GBK
        }

        @media all and (max-width:480px) {
            .theme-lanting {
                font-size: 1.6rem
            }

            .theme-lanting h1,.theme-lanting h2 {
                font-size: 1.8rem;
                font-weight: 600
            }

            .theme-lanting h3,.theme-lanting h4,.theme-lanting h5,.theme-lanting h6 {
                font-size: 1.6rem;
                font-weight: 600
            }
        }

        @media all and (min-width:481px) {
            .theme-lanting {
                font-size: 1.6rem
            }

            .theme-lanting h1,.theme-lanting h2 {
                font-size: 1.8rem;
                font-weight: 600
            }

            .theme-lanting h3,.theme-lanting h4,.theme-lanting h5,.theme-lanting h6 {
                font-size: 1.6rem;
                font-weight: 600
            }
        }
    </style>
</head>
<body>
    <p>
        <?php foreach($data['detail_images'] as $image): ?>
        <img src="<?=$image?>" alt=""/>
        <?php endforeach ?>
    </p>
</body>
</html>