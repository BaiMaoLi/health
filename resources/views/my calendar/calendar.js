
function get_days(year, month,options){
    var day_number;
    switch(options)    {
        case 'prev':
            if (month>0){
                day_number=get_days(year,month-1,'current');
            }
            else{
                day_number=get_days(year-1,11,'current');
            }
            break;
        case 'current':
            if(month<11){
                day_number=new Date(year,month+1,0).getDate();
            }
            else{
                day_number=new Date(year+1,0,0).getDate();
            }
            break;
        case 'next':
            if (month<11){
                day_number=get_days(year,month+1,'current');
            }
            else{
                day_number=get_days(year+1,0,'current');
            }
            break;
        default:
            day_number=get_days(year,month,'current');
    }
    return day_number;
}

var prev_month;
var next_month;
function create_calendar(year, month,id){
    document.getElementById(id).innerHTML="";
    var months=['January','February','March','April','May','June','July','August','September','October','November','December'];
    var weeks=['S','M','T','W','T','F','S'];
    var date=new Date(year,month);
    var calendar_table=document.createElement("table");
    calendar_table.className=id+"-"+"calendar-table";
    var month_display_bar=document.createElement('div');
    month_display_bar.className=id+"-"+'month-display-bar'+' row justify-content-center';

    prev_month=document.createElement("h4");
    prev_month.className=id+"-"+"prev-month";
    if(month>0){
        txt_node=document.createTextNode(months[month-1]);
    }
    else{
        txt_node=document.createTextNode(months[11]);
    }
    prev_month.appendChild(txt_node);
    current_month=document.createElement("h4");
    current_month.className=id+"-"+"current-month";

    txt_node=document.createTextNode(months[month]);
    current_month.appendChild(txt_node);
    next_month=document.createElement("h4");
    next_month.className=id+"-"+"next-month";
    if(month<11){
        txt_node=document.createTextNode(months[month+1]);
        next_month.appendChild(txt_node);
    }
    else{
        txt_node=document.createTextNode(months[0]);
        next_month.appendChild(txt_node);
    }
    next_month.appendChild(txt_node);


    month_display_bar.appendChild(prev_month);
    month_display_bar.appendChild(current_month);
    month_display_bar.appendChild(next_month);




    document.getElementById(id).appendChild(month_display_bar);
    prev_month.addEventListener('click',function(){
        if(month>0){
            create_calendar(year, month-1,id);
            getMonthEvents(month-1);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[month-1].toUpperCase());
            }
        }
        else{
            create_calendar(year-1, 11,id);
            getMonthEvents(11);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[11].toUpperCase());
            }
        }
    });

    next_month.addEventListener('click',function(){
        if(month<11){
            create_calendar(year, month+1,id);
            getMonthEvents(month+1);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[month+1].toUpperCase());
            }
        }
        else{
            create_calendar(year+1, 0,id);
            getMonthEvents(0);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[0].toUpperCase());
            }
        }
    });

    current_month.addEventListener('click',function(){    //When click current month
        if($('#events_list_in_calendar').length){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            }),

                $.ajax({
                    // url: APP_URL+"/get_all_event",
                    url: APP_URL+"/getMonthEvents",
                    method: 'get',
                    async:false,
                    data: {
                        _token : $('meta[name="csrf-token"]').attr('content'),
                        month:month+1,

                    },
                    success: function(result){

                        console.log(result);
                        var months=['January','February','March','April','May','June','July','August','September','October','November','December'];

                        var html='';
                        var n=result['event'].length;
                        for (var i=0;i<n;i++){
                            var event=result['event'][i];
                            var date=new Date(event['event_date']+" "+event['event_time']);
                            var date_options = {month: 'long', day: 'numeric' };
                            html+='<div class="comming-event-house">\
                         <div class="row">';
                            if(event['featured_picture']!=null){
                                html+='<img src="'+event['featured_picture']+'" class="comming-event-picture">'
                            }
                            else
                            {
                                html+='<img src="{{url(\'public/event_pictures/event_default.jpg\')}}" class="comming-event-picture">'
                            }
                            html+='<div class="comming-event-detail">\
                        <h4 class="comming-event-category">'+event['tag_name'].toUpperCase()+'</h4>\
                        <a href=\'single_event/'+event['id']+'\'><h4 class="comming-event-title">'+
                                event['event_title'].toUpperCase()+'</h4></a>\
                         <h4 class="comming-event-time">'+date.toLocaleDateString('en',date_options)+', at '+event['event_time'].toLowerCase()+'</h4>\
                         <h4 class="comming-event-location">'+event['event_location']+'</h4></div></div></div>\
                         <div class="line"></div>';
                        }
                        $('#events_list_in_calendar').html(html);
                        // console.log(html);



                    }
                });
        }
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        url: APP_URL+"/get_event_date",
        method: 'post',
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'),
            year:year,
            month:month+1
        },
        success: function(result){
            var registered_date=result['registered_date'];
            week_display_bar=document.createElement("thead");
            week_display_bar.className=id+"-"+"week-display-bar";
            for(i=0;i<7;i++){
                th=document.createElement("th");
                text_node=document.createTextNode(weeks[i]);
                th.appendChild(text_node);
                week_display_bar.appendChild(th);
            }
            calendar_table.appendChild(week_display_bar);
            document.getElementById(id).appendChild(calendar_table);
            var day_number,prev_day_number,next_day_number;
            day_number=get_days(year,month,'current');
            prev_day_number=get_days(year,month,'prev');

            date.setDate(1);
            first_day=date.getDay();
            tr=document.createElement('tr');
            calendar_table.appendChild(tr);

            for (i=0;i<6;i++){
                tr=document.createElement('tr');
                for (j=0;j<7;j++){
                    var date_content=document.createElement('input');
                    date_content.setAttribute('type','text');
                    date_content.readOnly=true;

                    td=document.createElement('td');
                    if (i==0){
                        if(j<first_day)
                        {
                            date_content.className=id+"-"+'prev-month-days date_content';
                            date_content.value=(prev_day_number-first_day+1+j).toString();
                            td.appendChild(date_content);
                            tr.appendChild(td);
                        }
                        else{
                            aa=get_event(j-first_day+1,month,result);
                            if(aa===true){
                                if (!check_registered(j-first_day+1,registered_date))
                                    date_content.className=id+"-"+'event-days date_content';  //Unregistered Event Date
                                else
                                    date_content.className=id+"-"+'event-days date_content date_registered';  //Registered Event Date
                                date_content.onclick=event_date_click(j-first_day+1,month);
                                }
                            else
                                date_content.className=id+"-"+'current-days date_content';
                            date_content.value=(j-first_day+1).toString();
                            td.appendChild(date_content);
                            tr.appendChild(td);
                        }
                    }
                    else{
                        day=i*7+j-first_day+1;
                        if (day<=day_number){
                            aa=get_event(day,month,result);
                            if(aa===true) {
                                if (!check_registered(day,registered_date)){
                                    date_content.className = id + "-" + 'event-days date_content';
                                }
                                else{
                                    date_content.className = id + "-" + 'event-days date_content date_registered';
                                }

                                date_content.onclick=event_date_click(day,month);
                            }
                            else
                                date_content.className=id+"-"+'current-days date_content';
                            date_content.value=day.toString();
                            td.appendChild(date_content);
                            tr.appendChild(td);
                        }
                        else{
                            date_content.className=id+"-"+'next-month-days date_content';
                            date_content.value=((day-day_number).toString());
                            td.appendChild(date_content);
                            tr.appendChild(td);

                        }
                    }
                }
                calendar_table.appendChild(tr);
            }
        },
        error:function (evt) {
            console.error(evt);

        }
    });
    document.getElementsByClassName("date_content").readOnly = true;
}


