if (mainMenu == "home") {
    if (subMenu == "login") {
        //login
        $('.loginBtn').click(function() {
            var email = $('#email').val();
            var password = $('#password').val();
        
            if (!email && !password) {
                toastr['warning'](' Please fill the required fields');
                return false;
            }
            $.ajax({
                type: 'GET',
                url: site_url + "/user/login",
                data: {email: email, password: password},
                dataType: "JSON",
                success: function (response) {
                    if (response == "OK") {
                        location.href = "main";
                    } else if (response == "BLOCK") {
                        toastr['warning']("Blocked by Admin. Please contact Admin.");
                    } else if (response == "NOT_EXISTS") {
                        toastr['warning']("Please input the correct username and password");
                    } else {
                        toastr['error']("The server encountered an error.");
                    }
                }
            });
        });
    }
    if (subMenu == "register") {
        //register
        $('.registerBtn').click(function() {
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
        
            if (!name && !email && !password) {
                toastr['warning'](' Please fill the required fields');
                return false;
            }
            $.ajax({
                type: 'GET',
                url: site_url + "/user/register",
                data: {name: name, email: email, password: password},
                success: function (response) {
                    if (response == "OK") {
                        location.href = "main";
                    } else if (response == "exist") {
                        toastr['warning']("Already exists email");
                    } else {
                        toastr['error']("The server encountered an error.");
                    }
                }
            });
        });
    }
    if (subMenu == "forgot") {
        //forgot password
        $(".resetBtn").click(function() {
            var email = $('#email').val();
            if (!email) {
                toastr["warning"]("Please enter your email");
                $('#email').focus();
            }
            $.ajax({
                type: 'GET',
                url: site_url + "/user/forgot",
                data: {email: email},
                dataType: "JSON",
                success: function (response) {
                    if (response == "OK") {
                        toastr["success"]("Your password changed successfully. Please check your email");
                    } else {
                        toastr['error']("The server encountered an error.");
                    }
                }
                });
        });
    }
}

