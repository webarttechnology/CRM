<link rel="stylesheet" href="{{ url('panel/assets/css/chat.css') }}">
<div class="app chat-wrapper">
    <div class="wrapper">
        <nav>
            <span class="close-chat-model"> <i class="feather-x icon"></i></span>
            <ul>
                <li><i class="feather-message-circle icon"></i> <span>chat</span></li>
            </ul>
        </nav>
        <div class="conversation-area">
            <div class="user-search-bar">
                <input type="text" placeholder="Search..." name="name" autocomplete="off" onkeyup="search_user({{ Auth::user()->id }}, this.value)">
            </div>
            <div id="user_list"></div>
        </div>

        <div class="main-chat-section" id="main-chat-section">
             <div class="blank_chat">
                 <div>Select one of the chats to start messaging.</div>
             </div>

        </div>   
    </div>
</div>

<script>
    var conn = new WebSocket('ws://127.0.0.1:8090//?token={{ auth()->user()->token }}');

    var from_user_id = "{{ Auth::user()->id }}";

    var to_user_id = "";

    conn.onopen = function(e) {

        console.log("Connection established!");

        load_list_user(from_user_id);

    };

    conn.onclose = function(event) {
        if (event.wasClean) {
            console.log(`Connection closed cleanly`);
        } else {
            console.error("Connection abruptly closed");
        }
    };


    conn.onmessage = function(e) {

        
        var data = JSON.parse(e.data);

        console.log(data);
    
        if (data.response_load_list_user || data.response_search_user) {
            var html = '';

            if (data.data.length > 0) {
                html ='';
                for (var count = 0; count < data.data.length; count++) {
                  html +=`<div class="msg" onclick="make_chat_area(` + data.data[count].id + `, '` + data.data[count].name + `'); load_chat_data(` + from_user_id + `, ` + data.data[count].id + `);">`;
                  html +=`<img class="msg-profile" src="{{ url('panel/assets/img/profiles/user-profile.png') }}" alt="profile-photo" />`;
                  html +=`<div class="msg-detail">`;
                  html +=``+ data.data[count].name+``;
                  if(from_user_id == ''){
                      html +=`<span class="user_unread_message chat-badge badge badge-primary rounded-pill" data-id="`+data.data[count].id+`" id="user_unread_message_`+data.data[count].id+`">`+data.data[count].unread_chat+`</span>`;
                  }
                  html +=`<div class="msg-content">`;
                  html +=`<span class="msg-message">`+data.data[count].last_message+`</span>`;
                  if(data.data[count].last_message){
                    html +=`<span class="msg-date">`+data.data[count].last_time+`</span>`;
                  }
                  html +=`</div>`;
                  html +=`</div>`;
                  html +=`</div>`;
                }
            } else {
                html = '<div class="msg">No User Found</div>';
            }
            document.getElementById('user_list').innerHTML = html;
            // check_unread_message();
        }

        if (data.message) {
            var html = '';

            if (data.from_user_id == from_user_id) {


                var icon_style = '';
    
                if(data.message_status == 'Not Send')
                {
                    icon_style = '<span id="chat_status_'+data.chat_message_id+'" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.5 12.5L10.167 17L19.5 8" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></g></svg></span>';
                }
                if(data.message_status == 'Send')
                {
                    icon_style = '<span id="chat_status_'+data.chat_message_id+'" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#000000"></path> </g></svg></span>';
                }
    
                if(data.message_status == 'Read')
                {
                    icon_style = '<span class="tick" id="chat_status_'+data.chat_message_id+'"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#34BBE5"/> </g></svg></span>';
                }

                html += `
                <div class="chat-msg owner">
                        <div class="chat-msg-profile">
                            <img class="chat-msg-img"  src="{{ url('panel/assets/img/profiles/user-profile.png') }}" alt />
                           <div class="chat-msg-date">`+data.time + icon_style +`</div>
                        </div>
                        <div class="chat-msg-content">
                            <div class="chat-msg-text">`+data.message+`</div>
                        </div>
                </div>
                `;
            } else {

                // console.log("Received msg1", to_user_id);
                // console.log("Received msg1", data.to_user_id);

                load_list_user(from_user_id);

                if (data.from_user_id == to_user_id) 
                {
                    //console.log("Received msg2", to_user_id);

                    html +=`
                    <div class="chat-msg">
                        <div class="chat-msg-profile">
                            <img class="chat-msg-img" src="{{ url('panel/assets/img/profiles/user-profile.png') }}" alt>
                            <div class="chat-msg-date">`+data.time+`</div>
                        </div>
                        <div class="chat-msg-content">
                            <div class="chat-msg-text">`+data.message+`</div>
                        </div>
                    </div>
                    `; 

                    update_message_status(data.chat_message_id, from_user_id, to_user_id, 'Read');

                }else{

                    var count_unread_message_element = document.getElementById('user_unread_message_'+data.from_user_id+'');
                    if(count_unread_message_element)
                    {
                        var count_unread_message = count_unread_message_element.textContent;
                        if(count_unread_message == '')
                        {
                            count_unread_message = parseInt(0) + 1;
                        }
                        else
                        {
                            count_unread_message = parseInt(count_unread_message) + 1;
                        }
                        count_unread_message_element.innerHTML = '<span class="badge bg-primary rounded-pill">'+count_unread_message+'</span>';
    
                        update_message_status(data.chat_message_id, data.from_user_id, data.to_user_id, 'Send');
                    }
                }

            }

            if (html != '') {

                var previous_chat_element = document.querySelector('#chat_history');

                var chat_history_element = document.querySelector('#chat_history');

                chat_history_element.innerHTML = previous_chat_element.innerHTML + html;

                scroll_top();
            }

        }

        if (data.chat_history) {
            var html = '';

            for (var index = 0; index < data.chat_history.length; index++) {
                html += `<div class="groupdate">`+data.chat_history[index].date+`</div>`;
                   for (let count = 0; count < data.chat_history[index].messages.length; count++) {
                    if (data.chat_history[index].messages[count].from_user_id == from_user_id) {

                        var icon_style = '';
    
                        if(data.chat_history[index].messages[count].message_status == 'Not Send')
                        {
                            icon_style = '<span id="chat_status_'+data.chat_history[index].messages[count].id+'" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.5 12.5L10.167 17L19.5 8" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></g></svg></i></span>';
                        }
        
                        if(data.chat_history[index].messages[count].message_status == 'Send')
                        {
                            icon_style = '<span id="chat_status_'+data.chat_history[index].messages[count].id+'" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#000000"></path> </g></svg></span>';
                        }
        
                        if(data.chat_history[index].messages[count].message_status == 'Read')
                        {
                            icon_style = '<span class="tick" id="chat_status_'+data.chat_history[index].messages[count].id+'"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#34BBE5"/> </g></svg></span>';
                        }



                        html += `<div class="chat-msg owner">
                                    <div class="chat-msg-profile">
                                        <img class="chat-msg-img"  src="{{ url('panel/assets/img/profiles/user-profile.png') }}" alt />
                                        <div class="chat-msg-date">`+data.chat_history[index].messages[count].time + icon_style +`</div>
                                    </div>
                                    <div class="chat-msg-content">
                                        <div class="chat-msg-text">`+data.chat_history[index].messages[count].chat_message+`</div>
                                    </div>
                                </div>`;

                        } else {

                        if(data.chat_history[index].messages[count].message_status != 'Read')
                        {
                            update_message_status(data.chat_history[index].messages[count].id, data.chat_history[index].messages[count].from_user_id, data.chat_history[index].messages[count].to_user_id, 'Read');
                        }

                        html += `
                            <div class="chat-msg">
                                <div class="chat-msg-profile">
                                    <img class="chat-msg-img" src="{{ url('panel/assets/img/profiles/user-profile.png') }}" alt>
                                    <div class="chat-msg-date">`+data.chat_history[index].messages[count].time+`</div>
                                </div>
                                <div class="chat-msg-content">
                                    <div class="chat-msg-text">`+data.chat_history[index].messages[count].chat_message+`</div>
                                </div>
                            </div>`;


                        var count_unread_message_element = document.getElementById('user_unread_message_'+data.chat_history[index].messages[count].from_user_id+'');
                        if(count_unread_message_element)
                        {
                            count_unread_message_element.innerHTML = '';
                        }

                        }  
                    
                   }

            }

           
            document.querySelector('#chat_history').innerHTML = html;

            scroll_top();
        }

        if(data.update_message_status)
        {
            
            if(data.unread_msg)
            { 
                var count_unread_message_element = document.getElementById('user_unread_message_'+data.from_user_id+'');
    
                if(count_unread_message_element)
                {
                    var count_unread_message = count_unread_message_element.textContent;
                    
                    if(count_unread_message == '')	
                    {
                        count_unread_message = parseInt(0) + 1;
                    }
                    else
                    {
                        count_unread_message = parseInt(count_unread_message) + 1;
                    }
    
                    count_unread_message_element.innerHTML = '<span class="badge bg-danger rounded-pill">'+count_unread_message+'</span>';
                }

            }
        }

    };



    function load_list_user(from_user_id) {
        var data = {
            from_user_id: from_user_id,
            type: 'request_load_list_user'
        };

        conn.send(JSON.stringify(data));
    }

    function search_user(from_user_id, search_query) {
        if (search_query.length > 0) {
            var data = {
                from_user_id: from_user_id,
                search_query: search_query,
                type: 'request_search_user'
            };

            conn.send(JSON.stringify(data));
        } else {
            load_list_user(from_user_id);
        }
    }

    function make_chat_area(user_id, to_user_name) {

        var html =`<div class="chat-area" id="chat-area">
                <div class="chat-area-header">
                    <div class="chat-area-title" id="chat-user-name">`+to_user_name+`</div>
                    <div class="chat-area-group">
                       
                    </div>
                </div>
                <div class="chat-area-main" id="chat_history">
                    
                </div>
                <div class="chat-area-footer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
                        <path d="M23 7l-7 5 7 5V7z" />
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <path d="M21 15l-5-5L5 21" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-plus-circle">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v8M8 12h8" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-paperclip">
                        <path
                            d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                    </svg>
                    <input type="text" placeholder="Type something here..."  onkeypress="sendMsgEnter(event)" id="message_area" />
                    <button type="button" class="btn btn-sm btn-success" id="send_button" onclick="send_chat_message()"><svg width="15px" height="15px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.1168 12.1484C19.474 12.3581 19.9336 12.2384 20.1432 11.8811C20.3528 11.5238 20.2331 11.0643 19.8758 10.8547L19.1168 12.1484ZM6.94331 4.13656L6.55624 4.77902L6.56378 4.78344L6.94331 4.13656ZM5.92408 4.1598L5.50816 3.5357L5.50816 3.5357L5.92408 4.1598ZM5.51031 5.09156L4.76841 5.20151C4.77575 5.25101 4.78802 5.29965 4.80505 5.34671L5.51031 5.09156ZM7.12405 11.7567C7.26496 12.1462 7.69495 12.3477 8.08446 12.2068C8.47397 12.0659 8.67549 11.6359 8.53458 11.2464L7.12405 11.7567ZM19.8758 12.1484C20.2331 11.9388 20.3528 11.4793 20.1432 11.122C19.9336 10.7648 19.474 10.6451 19.1168 10.8547L19.8758 12.1484ZM6.94331 18.8666L6.56375 18.2196L6.55627 18.2241L6.94331 18.8666ZM5.92408 18.8433L5.50815 19.4674H5.50815L5.92408 18.8433ZM5.51031 17.9116L4.80505 17.6564C4.78802 17.7035 4.77575 17.7521 4.76841 17.8016L5.51031 17.9116ZM8.53458 11.7567C8.67549 11.3672 8.47397 10.9372 8.08446 10.7963C7.69495 10.6554 7.26496 10.8569 7.12405 11.2464L8.53458 11.7567ZM19.4963 12.2516C19.9105 12.2516 20.2463 11.9158 20.2463 11.5016C20.2463 11.0873 19.9105 10.7516 19.4963 10.7516V12.2516ZM7.82931 10.7516C7.4151 10.7516 7.07931 11.0873 7.07931 11.5016C7.07931 11.9158 7.4151 12.2516 7.82931 12.2516V10.7516ZM19.8758 10.8547L7.32284 3.48968L6.56378 4.78344L19.1168 12.1484L19.8758 10.8547ZM7.33035 3.49414C6.76609 3.15419 6.05633 3.17038 5.50816 3.5357L6.34 4.78391C6.40506 4.74055 6.4893 4.73863 6.55627 4.77898L7.33035 3.49414ZM5.50816 3.5357C4.95998 3.90102 4.67184 4.54987 4.76841 5.20151L6.25221 4.98161C6.24075 4.90427 6.27494 4.82727 6.34 4.78391L5.50816 3.5357ZM4.80505 5.34671L7.12405 11.7567L8.53458 11.2464L6.21558 4.83641L4.80505 5.34671ZM19.1168 10.8547L6.56378 18.2197L7.32284 19.5134L19.8758 12.1484L19.1168 10.8547ZM6.55627 18.2241C6.4893 18.2645 6.40506 18.2626 6.34 18.2192L5.50815 19.4674C6.05633 19.8327 6.76609 19.8489 7.33035 19.509L6.55627 18.2241ZM6.34 18.2192C6.27494 18.1759 6.24075 18.0988 6.25221 18.0215L4.76841 17.8016C4.67184 18.4532 4.95998 19.1021 5.50815 19.4674L6.34 18.2192ZM6.21558 18.1667L8.53458 11.7567L7.12405 11.2464L4.80505 17.6564L6.21558 18.1667ZM19.4963 10.7516H7.82931V12.2516H19.4963V10.7516Z" fill="#000000"/></svg></button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-thumbs-up">
                        <path
                            d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" />
                    </svg>
                </div>
            </div>
            <div class="detail-area">
                <div class="detail-area-header">
                    <div class="msg-profile group">
                        <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M12 2l10 6.5v7L12 22 2 15.5v-7L12 2zM12 22v-6.5" />
                            <path d="M22 8.5l-10 7-10-7" />
                            <path d="M2 15.5l10-7 10 7M12 2v6.5" />
                        </svg>
                    </div>
                    <div class="detail-title" id="detail-title">`+to_user_name+`</div>
                    <div class="detail-subtitle"></div>
                    <div class="detail-buttons">
                        <button class="detail-button">
                            <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                            </svg>
                            Call Group
                        </button>
                        <button class="detail-button">
                            <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-video">
                                <path d="M23 7l-7 5 7 5V7z" />
                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
                            </svg>
                            Video Chat
                        </button>
                    </div>
                </div>
                <div class="detail-changes">
                    <input type="text" placeholder="Search in Conversation">
                    <div class="detail-change">
                        Change Color
                        <div class="colors">
                            <div class="color blue selected" data-color="blue"></div>
                            <div class="color purple" data-color="purple"></div>
                            <div class="color green" data-color="green"></div>
                            <div class="color orange" data-color="orange"></div>
                        </div>
                    </div>
                    <div class="detail-change">
                        Change Emoji
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-thumbs-up">
                            <path
                                d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" />
                        </svg>
                    </div>
                </div>
                <div class="detail-photos">
                    <div class="detail-photo-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-image">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <path d="M21 15l-5-5L5 21" />
                        </svg>
                        Shared photos
                    </div>
                    <div class="detail-photo-grid">
                        <img
                            src="https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2168&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1516085216930-c93a002a8b01?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2250&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1458819714733-e5ab3d536722?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=933&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1520013817300-1f4c1cb245ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2287&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2247&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1559181567-c3190ca9959b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1300&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1560393464-5c69a73c5770?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1301&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1506619216599-9d16d0903dfd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2249&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1481349518771-20055b2a7b24?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2309&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1473170611423-22489201d919?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2251&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1579613832111-ac7dfcc7723f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2250&q=80" />
                        <img
                            src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2189&q=80" />
                    </div>
                    <div class="view-more">View More</div>
                </div>
                <a href="https://twitter.com/AysnrTrkk" class="follow-me" target="_blank">
                    <span class="follow-text">
                        <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                            </path>
                        </svg>
                        Follow me on Twitter
                    </span>
                    <span class="developer">
                        <img src="https://pbs.twimg.com/profile_images/1253782473953157124/x56UURmt_400x400.jpg" />
                        Aysenur Turk — @AysnrTrkk
                    </span>
                </a>
            </div>`;

        document.getElementById('main-chat-section').innerHTML = html;

        var element = document.querySelector("#main-chat-section");

        element.style.backgroundColor = 'transparent';

        to_user_id = user_id;

        load_list_user(from_user_id);
        load_chat_data(from_user_id, to_user_id);

    }


    function send_chat_message() {

        document.querySelector('#send_button').disabled = true;

        var message = document.getElementById('message_area').value.trim()

        var data = {
            message: message,
            from_user_id: from_user_id,
            to_user_id: to_user_id,
            type: 'request_send_message'
        };

        conn.send(JSON.stringify(data));

        document.querySelector('#message_area').value = '';

        document.querySelector('#send_button').disabled = false;

        load_list_user(from_user_id);

        load_chat_data(from_user_id, to_user_id);

    }

   
    function sendMsgEnter(event) {
       // You can perform actions based on the keypress event here
        if (event.keyCode === 13) {
        event.preventDefault(); // Prevent the default behavior for Enter key
          send_chat_message()
        }
  }


    function load_chat_data(from_user_id, to_user_id) {
        
        var data = {
            from_user_id: from_user_id,
            to_user_id: to_user_id,
            type: 'request_chat_history'
        };

        conn.send(JSON.stringify(data));

    }


    function update_message_status(chat_message_id, from_user_id, to_user_id, chat_message_status)
    {
        var data = {
            chat_message_id : chat_message_id,
            from_user_id : from_user_id,
            to_user_id : to_user_id,
            chat_message_status : chat_message_status,
            type : 'update_chat_status'
        };
    
        conn.send(JSON.stringify(data));

    }

    function check_unread_message()
    {
        var unread_element = document.getElementsByClassName('user_unread_message');
    
        for(var count = 0; count < unread_element.length; count++)
        {
            var temp_user_id = unread_element[count].dataset.id;
    
            var data = {
                from_user_id : from_user_id,
                to_user_id : to_user_id,
                type : 'check_unread_message'
            };
    
            conn.send(JSON.stringify(data));

            load_list_user(from_user_id);

        }

    }


    function scroll_top() {
        document.querySelector('#chat-area').scrollTop = document.querySelector('#chat-area').scrollHeight;
    }

    $(document).on("click", ".close-chat-model", function(e) {
            e.preventDefault();
            $('.chat-box').html('');
            $('#fullWidthModal').modal('hide');
            conn.close();
    });

</script>
