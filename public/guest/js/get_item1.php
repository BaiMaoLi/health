<script>
    featured_pictures=[];
</script>
<?php
$featured_picture_folder="public/slide_pictures";
$featured_pictures=scandir($featured_picture_folder);

if (count($featured_pictures)>=3){
    for ($i=2;$i<count($featured_pictures);$i++){
        ?>
        <script>
            featured_pictures.push("<?php echo $featured_pictures[$i]?>");
        </script>
        <?php
    }
}


?>
<script>
    function get_item(item_name) {
        var str;
        switch (item_name){
            case 'home_slide':
                str='<div class="grid-item item-box item-box-large item-box-slide">\
            <div class="content-box">';
                if (featured_pictures.length>0){
                    for (var i=0;i<featured_pictures.length;i++){
                        str+='<img src="/public/slide_pictures/'+featured_pictures[i]+'" style="height:100%"/>'
                    }
                }
                str+='</div>\
            </div>';
                break;
            case 'login':
                str='<div class="grid-item item-box">\
            <a class="content-box had-popup" href="login">\
            <img src="public/guest/images/img-login.jpg" />\
            </a>\
            </div>';
                break;
            case 'walk':
                str='<div class="grid-item item-box">\
            <div class="content-box">\
            <img src="public/guest/images/img-walk.jpg" />\
            </div>\
            </div>';
                break;
            case 'run':
                str='<div class="grid-item item-box">\
            <div class="content-box">\
            <img src="public/guest/images/img-run.jpg" />\
            </div>\
            </div>';
                break;
            case 'hidden':
                str='<div class="grid-item item-box" >\
            <div class="content-box" style="visibility: hidden">\
            <img src="public/guest/images/img-run.jpg" style="visibility:hidden"/>\
            </div>\
            </div>';
                break;
            case 'eat':
                str='<div class="grid-item item-box">\
            <div class="content-box">\
            <img src="public/guest/images/img-eat.jpg" />\
            </div>\
            </div>';
                break;
            case 'event':
                str='<div class="grid-item item-box">\
            <a class="content-box had-popup" data-toggle="modal" data-target="#event-form" href="#">\
            <img src="public/guest/images/img-event.jpg" />\
            </a>\
            </div>';
                break;
            case 'vega':
                str='<div class="grid-item item-box item-box-large">\
            <div class="content-box">\
            <img src="public/guest/images/img-vega.jpg" />\
            </div>\
            </div>';
                break;
            case 'register':
                str='<div class="grid-item item-box" id="someLargerElement">\
            <a class="content-box had-popup" data-toggle="modal" data-target="#register-form">\
            <img src="public/guest/images/img-register.jpg" />\
            </a>\
            </div>';
                break;
            case 'drink':
                str='<div class="grid-item item-box">\
            <div class="content-box">\
            <img src="public/guest/images/img-drink.jpg" />\
            </div>\
            </div>';
                break;
            case 'mou':
                str='<div class="grid-item item-box">\
            <div class="content-box">\
            <img src="public/guest/images/img-mou.jpg" />\
            </div>\
            </div>';
                break;
            case 'blwomen':
                str='<div class="grid-item item-box">\
            <div class="content-box">\
            <img src="public/guest/images/img-blwomen.jpg" />\
            </div>\
            </div>';
                break;
            case 'clearfix':
                str='<div class="clearfix"></div>';
                break;
            default:
                str='';

        }

        return str;



    }


</script>
