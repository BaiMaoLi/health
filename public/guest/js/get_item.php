<script>
    var featured_pictures=[];
</script>
<?php
$featured_picture_folder="public/slide_pictures";
$featured_pictures=scandir($featured_picture_folder);
$k1=0;
$k2=0;

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
    var k1=0,k2=0;
    function get_item(item_name) {
        var str;
        switch (item_name){
            case 'home_slide':
                str='<div class="grid-item item-box item-box-large item-box-slide">\
            <div class="content-box">';
                if (featured_pictures.length>0){
                    for (var i=0;i<featured_pictures.length;i++){
                        k1=i;
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
            <a class="content-box had-popup" data-toggle="modal" data-target="#event-form">\
            <img src="public/guest/images/img-event.jpg" />\
            </a>\
            </div>';
                break;
            case 'vega':
                str='<div class="grid-item item-box item-box-large item-box-slide">\
            <div class="content-box">';
                if (featured_pictures.length>0){
                    for (var i=featured_pictures.length-1;i>=0;i--){
                        // console.log(k1);
                        // if(i==k1)
                        //     continue;
                        // else
                            k2=i;
                        str+='<img src="/public/slide_pictures/'+featured_pictures[k2]+'" style="height:100%"/>'
                    }
                }

            // <img src="public/guest/images/img-vega.jpg" />\
                str+='\
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

<script>
    function drawGrid(){
        if (window.innerWidth>=1366){
            document.getElementById("container").innerHTML=(get_item('home_slide')+get_item('login')+get_item('walk')+
                get_item('run')+get_item('hidden')+get_item('eat')+get_item('event')+get_item('vega')+get_item('mou')+
                get_item('drink')+get_item('register')+get_item('blwomen')+get_item('clearfix'));
        }
        if (window.innerWidth<1366){
            document.getElementById("container").innerHTML=(get_item('home_slide')+get_item('login')+get_item('walk')+
                get_item('run')+get_item('eat')+get_item('event')+get_item('register')+
                get_item('drink')+get_item('mou')+get_item('blwomen')+get_item('vega')+get_item('clearfix'));

        }

        if(window.innerWidth<=480) {
            document.getElementById("container").innerHTML=(get_item('home_slide')+get_item('login')+get_item('walk')+
                get_item('run')+get_item('register')+get_item('event')+get_item('eat')+
                get_item('drink')+get_item('mou')+get_item('vega')+get_item('blwomen')+get_item('clearfix'));
        }
    }

    window.addEventListener('resize', function(event){
        drawGrid();
        var windowsize = jQuery(window).width();
        if (windowsize > 767) {
            $('.container-fluid-slide').masonry({
                itemSelector: '.grid-item',
                columnWidth: 215,
                "margin-left":4,
            });
        }
    });

    // jQuery('.container-fluid-slide').masonry({
    //     itemSelector: '.grid-item',
    //     columnWidth: 215,
    //     "margin-left":4,
    // });
    //
    // window.addEventListener('resize', function(event){
    //     drawGrid();
    //     var windowsize = jQuery(window).width();
    //     if (windowsize > 767) {
    //         $('.container-fluid-slide').masonry('bindResize');
    //     }
    // });




</script>