if (mainMenu == "user_menu") {
    if (subMenu == "user_account") {
        //account management
        $('.upload-profile-image').click(function() {
            var browseField = document.getElementById("profile_image_input");
            browseField.click();
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
            
                reader.onload = function(e) {
                    $('#profile_image').attr('src', e.target.result);
                }    
                reader.readAsDataURL(input.files[0]);
                var file_data = $('#profile_image_input').prop('files')[0];   
                var form_data = new FormData();         
                form_data.append('file', file_data);
                $.ajax({
                    url: site_url + '/File/profileImage',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(res){
                        console.log(res);
                    }
                });
            }
        }
        $("#profile_image_input").change(function() {
            readURL(this);
        });
        $('.changeInfo').click(function() {
            var saveAry = {};
            var pwd = $('#password').val();
            var conf_pwd = $('#password2').val();
            if (pwd != conf_pwd) {
                toastr["warning"]("Please enter your correct password.");
                $("#password").focus();
                return false;
            }
            $('.form-control').each(function() {
                var key = this.id;
                if (key == "password2") return;
                saveAry[key] = this.value;
            });
            $.ajax({
                url: site_url + "/user/changeAccount",
                type: 'POST',
                data: saveAry,
                dataType: "JSON",
                success: function (response) {
                    if (response == "OK")  {
                        toastr['success']("You information changed successfully.");
                    } else {
                        toastr['error']("Failed to change your information.");
                    }
                }
            });
        });
    }
    if (subMenu == "user_customer") {        
        //customer management
        var userkey = "";
        var flag = 1;
        $('.addNewCustomer').click(function() {
            flag = 1;
            userkey = "";
            $('.col').each(function() {
                $(this).find("input").each(function() {
                    $(this).val("");
                });
            });
            $("#email").prop("disabled", false);
            $('.modal-title').text("Add a New User");
            $("#editRow").modal("show");
        });

        $('.editBtn').click(function() {
            flag = 2;
            var user = this.id.split("edit_");
            userkey = user[1];
            $('.col').each(function() {
                $(this).find("input").each(function() {
                    var key = this.id;
                    var baseRow = $('.user_' + userkey).find("td").find("p");
                    baseRow.each(function() {
                        if ($(this).hasClass(key)) {
                            $('#' + key).val($(this).text());
                        }
                    });
                });
                $(this).find("select").each(function() {
                    var key = this.id;
                    var baseRow = $('.user_' + userkey).find("td").find("p");
                    baseRow.each(function() {
                        if ($(this).hasClass(key)) {
                            if (key == "gender") {
                                $('#' + key).val( $(this).text() == "Male" ? 0 : 1);
                            }
                            if (key == "status") {
                                $('#' + key).val( $(this).text() == "Enabled" ? 0 : 1);
                            }
                        }
                    });
                });      
            });
            $("#email").attr("disabled", true);
            $('.modal-title').text("Edit the User");
            $("#editRow").modal("show");
        });
        $('.deleteBtn').click(function() {
            if (confirm("Are you sure delete this user?")) {
                var user = this.id.split("delete_");
                if (user[0]) {
                    return;
                }
                $.ajax({
                    type: 'GET',
                    url: site_url + "/user/deleteUser",
                    data: {id: user[1]},
                    dataType: "JSON",
                    success: function (response) {
                        if (response == "OK") {
                            toastr["success"]("User successfully deleted.");
                            $('.user_' + user[1]).remove();
                        } else {
                            toastr['error']("Failed to delete user.");
                        }
                    }
                });
            }
        });
        $(".changeUserInfo").click(function() {
            var saveAry = {};
            saveAry['id'] = userkey;
            $('.col').each(function() {
                $(this).find("input").each(function() {
                    saveAry[this.id] = $(this).val();
                });
                $(this).find("select").each(function() {
                    saveAry[this.id] = $(this).val();
                });
            });
            $.ajax({
                type: 'POST',
                url: site_url + "/user/changeUserInfo",
                data: saveAry,
                dataType: "JSON",
                success: function (response) {
                    if (response == "OK") {
                        $('.user_' + userkey).find("td").find("p").each(function() {
                            for(var i in saveAry){
                                if (i == 'gender') {
                                    saveAry[i] = (saveAry[i] == 0 ? "Male" : "Female");
                                }
                                if (i == 'status') {
                                    saveAry[i] = (saveAry[i] == 0 ? "Enabled" : "Disabled");
                                }
                                if ($(this).hasClass(i)) {
                                    $($(this)).text( saveAry[i] );
                                }
                            }
                        });

                        $("#editRow").modal("hide");
                        toastr["success"]("User information successfully changed.");
                    } else {
                        toastr['error']("Failed to change user info.");
                    }
                }
            });
        });
    }
}
if (mainMenu == "question_menu") {
    if (subMenu == "question_management") {}
    if (subMenu == "access_management") {
        //survey access management
        $("#save_access").click(function() {
            var free = $("#free").val();
            var freemium = $("#freemium").val();
            var paid = $("#paid").val();
            $.ajax({
                type: 'POST',
                url: site_url + "/questions/setAccess",
                data: {free: free, freemium: freemium, paid: paid},
                dataType: "JSON",
                success: function (response) {
                    if (response == "OK") {
                        toastr["success"]("Successfully updated the access.");
                        $('.upload-file-' + id).remove();
                    } else {
                        toastr['error']("Failed to update the access.");
                    }
                }
            });
        });
        function getAccess() {
            $.ajax({
                type: 'GET',
                url: site_url + "/questions/getAccess",
                dataType: "JSON",
                success: function (response) {
                    $("#free").val(response.free);
                    $("#freemium").val(response.freemium.split(","));
                    $("#paid").val(response.paid.split(","));
                }
            });
        }
        getAccess();
    }
}
if (mainMenu == "document_menu") {
    if (subMenu == "uploads") {        
        //file upload management
        var t = 0;
        var l = 1;
        function active(obj) {
            if ($(obj).hasClass("active")) {
                $(obj).removeClass("active");
            } else {
                $(".media-thumb-container").removeClass("active");
                $(obj).addClass("active");
            }
        }
        function goFirstPage() {
            $('.page-item').removeClass("active");
            $('#page_1').addClass("active");
            l = 1;
            getFiles();
        }
        function goPreviousPage() {
            $('.page-item').removeClass("active");
            var current = (l == 1 ? 1 : l * 1 - 1);
            $('#page_' + current).addClass("active");
            l = current;
            getFiles();
        }
        function goNextPage() {
            $('.page-item').removeClass("active");
            var current = (l == t ? t : l * 1 + 1);
            $('#page_' + current).addClass("active");
            l = current;
            getFiles();
        }
        function getLastPage() {
            $('.page-item').removeClass("active");
            $('#page_' + t).addClass("active");
            l = t;
            getFiles();
        }
        function goPage(i) {
            $('.page-item').removeClass("active");
            $('#page_' + i).addClass("active");
            l = i;
            getFiles();
        }
        function download(name) {
            var link = document.createElement("a");
            link.download = name;
            link.href = base_url + "assets/uploads/" + name;
            link.click();
        }
        function getCounts() {
            $.ajax({
                type: 'GET',
                url: site_url + "document/getCounts",
                dataType: "JSON",
                success: function (response) {
                t = response;
                var pagination = '<li class="page-item ">\
                        <a class="page-link first" href="javascript:goFirstPage()"> \
                            <i class="simple-icon-control-start"></i>\
                        </a>\
                    </li>\
                    <li class="page-item ">\
                        <a class="page-link prev" href="javascript:goPreviousPage()">\
                            <i class="simple-icon-arrow-left"></i>\
                        </a>\
                    </li>';

                for (var i = 1; i <= response; i ++) {
                    pagination += '<li class="page-item ' + (i == 1 ? "active" : "") + '" id="page_' + i + '">\
                        <a class="page-link" href="javascript:goPage(' + i + ')">' + i + '</a>\
                    </li>';
                }
                pagination += '<li class="page-item ">\
                        <a class="page-link next" href="javascript:goNextPage()" aria-label="Next">\
                            <i class="simple-icon-arrow-right"></i>\
                        </a>\
                    </li>\
                    <li class="page-item ">\
                        <a class="page-link last" href="javascript:getLastPage()">\
                            <i class="simple-icon-control-end"></i>\
                        </a>\
                    </li>';
                $('.pagination').html(pagination);
                }
            });
        }
        function deleteUploadFiles(id) {
            if (confirm("Are you sure delete this file?")) {
                $.ajax({
                    type: 'GET',
                    url: site_url + "/file/deleteUploadedFile",
                    data: {key: id},
                    dataType: "JSON",
                    success: function (response) {
                        if (response == "OK") {
                            toastr["success"]("File successfully deleted.");
                            $('.upload-file-' + id).remove();
                        } else {
                            toastr['error']("Failed to delete a file.");
                        }
                    }
                });
            }
        }
        function getFiles() {
            $.ajax({
                type: 'GET',
                url: site_url + "document/getfiles",
                data: {c: l},
                dataType: "JSON",
                success: function (response) {
                var content = "";
                for (var i in response) {
                    var baseUrl = base_url + "assets/img/";
                    var typeImage = baseUrl + (response[i].type == "pdf" ? "icon-pdf.jpg" : ( response[i].type == "txt" ? "icon-txt.png" : (response[i].type == "doc" || response[i].type == "docx" ? "icon-doc.png" : "icon-xls.png")));
                    content += '<div class="col-xxl-4 col-xl-6 col-12 upload-file-' + response[i].id + '">';
                    content += '<div class="card d-flex flex-row mb-4 media-thumb-container" onclick="active(this)">';
                    content += '<a class="d-flex align-self-center" href="javascript:download(\'' + response[i].name + '\')">';
                    content += '<img src="' + typeImage + '" class="list-media-thumbnail responsive border-0" />';
                    content += '</a>';
                    content += '<div class="d-flex flex-grow-1 min-width-zero">';
                    content += '<div class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">';
                    content += '<a href="javascript:download(\'' + response[i].name + '\')" class="w-100">';
                    content += '<p class="list-item-heading mb-1 truncate">' + response[i].name + '</p>';
                    content += '</a>';
                    content += '<p class="mb-1 text-muted text-small w-100 truncate">' + response[i].idate + '</p>';
                    content += '</div>';
                    content += '</div>';
                    content += '<div class="close" onClick="deleteUploadFiles(' + response[i].id + ')">&times;</div>';
                    content += '</div>';
                    content += '</div>';
                }
                $('.content').html(content);
                }
            });
        }
        getCounts();
        getFiles();
    }
}
  
