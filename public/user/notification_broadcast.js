
var i=0;
// var myvar;
var notification_number;
var click_number=0;
var prev_id='';
var current_id='';
var unread_messages=[];
var show_length=5;

$(document).ready(function() {
    var date=new Date();
    var calendar=$('#calendar');
    if(calendar.length)
        create_calendar(date.getFullYear(),date.getMonth(),'calendar');
    var month=date.getMonth(month);
    getMonthEvents(month);
    readMessage();
    myvar=setInterval(readMessage, 2000);

});


function readMessage() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    }),

        $.ajax({
            // url: APP_URL+"/get_all_event",
            url: APP_URL+"/notifications",
            method: 'get',
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'),
            },

            success:function (data) {
                // console.log(data);
                if(data.length){
                    notification_number=data.length;
                    // $("#badge1").css("display", "show");
                    $("#badge1").show();
                    document.getElementById('badge1').innerText =data.length;
                    if($('#AllAlerts').length)   /* If current page is All Alert Page */
                    {

                        addNotifications(data, "#AllAlerts");
                    }
                    if($('.MY-ALERTS').length)   /* If current page is Home Page */
                        displaySingleAlert(data);
                }
                else
                    $('#badge1').css("display", "none");
            }
    })
}


const NOTIFICATION_TYPES = {
    EventAlert: 'App\\Notifications\\EventAlert',
    User_Alert: 'App\\Notifications\\UserAlert'
};


function addNotifications(notifications,target) {
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        $(target).empty();
        // var htmlElements = notifications.map(function (notification) {
        //     $(target).append(makeNotificationText(notification));
        // });
        for (var i=0;i<show_length;i++){
            if (notifications.length==i) break;
            else{
                $(target).append(makeNotificationText(notifications[i]));
            }
        }
        var all_alert_house=document.createElement('div');
        all_alert_house.className='all-alert-house alert-more';
        var readmore_btn=document.createElement('button');
        var readmore_i=document.createElement('i');
        readmore_i.className='fa fa-angle-down';
        readmore_btn.appendChild(readmore_i);
        readmore_btn.className='readmore_btn';
        if (notifications.length>show_length){
            // $('.readmore_btn').show();
            all_alert_house.appendChild(readmore_btn);
        }
        // all_alert_house.appendChild(readmore_btn);

        readmore_btn.addEventListener('click',function () {
            show_length=show_length+5;
            readMessage();
        })
        $(target).append($(all_alert_house));
    } else {
        $(target).html('<li class="dropdown-header">No notifications</li>');
    }
}

function makeNotificationText(notification) {
    if(notification.type === NOTIFICATION_TYPES.EventAlert) {
        var all_alert_house = document.createElement('div');
        all_alert_house.className = "all-alert-house event-alert";
        var close_btn = document.createElement('button');
        close_btn.className = 'close_alert';
        var itag = document.createElement('i');
        itag.className = 'fa fa-close';
        close_btn.appendChild(itag);
        var alert_title = document.createElement('h4');
        if (!notification.read_at)
            alert_title.className = 'alert-title alert-unread';
        else alert_title.className = 'alert-title';
        text_node = document.createTextNode(notification.data.EventAlert_title);
        alert_title.appendChild(text_node);
        var event_time = document.createElement('h4');
        event_time.className = 'event-time break';
        text_node = document.createTextNode(notification.data.EventAlert_time);
        event_time.appendChild(text_node);
        event_time.id = notification['id'];
        var event_location = document.createElement('h4');
        event_location.className = 'event-location';
        text_node = document.createTextNode(notification.data.EventAlert_location);
        event_location.appendChild(text_node);
        var line = document.createElement('div');
        line.className = 'line';
        all_alert_house.appendChild(close_btn);
        all_alert_house.appendChild(alert_title);
        all_alert_house.appendChild(event_time);
        all_alert_house.appendChild(event_location);
        all_alert_house.appendChild(line);
        alert_title.onclick = notyRead(notification['id']);
        close_btn.addEventListener('click', function () {
            var parent = $(this).parent();
            var id = $(parent).children(':nth-child(3)');
            var noty_id = id.attr('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            }),
                $.ajax({
                    url: APP_URL + "/notyRemove",
                    method: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: noty_id
                    },
                    success: function (msg) {
                        // console.log(msg);
                        parent.remove();
                        readMessage();
                    }
                });

        });
        return all_alert_house;
    }

    else if(notification.type === NOTIFICATION_TYPES.User_Alert) {
        var all_alert_house=document.createElement('div');
        all_alert_house.className="all-alert-house message-unread";
        var close_btn = document.createElement('button');
        close_btn.className = 'close_alert';
        var itag = document.createElement('i');
        itag.className = 'fa fa-close';
        close_btn.appendChild(itag);


        var alert_title=document.createElement('h4');
        if (!notification.read_at)
            alert_title.className='alert-title alert-unread';
        else alert_title.className='alert-title';

        text_node=document.createTextNode(notification.data.alert_title);
        alert_title.appendChild(text_node);
        var event_time=document.createElement('h4');
        event_time.className='event-time break';
        event_time.id=notification['id'];
        if (notification.data.alert_body!=null){
            text_node=document.createTextNode(notification.data.alert_body);
            event_time.appendChild(text_node);
        }

        var line=document.createElement('div');
        line.className='line';
        all_alert_house.appendChild(close_btn);
        all_alert_house.appendChild(alert_title);
        all_alert_house.appendChild(event_time);
        all_alert_house.appendChild(line);
        alert_title.onclick=notyRead(notification['id']);
        close_btn.addEventListener('click', function () {
            var parent = $(this).parent();
            var id = $(parent).children(':nth-child(3)');
            var noty_id = id.attr('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            }),
                $.ajax({
                    url: APP_URL + "/notyRemove",
                    method: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: noty_id
                    },
                    success: function (msg) {
                        // console.log(msg);
                        parent.remove();
                        readMessage();
                    }
                });

        });
        return all_alert_house;
    }
}

