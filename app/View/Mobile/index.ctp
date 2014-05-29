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
    <div class="mtm copyright text-center">©2014 <a href="http://cakewx.com/" target="_blank">CakeWX</a></div>
</div>
