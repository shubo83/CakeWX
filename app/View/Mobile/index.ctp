<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title><?php echo $post['title'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <style>
        body{ -webkit-touch-callout: none; -webkit-text-size-adjust: none; }
    </style>
</head>
<body id="activity-detail">
<div class="page-bizinfo">
    <div class="header">
        <h1 id="activity-name"><?php echo $post['title'] ?></h1>
        <p class="activity-info">
            <span id="post-date" class="activity-meta no-extra"><?php echo  $post['dateline'] ?></span>
            <a href="javascript:viewProfile();" id="post-user" class="activity-meta">
                <span class="text-ellipsis"><?php echo $post['author'] ?></span><i class="icon_link_arrow"></i>
            </a>
        </p>
    </div>
</div>
<div id="page-content" class="page-content">
    <div id="img-content">
        <div class="text"><?php echo $post['content'] ?></div>
    </div>
</div>
</body>
</html>