function notyRead(id) {
    return function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        }),
            $.ajax({
                url: APP_URL + "/notyRead",
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id
                },
                success:function(result){
                    window.clearInterval(myvar);
                    var clickable=true;
                    for (var i=0;i<unread_messages.length;i++){
                        if (id==unread_messages[i])
                            clickable=false;
                    }
                    if (clickable==true){
                        notification_number=notification_number-1;
                        // document.getElementById('badge1').innerText =notification_number;
                        unread_messages.push(id);
                    }
                    var current_alert=$('#'+id);
                    // var title=current_alert.parent().children(':first-child');
                    // var title=current_alert.parent().children(':second-child');
                    var title=current_alert.parent().children().eq(1);
                    title.css('font-weight','normal');

                    // console.log(title);

                    // document.getElementById(id).classList.toggle('break');
                    current_alert.toggleClass('break');

                    if (title.hasClass('alert-unread')){
                        $(title).removeClass('alert-unread');
                    }
                },
                error: function (evt) {
                    console.log(evt);
                }
            });
    }
}

//Display Single Event in User HomePage
function displaySingleAlert(data) {
    if(i>=data.length){
        i=0;
    }

    var notification=data[i];

    var str='';
    html='';
    if(notification.type === NOTIFICATION_TYPES.EventAlert) {

        if (!notification.read_at)
            str+='<h4 id="alert-title" style="font-weight:bold">'+notification.data.EventAlert_title+'</h4>';
        else
            str+='<h4 id="alert-title">'+notification.data.EventAlert_title+'</h4>';
        str+='<h6 id="alert-content">'+notification.data.EventAlert_time+'</h6>\
        <h6 id="alert-place">'+notification.data.EventAlert_location+'</h6>\
        </div>';
    }
    else{
        if (!notification.read_at)
            str+='<h4 id="alert-title" style="font-weight:bold">'+notification.data.alert_title+'</h4>';
        else
            str+='<h4 id="alert-title">'+notification.data.alert_title+'</h4>';
        if (notification.data.alert_body!=null){
            str+='<h6 id="alert-place" >'+notification.data.alert_body+'</h6>';
        }
        else
            str+='<h6 id="alert-place"></h6>';
        str+='</div>';

    }
    $('#My-alert').html(str);
    i++;
}

$('#clear-alerts').on('click',function () {
    window.clearInterval(myvar);
    document.getElementById('badge1').innerText = '';
    $("#badge1").css("display", "none");
    document.getElementById('AllAlerts').innerHTML='';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    }),

    $.ajax({
        url: APP_URL + "/notyRemoveAll",
        method: 'get',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (msg) {
            myvar=setInterval(readMessage, 5000);
        }
    });
})