function get_event(target_date,tagert_month,result){
    months=result['months'];
    dates=result['dates'];
    if (months.length>=1){
        for(k=0;k<months.length;k++){
            if(Number(dates[k])==target_date && Number(months[k])==(tagert_month+1)){
                return true;
            }
        }
        return false;
    }
    return false;
}

function check_registered(date,registered_date) {
    for (var i=0;i<registered_date.length;i++){
        if (date==Number(registered_date[i]))
        {
            return true;
        }
    }
    return false;
}




//Showing one event when click event date in calendar page
function event_date_click(day1,month) {
    return function(){
        if($('#events_list_in_calendar').length){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            }),

            $.ajax({
                url: APP_URL+"/get_single_event",
                method: 'get',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    month:month+1,
                    date:day1
                },
                success: function(result){
                    var months=['January','February','March','April','May','June','July','August','September','October','November','December'];

                    var html='';
                    var n=result['event'].length;
                    for (var i=0;i<n;i++){
                        var event=result['event'][i];
                        var date=new Date(event['event_date']+" "+event['event_time']);
                        var date_options = {month: 'long', day: 'numeric' };
                        html+='<div class="comming-event-house">\
                         <div class="row">';
                        if(event['featured_picture']!=null){
                            html+='<img src="../public/event_pictures/'+event['featured_picture']+'" class="comming-event-picture">'
                        }
                        else
                        {
                            html+='<img src="public/event_pictures/event_default.jpg" class="comming-event-picture">'
                        }
                        html+='<div class="comming-event-detail">\
                        <h4 class="comming-event-category">'+event['tag_name'].toUpperCase()+'</h4>\
                        <a href=\'single_event/'+event['id']+'\'><h4 class="comming-event-title">'+
                                event['event_title'].toUpperCase()+'</h4></a>\
                         <h4 class="comming-event-time">'+date.toLocaleDateString('en',date_options)+', at '+event['event_time'].toLowerCase()+'</h4>\
                         <h4 class="comming-event-location">'+event['event_location']+'</h4></div></div></div>\
                         <div class="line"></div>';
                    }
                    $('#events_list_in_calendar').html(html);
                }});
        }
        else{
            window.location.href=APP_URL+'/calendar/'+(month+1).toString();
        }
    }
}


