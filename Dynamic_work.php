<?php session_start();$_SESSION = [];if (isset($_COOKIE[session_name()])) { setcookie(session_name(), '', time()-42000, '/'); }session_destroy();include 'HomePage/YangJL/HomePublic.php';$PublicHome=new PublicHomePage; $time = time(); ?>
<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="pragram" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="expires" content="0">
    <title>湖南省交通运输项目库与计划管理信息平台</title>
    <link rel="stylesheet" type="text/css" href="public/index_new/css/css.css?time=<?php echo time(); ?>">
    <script type="text/javascript" src="public/index_new/Scripts/jquery-1.4.1.min.js"></script>
    <script type="text/javascript" src="public/index_new/Scripts/jquery.cookie.js"></script>
    <script type="text/javascript" src="public/index_new/Scripts/jquery.validate.js"></script>
    <script type="text/javascript" src="public/index_new/Scripts/jquery.metadata.js"></script>
    <script type="text/javascript">
        function selectTag(showContent, selfObj) {
            debugger;
            //  操作标签
            var tag = document.getElementById("tags").getElementsByTagName("li");
            var taglength = tag.length;
            for (i = 0; i < taglength; i++) {
                tag[i].className = "";
            }
            selfObj.parentNode.className = "selectTag";
            //  操作内容
            for (i = 0; j = document.getElementById("tagContent"+i); i++) {
                j.style.display = "none";
            }
            document.getElementById(showContent).style.display = "block";
        }
    </script>
    <style type="text/css">
        html, body {
            overflow: hidden;
        }
        .beijingtu {
            width: 100%;
            height: 100%;
            top:0;
            z-index: -1;
            position:absolute;
        }
        .beijingtu img {
            display: block;
            outline: none;
            border:0;
            width: 100%;
            position: relative;
            bottom: 31%;
        }
    </style>
</head>
<body>

<div class="content_room">
    <div class="title-img" style="margin-top: 60px;margin-left: 80px;">
        <img src=<?php echo "/static/images/nav.png?run=".time(); ?> />
    </div>
    <div class="tab">
        <ul id=tags>
            <li class=selectTag><a onClick="selectTag('tagContent0',this)"  href="javascript:void(0)">密码登录</a> </li>
            <li><a onClick="selectTag('tagContent1',this)"  href="javascript:void(0)">短信登录</a> </li>
            <span><a href="user_regist.php">新用户注册 ></a></span>
        </ul>
        <div id=tagContent>
            <div class="tagContent selectTag tab_1" id=tagContent0>
                <div class="login_title">用户登录</div>
                <ul>
                    <li>
                        <span>手&nbsp;&nbsp;&nbsp;&nbsp;机&nbsp;：</span>
                        <input name="txtTel" type="text" id="phone_pwd" class="kuang" placeholder="请输入手机号码" autofocus="autofocus">
                    </li>
                    <li>
                        <span>密&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;：</span>
                        <input name="txtPwdL" type="password" id="pwd_pwd" class="kuang" placeholder="请输入登录密码">
                    </li>
                </ul>
                <div class="hd_register_black">
                    <input type="button" name="btnLogin" value="登录" id="btnLogin_pwd"  class="hd_register_btn hd_register_btnleft" style="margin-bottom: 50px;">
                </div>
                <div style="color: red;font-size: 16px;text-align: center;min-height: 40px;margin-top: 10px;" id="error_notice"></div>
                <div style="float: right;">
                    忘记密码？<a href="find_pwd.php" style="color: black;">点这里 ></a>
                </div>
            </div>

            <div class="tagContent tab_2" id=tagContent1>
                <div class="login_title">用户登录</div>
                <ul>
                    <li>
                        <span>手&nbsp;&nbsp;&nbsp;&nbsp;机&nbsp;：</span>
                        <input name="txtTel" type="text" id="phone_code" class="kuang" placeholder="请输入手机号码">
                    </li>
                    <li>
                        <span>验&nbsp;证&nbsp;码&nbsp;：</span>
                        <input name="txtTel" type="text" id="VerificationCode" class="kuang" placeholder="请输入验证码" style="width: 140px;">
                        <div class="service" >
                            <span data-span="Verification" id="Verification" style="margin-top: 2px;"></span>
                        </div>
                    </li>
                    <li>
                        <span>短信验证&nbsp;：</span>
                        <input name="txtPwdL" type="text" id="sms_code" class="kuang" placeholder="短信验证码" style="width: 140px;">
                        <div class="service" >
                            <input type="button" name="get_sms_code" value="获取短信" class="hd_register_btn hd_register_btnleft" style="width: 110px;" id="get_sms_code">
                        </div>
                    </li>
                </ul>
                <div class="hd_register_black">
                    <input type="button" name="btnLogin" value="登录" id="btnLogin_code" class="hd_register_btn hd_register_btnleft" style="margin-bottom: 50px;background:#ddd;" disabled="disabled">
                </div>
                <div style="color: red;font-size: 16px;text-align: center;min-height: 40px;margin-top: 10px;" id="error_notice_bycode"></div>
            </div>
        </div>
    </div>
    <div class="beijingtu"><img src="/static/images/login/bg.jpg"/></div>
