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
                <input type="text" placeholder="Search..." name="name" autocomplete="off"
                    onkeyup="search_user({{ Auth::user()->id }}, this.value)">
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
    var conn = new WebSocket('ws://127.0.0.1:9090//?token={{ auth()->user()->token }}');

    var from_user_id = "{{ Auth::user()->id }}";

    var to_user_id = "";
    var to_group_id = "";
    var to_type = "";

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
                html = '';

                var icon_style = '';


                for (var count = 0; count < data.data.length; count++) {

                    if (data.data[count].message_status == 'Not Send') {
                        icon_style = '<span id="user_chat_status_' + data.data[count].chat_message_id +
                            '" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.5 12.5L10.167 17L19.5 8" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></g></svg></span>';
                    }
                    if (data.data[count].message_status == 'Send') {
                        icon_style = '<span id="user_chat_status_' + data.data[count].chat_message_id +
                            '" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#000000"></path> </g></svg></span>';
                    }

                    if (data.data[count].message_status == 'Read') {
                        icon_style = '<span class="tick" id="user_chat_status_' + data.data[count].chat_message_id +
                            '"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#34BBE5"/> </g></svg></span>';
                    }

                    if (data.data[count].type == 'user') {
                        if (data.data[count].user_image) {
                            UserImg = data.data[count].user_image;
                        } else {
                            UserImg = "{{ url('panel/assets/img/profiles/user-profile.png') }}";
                        }
                    } else {
                        UserImg = "{{ url('panel/assets/img/profiles/multiple-users.png') }}";
                    }

                    if(data.data[count].user_status == 'Online'){
                            var online_status = 'online';
                    }else{
                           var online_status = '';
                    }

                    html += `<div class="msg `+online_status+`" onclick="make_chat_area(` + data.data[count].id + `, '` + data.data[
                            count].name + `', '` + data.data[count].type + `', '` + UserImg +
                        `', '`+online_status+`'); load_chat_data(` + from_user_id + `, ` + data.data[count].id + `, '` + data.data[count]
                        .type + `'); GroupMemberData()">`;
                    if (data.data[count].type == 'user') {
                        if (data.data[count].user_image) {
                            html += `<img class="msg-profile" src="` + data.data[count].user_image +
                                `" alt="profile-photo" />`;
                        } else {
                            html +=
                                `<img class="msg-profile" src="{{ url('panel/assets/img/profiles/user-profile.png') }}" alt="profile-photo" />`;
                        }
                    } else {
                        html +=
                            `<img class="msg-profile" src="{{ url('panel/assets/img/profiles/multiple-users.png') }}" alt="profile-photo" />`;
                    }
                    html += `<div class="msg-detail">`;
                    html += `` + data.data[count].name + ``;
                    if (data.data[count].unread_chat > 0) {
                        html += `<span class="chat-badge badge badge-primary rounded-pill">` + data.data[count]
                            .unread_chat + `</span>`;
                    }
                    html += `<div class="msg-content">`;
                    html += `<span class="msg-message">` + data.data[count].last_message + `</span>`;
                    if (data.data[count].last_message) {
                        html += `<span class="msg-date">` + data.data[count].last_time + icon_style + `</span>`;
                    }
                    html += `</div>`;
                    html += `</div>`;
                    html += `</div>`;
                }
            } else {
                html = '<div class="msg">No User Found</div>';
            }
            document.getElementById('user_list').innerHTML = html;
        }

        if (data.message) {
            var html = '';

            if (data.from_user_id == from_user_id) {

                var icon_style = '';

                if (data.message_status == 'Not Send') {
                    icon_style = '<span id="chat_status_' + data.chat_message_id +
                        '" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.5 12.5L10.167 17L19.5 8" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></g></svg></span>';
                }
                if (data.message_status == 'Send') {
                    icon_style = '<span id="chat_status_' + data.chat_message_id +
                        '" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#000000"></path> </g></svg></span>';
                }

                if (data.message_status == 'Read') {
                    icon_style = '<span class="tick" id="chat_status_' + data.chat_message_id +
                        '"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#34BBE5"/> </g></svg></span>';
                }

                if (data.from_user_photo) {
                    var form_user_photo = data.from_user_photo;
                } else {
                    var form_user_photo = "{{ url('panel/assets/img/profiles/user-profile.png') }}";
                }

                html += `
                <div class="chat-msg owner">
                        <div class="chat-msg-profile">
                            <img class="chat-msg-img"  src="`+form_user_photo+`" alt />
                           <div class="chat-msg-date">` + data.time + icon_style + `</div>
                        </div>
                        <div class="chat-msg-content">
                            <div class="chat-msg-text">` + data.message + `</div>
                        </div>
                </div>
                `;
            } else {

                load_list_user(from_user_id);

                var elementChatEmpty = document.getElementById("chat-msg-empty");
                
                if(elementChatEmpty){
                    elementChatEmpty.style.display = "none";
                }
                
                if (data.from_user_id == to_user_id) {

                       if (data.from_user_photo) {
                            var to_user_img = data.from_user_photo;
                        } else {
                            var to_user_img = "{{ url('panel/assets/img/profiles/user-profile.png') }}";
                        }

                    html += `
                    <div class="chat-msg">
                        <div class="chat-msg-profile">
                            <img class="chat-msg-img" src="`+to_user_img+`" alt>
                            <div class="chat-msg-date">` + data.time + `</div>
                        </div>
                        <div class="chat-msg-content">
                            <div class="chat-msg-text">` + data.message + `</div>
                        </div>
                    </div>
                    `;

                    update_message_status(data.chat_message_id, from_user_id, to_user_id, 'Read');

                } else {

                    update_message_status(data.chat_message_id, data.from_user_id, data.to_user_id, 'Send');

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
                html += `<div class="groupdate">` + data.chat_history[index].date + `</div>`;
                for (let count = 0; count < data.chat_history[index].messages.length; count++) {
                    if (data.chat_history[index].messages[count].from_user_id == from_user_id) {

                        var icon_style = '';

                        if (data.chat_history[index].messages[count].message_status == 'Not Send') {
                            icon_style = '<span id="chat_status_' + data.chat_history[index].messages[count].id +
                                '" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.5 12.5L10.167 17L19.5 8" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></g></svg></i></span>';
                        }

                        if (data.chat_history[index].messages[count].message_status == 'Send') {
                            icon_style = '<span id="chat_status_' + data.chat_history[index].messages[count].id +
                                '" class="tick"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#000000"></path> </g></svg></span>';
                        }

                        if (data.chat_history[index].messages[count].message_status == 'Read') {
                            icon_style = '<span class="tick" id="chat_status_' + data.chat_history[index].messages[
                                    count].id +
                                '"><svg width="16px" height="16px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#34BBE5"/> </g></svg></span>';
                        }

                        if (to_type == 'group') {
                            if (data.chat_history[index].messages[count].from_user_id != from_user_id) {
                                var user_name = data.chat_history[index].messages[count].user_name;
                            } else {
                                var user_name = '';
                            }
                        } else {
                            var user_name = '';
                        }

                        if (data.chat_history[index].messages[count].from_user_photo) {
                            var form_user_photo = data.chat_history[index].messages[count].from_user_photo;
                        } else {
                            var form_user_photo = "{{ url('panel/assets/img/profiles/user-profile.png') }}";
                        }


                        html += `<div class="chat-msg owner">
                                    <div class="chat-msg-profile">
                                        <img class="chat-msg-img"  src=" ` + form_user_photo + `" alt />
                                        <div class="chat-msg-date">` + data.chat_history[index].messages[count].time +
                            icon_style + `</div>
                                    </div>
                                    <div class="chat-msg-content">
                                        <div class="chat-msg-text">
                                            <div class="group_user_name">` + user_name + `</div>
                                            ` + data.chat_history[index].messages[count].chat_message + `
                                        </div>
                                    </div>
                                </div>`;

                    } else {

                        if (data.chat_history[index].messages[count].message_status != 'Read') {
                            update_message_status(data.chat_history[index].messages[count].id, data.chat_history[
                                index].messages[count].from_user_id, data.chat_history[index].messages[
                                count].to_user_id, 'Read');
                        }

                        if (to_type == 'group') {
                            if (data.chat_history[index].messages[count].from_user_id != from_user_id) {
                                var user_name = data.chat_history[index].messages[count].user_name;
                            } else {
                                var user_name = '';
                            }
                        } else {
                            var user_name = '';
                        }

                        if (data.chat_history[index].messages[count].from_user_photo) {
                            var to_user_img = data.chat_history[index].messages[count].from_user_photo;
                        } else {
                            var to_user_img = "{{ url('panel/assets/img/profiles/user-profile.png') }}";
                        }


                        html += `
                            <div class="chat-msg">
                                <div class="chat-msg-profile">
                                    <img class="chat-msg-img" src="` + to_user_img + `" alt>
                                    <div class="chat-msg-date">` + data.chat_history[index].messages[count].time + `</div>
                                </div>
                                <div class="chat-msg-content">
                                    <div class="chat-msg-text">
                                        <div class="group_user_name">` + user_name + `</div>
                                        ` + data.chat_history[index].messages[count].chat_message + `
                                    </div>
                                </div>
                            </div>`;
                    }
                }
            }

            if(data.chat_history == ''){
                html += `<div class="chat-msg-empty" id="chat-msg-empty">
                            Type something, send a file, make a call or select one of the canned messages.
                        </div>`; 
            }

            document.querySelector('#chat_history').innerHTML = html;

            hideLoading();

            scroll_top();
        }

        if (data.group_member_history) {

            if (to_type == 'group') {

                var group_user = '';

                for (var index = 0; index < data.group_member_history.length; index++) {
                    if (data.group_member_history[index].img) {
                        var group_image_user = data.group_member_history[index].img;
                    } else {
                        var group_image_user = "{{ url('panel/assets/img/profiles/user-profile.png') }}";
                    }
                    group_user +=` <div class="msg">
                    <img class="msg-profile" src="`+group_image_user+`" alt="profile-photo">
                    <div class="msg-detail">`+data.group_member_history[index].name+`</div>
                    </div>`;
                }

            } else {
                var group_user = '';
            }

            $('#group_user_list').html(group_user);
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

    function make_chat_area(user_id, to_user_name, type, UserImg, online_status) {

        if(type == 'group'){

            var TabElement = `<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-group-member-tab" data-bs-toggle="tab" data-bs-target="#nav-group-member" type="button" role="tab" aria-controls="nav-group-member" aria-selected="true">Group Member</button>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                     
                    <div class="tab-pane fade show active" id="nav-group-member" role="tabpanel" aria-labelledby="nav-group-member-tab">
                         <div id="loading">
                            <div id="loading-content"></div>
                         </div>    
                        <div id="group_user_list">
                                    
                           </div>
                    </div>
                    </div>`;

            var online_status_check = '';

        }else{
            var TabElement = '';
            if(online_status){
                var online_status_check = online_status;
            }else{
                var online_status_check = 'Offline';

            }
        }


        var html = `<div class="chat-area" id="chat-area">
                <div id="loading">
                    <div id="loading-content"></div>
                </div>
                <div class="chat-area-header">
                    <div class="chat-area-title" id="chat-user-name">` + to_user_name + ` <span class="online-offline">`+online_status_check+`</span></div>
                    <div class="chat-area-group">
                   </div>
                </div>
                <div class="chat-area-main" id="chat_history">
                    
                </div>
                <div class="chat-area-footer">
                    <a href="javascript:void(0)" title="File Choose" onClick="ChooseFile()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                          <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                       </svg>
                    </a>

                    <a href="https://www.sendgb.com/" title="SendGB" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                          <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                       </svg>
                    </a>

                    <a href="https://wetransfer.com/" title="We Transfer" target="_blank"  style="margin-left: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="30px" height="30px"><g fill="#c1c7cd" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M12,4c-2.33449,0 -4.29939,1.2495 -5.57031,3.01367c-3.54423,0.04022 -6.42969,2.93293 -6.42969,6.48633c0,3.57827 2.92173,6.5 6.5,6.5h12c3.02558,0 5.5,-2.47442 5.5,-5.5c0,-2.99036 -2.42297,-5.4238 -5.40039,-5.48047c-0.86967,-2.87796 -3.44751,-5.01953 -6.59961,-5.01953zM12,6c2.50453,0 4.55398,1.82549 4.93164,4.21484l0.15234,0.96094l0.96484,-0.125c0.22335,-0.02908 0.36607,-0.05078 0.45117,-0.05078c1.94442,0 3.5,1.55558 3.5,3.5c0,1.94442 -1.55558,3.5 -3.5,3.5h-5.5v-4h3l-4,-4l-4,4h3v4h-4.5c-2.49773,0 -4.5,-2.00227 -4.5,-4.5c0,-2.49773 2.00227,-4.5 4.5,-4.5c0.03499,0 0.11646,0.00699 0.25,0.01367l0.61133,0.03125l0.30469,-0.53125c0.86409,-1.50132 2.47187,-2.51367 4.33398,-2.51367z"></path></g></g></svg>
                    </a>
                    <input type="text" placeholder="Type something here..."  onkeypress="sendMsgEnter(event)" id="message_area" />
                    <button type="button" class="btn btn-sm btn-success bg-white p-0 border-0" id="send_button" onclick="send_chat_message()">
                    <svg width="15px" height="15px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.1168 12.1484C19.474 12.3581 19.9336 12.2384 20.1432 11.8811C20.3528 11.5238 20.2331 11.0643 19.8758 10.8547L19.1168 12.1484ZM6.94331 4.13656L6.55624 4.77902L6.56378 4.78344L6.94331 4.13656ZM5.92408 4.1598L5.50816 3.5357L5.50816 3.5357L5.92408 4.1598ZM5.51031 5.09156L4.76841 5.20151C4.77575 5.25101 4.78802 5.29965 4.80505 5.34671L5.51031 5.09156ZM7.12405 11.7567C7.26496 12.1462 7.69495 12.3477 8.08446 12.2068C8.47397 12.0659 8.67549 11.6359 8.53458 11.2464L7.12405 11.7567ZM19.8758 12.1484C20.2331 11.9388 20.3528 11.4793 20.1432 11.122C19.9336 10.7648 19.474 10.6451 19.1168 10.8547L19.8758 12.1484ZM6.94331 18.8666L6.56375 18.2196L6.55627 18.2241L6.94331 18.8666ZM5.92408 18.8433L5.50815 19.4674H5.50815L5.92408 18.8433ZM5.51031 17.9116L4.80505 17.6564C4.78802 17.7035 4.77575 17.7521 4.76841 17.8016L5.51031 17.9116ZM8.53458 11.7567C8.67549 11.3672 8.47397 10.9372 8.08446 10.7963C7.69495 10.6554 7.26496 10.8569 7.12405 11.2464L8.53458 11.7567ZM19.4963 12.2516C19.9105 12.2516 20.2463 11.9158 20.2463 11.5016C20.2463 11.0873 19.9105 10.7516 19.4963 10.7516V12.2516ZM7.82931 10.7516C7.4151 10.7516 7.07931 11.0873 7.07931 11.5016C7.07931 11.9158 7.4151 12.2516 7.82931 12.2516V10.7516ZM19.8758 10.8547L7.32284 3.48968L6.56378 4.78344L19.1168 12.1484L19.8758 10.8547ZM7.33035 3.49414C6.76609 3.15419 6.05633 3.17038 5.50816 3.5357L6.34 4.78391C6.40506 4.74055 6.4893 4.73863 6.55627 4.77898L7.33035 3.49414ZM5.50816 3.5357C4.95998 3.90102 4.67184 4.54987 4.76841 5.20151L6.25221 4.98161C6.24075 4.90427 6.27494 4.82727 6.34 4.78391L5.50816 3.5357ZM4.80505 5.34671L7.12405 11.7567L8.53458 11.2464L6.21558 4.83641L4.80505 5.34671ZM19.1168 10.8547L6.56378 18.2197L7.32284 19.5134L19.8758 12.1484L19.1168 10.8547ZM6.55627 18.2241C6.4893 18.2645 6.40506 18.2626 6.34 18.2192L5.50815 19.4674C6.05633 19.8327 6.76609 19.8489 7.33035 19.509L6.55627 18.2241ZM6.34 18.2192C6.27494 18.1759 6.24075 18.0988 6.25221 18.0215L4.76841 17.8016C4.67184 18.4532 4.95998 19.1021 5.50815 19.4674L6.34 18.2192ZM6.21558 18.1667L8.53458 11.7567L7.12405 11.2464L4.80505 17.6564L6.21558 18.1667ZM19.4963 10.7516H7.82931V12.2516H19.4963V10.7516Z" fill="#000000"/>
                    </svg>
                    </button>
                </div>
            </div>
            <div class="detail-area">
                <div class="detail-area-header">
                    <div class="msg-profile group">
                        <img class="msg-profile" src="` + UserImg + `" alt="profile-photo" />
                    </div>
                    <div class="detail-title" id="detail-title">` + to_user_name + `</div>
                    <div class="detail-subtitle"></div>
                    <div class="detail-buttons d-none">
                        <button class="detail-button">
                            <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                            </svg>
                            Call Chat
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
                <div class="detail-changes d-none">
                    <input type="text"  placeholder="Search in Conversation">
                </div>
                <div class="tabs-container mb-3">
                    `+TabElement+`
                </div>
            </div>`;

        document.getElementById('main-chat-section').innerHTML = html;

        var element = document.querySelector("#main-chat-section");

        element.style.backgroundColor = 'transparent';

        to_type = type;

        to_user_id = user_id;
        to_group_id = user_id;

        setTimeout(function() {
            // Code to run after the delay
            load_list_user(from_user_id);
        }, 1000);

    }


    function send_chat_message() {

        
        var message = document.getElementById('message_area').value.trim()
        
        if (message) {

        document.querySelector('#send_button').disabled = true;

        var data = {
            message: message,
            from_user_id: from_user_id,
            to_user_id: to_user_id,
            to_group_id: to_group_id,
            to_type: to_type,
            type: 'request_send_message'
        };

        conn.send(JSON.stringify(data));

        document.querySelector('#message_area').value = '';

        document.querySelector('#send_button').disabled = false;

        load_list_user(from_user_id);

        load_chat_data(from_user_id, to_user_id, to_type);

        }

    }


    function sendMsgEnter(event) {
        // You can perform actions based on the keypress event here
        if (event.keyCode === 13) {
            event.preventDefault(); // Prevent the default behavior for Enter key
            send_chat_message()
        }
    }


    function load_chat_data(from_user_id, to_user_id, to_type) {

        showLoading();

        var data = {
            from_user_id: from_user_id,
            to_user_id: to_user_id,
            to_type: to_type,
            type: 'request_chat_history'
        };

        conn.send(JSON.stringify(data));
    }


    function update_message_status(chat_message_id, from_user_id, to_user_id, chat_message_status) {
        
        var data = {
            chat_message_id: chat_message_id,
            from_user_id: from_user_id,
            to_user_id: to_user_id,
            to_group_id: to_group_id,
            chat_message_status: chat_message_status,
            to_type: to_type,
            type: 'update_chat_status'
        };

        conn.send(JSON.stringify(data));

        load_list_user(from_user_id);
    }

    // function ChooseFile(e)
    // {
      
    //     var input = document.createElement('input');
    //         input.type = 'file';
    //         input.style.display = 'none';

    //         // Append the input element to the body
    //         document.body.appendChild(input);

    //         // Trigger the click event on the input element
    //         input.click();

    //         // Listen for the change event on the input element
    //         input.addEventListener('change', function () {
    //             // Access the selected file(s)
    //             // var selectedFile = input.files[0];

    //             var file_element = input.files[0];

    //             var file_name = file_element.name;

    //             var file_extension = file_name.split('.').pop().toLowerCase();

    //             var allowed_extensions = ['png', 'jpg'];

    //             if (allowed_extensions.indexOf(file_extension) == -1) {
    //                 alert("Invalid Image File");
    //                 return false;
    //             }

    //             var file_reader = new FileReader();

    //             file_reader.onloadend = function() {
    //                 var file_raw_data = file_reader.result;
    //                   console.log(file_raw_data);
    //                   var data = {
    //                     // file_data: file_raw_data,
    //                     message: file_raw_data,
    //                     from_user_id: from_user_id,
    //                     to_user_id: to_user_id,
    //                     to_group_id: to_group_id,
    //                     to_type: to_type,
    //                     type: 'request_send_file'
    //                 };

    //                 conn.send(JSON.stringify(data));
    //             };

    //             file_reader.readAsArrayBuffer(file_element);
                
    //         });
    // }


    function scroll_top() {
        document.querySelector('#chat-area').scrollTop = document.querySelector('#chat-area').scrollHeight;
    }


    function GroupMemberData() {
        var data = {
            from_user_id: from_user_id,
            to_group_id: to_group_id,
            to_type: to_type,
            type: 'request_group_member'
        };
        conn.send(JSON.stringify(data));
    }

    $(document).on("click", ".close-chat-model", function(e) {
        e.preventDefault();
        $('.chat-box').html('');
        $('#fullWidthModal').modal('hide');
        conn.close();
    });


   
function showLoading() {
  document.querySelector('#loading').classList.add('loading');
  document.querySelector('#loading-content').classList.add('loading-content');
}

function hideLoading() {
  document.querySelector('#loading').classList.remove('loading');
  document.querySelector('#loading-content').classList.remove('loading-content');
}

</script>