function getMonthEvents(month) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    }),
        $.ajax({
            url: APP_URL + "/getMonthEvents",
            method: 'get',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                month:month+1,
            },
            success: function (event_months) {
                showMonthEvents(event_months);
            },
            error:function (evt) {
                console.error(evt);

            }
        });
}



$(document).ready(function(){
    var months=['January','February','March','April','May','June','July','August','September','October','November','December'];
    $('#prev').unbind('click').bind('click',function () {
        var this_month=$('#this-month').text();
        var month=getThisMonth(this_month);
        // if (month==0){
        //     month=11;
        // }
        // else
        //     month--;
        // getMonthEvents(month);
        var date=new Date();
        var year=date.getFullYear();
        // create_calendar(year,month,'calendar');
        // //$('#this-month').text('&nbsp;'+months[month].toUpperCase()+'&nbsp');
        // $('#this-month').html('&nbsp&nbsp'+months[month].toUpperCase());

        if(month>0){
            create_calendar(year, month-1,'calendar');
            getMonthEvents(month-1);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[month-1].toUpperCase());
            }
        }
        else{
            create_calendar(year-1, 11,'calendar');
            getMonthEvents(11);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[11].toUpperCase());
            }
        }

    });

    // $('#next').click(function () {
    $('#next').unbind('click').bind('click',function () {
        var this_month=$('#this-month').text();
        var month=getThisMonth(this_month);
        // console.log(month);
        // if (month==11){
        //     month=0;
        // }
        // else
        //     month++;
        // getMonthEvents(month);
        var date=new Date();
        var year=date.getFullYear();
        // create_calendar(year,month,'calendar');
        // $('#this-month').text('&nbsp;'+months[month].toUpperCase()+'&nbsp');
        // $('#this-month').html('&nbsp&nbsp'+months[month].toUpperCase());
        // next_month.click();
        console.log(month);

        if(month<11){
            create_calendar(year, month+1,'calendar');
            getMonthEvents(month+1);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[month+1].toUpperCase());
            }
        }
        else{
            create_calendar(year+1, 0,'calendar');
            getMonthEvents(0);
            if($('#this-month').length){
                $('#this-month').html('&nbsp&nbsp'+months[0].toUpperCase());
            }
        }
    });

    function getThisMonth(this_month) {
        for (i=0;i<12;i++){
            var this_month = this_month.replace(/\s/g, '');
            var is_equl=months[i].toLowerCase().localeCompare(this_month.toLowerCase());
            if (is_equl==0){
                return i;
            }
        }
        return i-1;
    }
});
//