</div>

<script type="text/javascript" src="public/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
    var login = {
        init() {
            /** 页面加载时请求图片验证码 */
            this.imgVerification();
            isLogin_1 = false;
            isLogin_2 = false;

            isLogin_3 = false;
            isLogin_4 = false;

            var $this = this;
            $('.tab_1')
                /* 当手机号码输入框失去焦点的时候验证 */
                .on('blur', '#phone_pwd', function () {
                    isLogin_1 = false;
                    var data = {
                        cellphone: $('#phone_pwd').val().trim()
                    }
                    $this.check_phone(data)
                })

                /* 当密码输入框失去焦点的时候验证 */
                .on('blur', '#pwd_pwd', function () {
                    isLogin_2 = false;
                    if (isLogin_1 == true) {
                        if ($(this).val().trim() == '') {
                            $('#error_notice').html('密码不能为空');
                            return;
                        }
                        isLogin_2 = true;
                        $('#error_notice').html('');
                    }
                })

                /* 提交按钮被点击的时候验证 */
                .on('click', '#btnLogin_pwd', function (e) {
                        if (isLogin_1 == true) {
                            if ($(this).val().trim() == '') {
                                $('#error_notice').html('密码不能为空');
                                return;
                           }
                           isLogin_2 = true;
                          $('#error_notice').html('');
                        }
                    if (isLogin_1 == true && isLogin_2 == true) {
                        e.preventDefault();
                        var data = {
                            cellphone: $('#phone_pwd').val().trim(),
                            pwd: $('#pwd_pwd').val().trim()
                        };

                        $(this).attr('disabled', 'true').css('background', '#ddd').val('登录中...');
                        $this.login_pwd(data);
                    }
                })

            $('.tab_2')
                /* 点击图片，重新请求图形验证码 */
                .on('click', '#Verification', this.imgVerification)

                /* 当手机号码输入框失去焦点的时候验证 */
                .on('blur', '#phone_code', function () {
                    isLogin_3 = false;
                    var data = {
                        cellphone: $('#phone_code').val().trim()
                    }
                    $this.check_phone_code(data)
                })

                /* 当图形验证码输入框失去焦点的时候验证 */
                .on('blur', '#VerificationCode', function () {
                    isLogin_4 = false;
                    if (isLogin_3 == true) {
                        if ($(this).val().trim() == '') {
                            $('#error_notice_bycode').html('图形验证码不能为空');
                            return;
                        }

                        var reg = /^\d{4}$/;
                        if (!reg.test($(this).val().trim())) {
                            $('#error_notice_bycode').html('图形验证码为4位数字');
                            return;
                        }

                        isLogin_4 = true;
                        $('#error_notice_bycode').html('');
                    }
                })

                /* 点击获取短信验证码按钮函数 */
                .on('click', '#get_sms_code', function (e) {
                    if (isLogin_3 != true || isLogin_4 != true) {
                        if (isLogin_3 != true) {
                            $('#error_notice_bycode').html('请先完善手机号码');
                            return;
                        }
                        if (isLogin_4 != true) {
                            $('#error_notice_bycode').html('请先完善图形验证码信息');
                            return;
                        }
                    }

                    e.preventDefault();
                    /* 验证手机号码和图片验证码 */
                    $(this).css('background', '#ddd').attr('disabled', 'true').addClass('imgCodeClass');
                    /*获取 电话号码 和 图片验证码 传给 ajax 函数*/
                    var data = {
                        cellphone: $('#phone_code').val().trim(),
                        pic_code: $('#VerificationCode').val().trim()
                    };
                    $this.GetVerificationCode(data);
                })

                /* 提交按钮被点击的时候验证 */
                .on('click', '#btnLogin_code', function (e) {
                    if (isLogin_3 != true || isLogin_4 != true) {
                        if (isLogin_3 != true) {
                            $('#error_notice_bycode').html('请先完善手机号码');
                            return;
                        }
                        if (isLogin_4 != true) {
                            $('#error_notice_bycode').html('请先完善图形验证码信息');
                            return;
                        }
                    }

                    var smsCodeReg = /^\d{6}$/,
                    smsCode = $('#sms_code').val().trim();
                    if (smsCode == '') {
                        $('#error_notice_bycode').html('短信验证码不能为空');
                        return;
                    }
                    if (!smsCodeReg.test(smsCode)) {
                        $('#error_notice_bycode').html('短信验证码必须为6位数字');
                        return;
                    }

                    e.preventDefault();
                    var data = {
                        cellphone: $('#phone_code').val().trim(),
                        pic_code: $('#VerificationCode').val().trim(),
                        sms_num: $('#sms_code').val().trim()
                    };

                    /*登录 ajax 函数*/
                    $(this).removeAttr('btnLogin_code').css('background', '#ddd').val('登录中...');
                    $('#phone_code').attr('disabled', 'true');
                    $('#VerificationCode').attr('disabled', 'true');
                    $('#sms_code').attr('disabled', 'true');
                    $('[data-span="Verification"] img').removeAttr('id', 'Verification');
                    $this.AllVerification(data);
                })
            },

        /** 请求图片验证码函数 **/
        imgVerification() {
            $.ajax({
              type: 'post',
              url: "../index.php/system/login/showcaptcha",
              success: function (list) {
                $('[data-span="Verification"]').html('<img id="Verification" src="..' + list + '"/>');
              },
              error: function (err) {
                console.log('图形验证码请求失败');
              }
            });
        },

        /** 密码登录#####检查手机合法性 **/
        check_phone(data) {
            var reg = /^1\d{10}$/;
            if (data.cellphone == '') {
              $('#error_notice').html('手机号码不能为空');
              return;
            }
            if (!reg.test(data.cellphone)) {
              $('#error_notice').html('手机号码必须为11位数字');
              return;
            }

            $.ajax({
              type: 'post',
              url: '../index.php/system/hqlrole/isDisabled',
              data: data,
              success: function (res) {
                if (res.code == 0) {
                  let str = "手机号未注册或异常，请联系管理员"
                  $('#error_notice').html(str);
                  return;
                }

                isLogin_1 = true;
                if (isLogin_1 == true && isLogin_2 == true) {
                  $('#error_notice').html('');
                }
              },
              error: function () {
                alert('非常抱歉,服务器出现异常情况,暂时无法登录,给您带来不便,敬请谅解!');
                return;
              }
            });
        },

        /** 密码登录#####提交 **/
        login_pwd(alldata) {
            var $this = this;
            $.ajax({
              type: 'post',
              url: '../index.php/system/login/login_pwd.html',
              data: alldata,
              success: function (list) {
                if (list.code == 1) {
                    // console.log("OK");
                    $('#btnLogin_pwd').removeAttr('id');
                    sessionStorage.setItem('session', JSON.stringify(list.session));
                    window.location.href = './index.php';
                } else if (list.code == 0) {
                    // console.log("fail");
                    $('#btnLogin_pwd').removeAttr('disabled').css('background', '#458de5').val('登录');
                    $('#error_notice').html(list.msg);
                }
              },
              error: function () {
                alert('非常抱歉,服务器出现异常情况,暂时无法登录,给您带来不便,敬请谅解!');
              }
            });
        },

        /** 短信登录#####检查手机合法性 **/
        check_phone_code(data) {
            var reg = /^1\d{10}$/;
            if (data.cellphone == '') {
              $('#error_notice_bycode').html('手机号码不能为空');
              return;
            }
            if (!reg.test(data.cellphone)) {
              $('#error_notice_bycode').html('手机号码必须为11位数字');
              return;
            }

            $.ajax({
              type: 'post',
              url: '../index.php/system/hqlrole/isDisabled',
              data: data,
              success: function (res) {
                if (res.code == 0) {
                  let str = "手机号未注册或异常，请联系管理员"
                  $('#error_notice_bycode').html(str);
                  return;
                }

                isLogin_3 = true;
                $('#error_notice_bycode').html('');
              },
              error: function () {
                alert('非常抱歉,服务器出现异常情况,暂时无法登录,给您带来不便,敬请谅解!');
                return;
              }
            });
        },

        /** 获取短信验证码 ajax 函数 **/
        GetVerificationCode(data) {
            var $this = this;
            $.ajax({
              type: 'post',
              url: '../index.php/system/login/verify_send_sms.html',
              data: data,
              success: function (list) {
                if (list.code == 0) {
                  if (list.msg == '图形验证码不对') {
                    $('#error_notice_bycode').html(list.msg);
                  } else if (list.msg == '云端服务器提示发送短信失败：触发天级流控Permits:10;') {
                    $this.countDown();
                  } else {
                    $('#error_notice_bycode').html(list.msg);
                  }
                  $('#get_sms_code').css('background', '#458de5').removeAttr('disabled').removeClass('imgCodeClass');
                } else if (list.code == 1) {
                  $this.countDown();
                }
              },
              error: function () {
                alert('非常抱歉,服务器出现异常情况,暂时无法登录,给您带来不便,敬请谅解!');
              }
            });
        },

        /** 倒计时函数 */
        countDown() {
            var startTime = 300;
            $('#get_sms_code').val(`${startTime}秒后获取`);
            $('#btnLogin_code').css('background', '#458de5').removeAttr('disabled');
            $('#phone_code').attr('disabled', 'true');
            $('#VerificationCode').attr('disabled', 'true');
            var newTimer = setInterval(function () {
              startTime--;
              if (startTime < 0) {
                $('#get_sms_code').css('background', '#458de5').val('获取短信').removeAttr('disabled').removeClass('imgCodeClass');
                $('#btnLogin_code').css('background', '#ddd').attr('disabled', 'true');
                $('#phone_code').removeAttr('disabled');
                $('#VerificationCode').removeAttr('disabled');
                clearInterval(newTimer); //停止定时器
              } else {
                $('#get_sms_code').attr('disabled', 'true').val(`${startTime}秒后获取`);
              }
            }, 1000);
        },

        /** 登录按钮点击后，验证手机号码，验证码，短信验证码  ajax 函数 **/
        AllVerification(alldata) {
            var $this = this;
            $.ajax({
              type: 'post',
              url: '../index.php/system/login/login.html',
              data: alldata,
              success: function (list) {
                if (list.code == 1) {
                    $('#btnLogin_code').removeAttr('id');
                    sessionStorage.setItem('session', JSON.stringify(list.session));
                    window.location.href = './index.php';
                } else if (list.code == 0) {
                    $('#btnLogin_code').css('background', '#458de5').val('登录');
                    if (list.msg.sms_num) {
                      $('#error_notice_bycode').html(list.msg.sms_num);
                      $('#sms_code').removeAttr('disabled');
                    }

                    if (list.msg.pic_code) {
                      $('#error_notice_bycode').html(list.msg.pic_code);
                      $('#VerificationCode').removeAttr('disabled');
                    }

                    if (list.msg.length == 0) {
                      $('#error_notice_bycode').html('手机号码与短信验证码不符');
                      $('#phone_code').removeAttr('disabled');
                    }
                }
              },
              error: function () {
                alert('非常抱歉,服务器出现异常情况,暂时无法登录,给您带来不便,敬请谅解!');
              }
            });
        }
    };
    login.init();
</script>

</body>
</html>
