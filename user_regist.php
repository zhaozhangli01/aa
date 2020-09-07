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
        <img src=<?php echo "/static/images/nav.png?run=".time(); ?>/>
    </div>
  
    <div class="tab">
        <div id=tagContent>
            <div class="tagContent selectTag tab_1" id=tagContent0>
                <div class="login_title">新用户注册</div>
                <ul>
                    <li>
                        <span>手&nbsp;&nbsp;&nbsp;&nbsp;机&nbsp;：</span>
                        <input name="txtTel" type="text" id="user_phone" class="kuang" placeholder="请输入手机号码" autofocus="autofocus">
                    </li>
                    <li>
                        <span>真实姓名&nbsp;：</span>
                        <input name="txtTel" type="text" id="user_name" class="kuang" placeholder="请输入真实姓名">
                    </li>
                    <li>
                        <span>密&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;：</span>
                        <input name="txtTel" type="password" id="user_pwd" class="kuang" placeholder="请输入登录密码">
                    </li>
                    <li>
                        <span>确认密码&nbsp;：</span>
                        <input name="txtTel" type="password" id="user_pwdConfirm" class="kuang" placeholder="请确认登录密码">
                    </li>
                    <li>
                        <span>验&nbsp;证&nbsp;码&nbsp;：</span>
                        <input name="txtTel" type="text" id="VerificationCode" class="kuang" placeholder="请输入验证码" style="width: 140px;">
                        <div class="" style="margin-left: 47.5%;">
                            <span data-span="Verification" id="Verification" style="margin-top: 2px;"></span>
                        </div>
                    </li>
                    <li>
	       <span>短信验证&nbsp;：</span>
                        <input name="txtPwdL" type="text" id="sms" class="kuang" placeholder="短信验证码" style="width: 140px;">
                        <div class="" style="margin-left: 47.5%;">
                            <input type="button" name="get_sms" value="获取短信" class="hd_register_btn hd_register_btnleft" style="width: 110px;" id="get_sms">
                        </div>
                    </li>
                </ul>
                <div class="hd_register_black">
                    <input type="button" name="btnLogin" value="注册" id="btnLogin" class="hd_register_btn hd_register_btnleft" style="margin-bottom: 50px;background:#ddd;" disabled="disabled">
                </div>
                <div style="color: red;font-size: 16px;text-align: center;min-height: 40px;margin-top: 10px;" id="error_notice"></div>
                <div style="float: right;">
                    <a href="Dynamic_work.php" style="color: black;">去登录 ></a>
                </div>
            </div>

            <div class="tagContent tab_2" id=tagContent1></div>
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
          isLogin_5 = false;

          var $this = this;
          $('.tab_1')
              /* 点击图片，重新请求图形验证码 */
              .on('click', '#Verification', this.imgVerification)

              /* 当手机号码输入框失去焦点的时候验证 */
              .on('blur', '#user_phone', function () {
                  isLogin_1 = false;
                  var data = {
                    cellphone: $('#user_phone').val().trim()
                  }
                  $this.check_phone(data)
              })

              /* 当真实姓名输入框失去焦点的时候验证 */
              .on('blur', '#user_name', function () {
                  isLogin_2 = false;
                  if (isLogin_1 != true) {
                      $('#error_notice').html('请先完善手机号码');
                      return;
                  }

                  if ($(this).val().trim() == '') {
                    $('#error_notice').html('真实姓名不能为空');
                    return;
                  }
                  if ($(this).val().trim().length < 2 || $(this).val().trim().length > 12) {
                    $('#error_notice').html('真实姓名限制2-12个字符');
                    return;
                  }

                  isLogin_2 = true;
                  $('#error_notice').html('');
              })

              /* 当密码输入框失去焦点的时候验证 */
              .on('blur', '#user_pwd', function () {
                  isLogin_3 = false;
                  if (isLogin_1 != true || isLogin_2 != true) {
                      if (isLogin_1 != true) {
                          $('#error_notice').html('请先完善手机号码');
                          return;
                      }
                      if (isLogin_2 != true) {
                          $('#error_notice').html('请先完善真实姓名');
                          return;
                      }
                  }

                  if ($(this).val().trim() == '') {
                    $('#error_notice').html('密码不能为空');
                    return;
                  }

                  if ($(this).val().trim().length < 8 || $(this).val().trim().length > 16) {
                    $('#error_notice').html('密码限制8-16个字符');
                    return;
                  }

                  var reg = /^(?!.*\\s)(?!^[!@#$%^&*]+$)(?!^[0-9]+$)(?!^[A-z]+$)(?!^[^A-z0-9]+$)^.{8,16}$/;
                  if (!reg.test($(this).val().trim())) {
                      $('#error_notice').html('密码必须为数字、大小写字母、特殊符号中最少两种');
                      return;
                  }

                  if ($('#user_pwdConfirm').val().trim() != '' && $('#user_pwd').val().trim() != $('#user_pwdConfirm').val().trim()) {
                    $('#error_notice').html('两次密码输入不一致');
                    return;
                  }

                  isLogin_3 = true;
                  $('#error_notice').html('');
              })

              /* 当确认密码输入框失去焦点的时候验证 */
              .on('blur', '#user_pwdConfirm', function () {
                  isLogin_4 = false;
                  if (isLogin_1 != true || isLogin_2 != true || isLogin_3 != true) {
                      if (isLogin_1 != true) {
                          $('#error_notice').html('请先完善手机号码');
                          return;
                      }
                      if (isLogin_2 != true) {
                          $('#error_notice').html('请先完善真实姓名');
                          return;
                      }
                      if (isLogin_3 != true) {
                          $('#error_notice').html('请先完善密码信息');
                          return;
                      }
                  }

                  if ($(this).val().trim() == '') {
                    $('#error_notice').html('确认密码不能为空');
                    return;
                  }
                  if ($('#user_pwd').val().trim() != '' && $('#user_pwd').val().trim() != $('#user_pwdConfirm').val().trim()) {
                    $('#error_notice').html('两次密码输入不一致');
                    return;
                  }

                  isLogin_4 = true;
                  $('#error_notice').html('');
              })

              /* 当图形验证码输入框失去焦点的时候验证 */
              .on('blur', '#VerificationCode', function () {
                  isLogin_5 = false;
                  if (isLogin_1 != true || isLogin_2 != true || isLogin_3 != true || isLogin_4 != true) {
                      if (isLogin_1 != true) {
                          $('#error_notice').html('请先完善手机号码');
                          return;
                      }
                      if (isLogin_2 != true) {
                          $('#error_notice').html('请先完善真实姓名');
                          return;
                      }
                      if (isLogin_3 != true) {
                          $('#error_notice').html('请先完善密码信息');
                          return;
                      }
                      if (isLogin_4 != true) {
                          $('#error_notice').html('请先完善密码信息');
                          return;
                      }
                  }

                  if ($(this).val().trim() == '') {
                    $('#error_notice').html('图形验证码不能为空');
                    return;
                  }
                  var reg = /^\d{4}$/;
                  if (!reg.test($(this).val().trim())) {
                    $('#error_notice').html('图形验证码为4位数字');
                    return;
                  }

                  isLogin_5 = true;
                  $('#error_notice').html('');
              })

              /* 点击获取短信验证码按钮函数 */
              .on('click', '#get_sms', function (e) {
                  if (isLogin_1 != true || isLogin_2 != true || isLogin_3 != true || isLogin_4 != true || isLogin_5 != true) {
                    if (isLogin_1 != true) {
                          $('#error_notice').html('请先完善手机号码');
                          return;
                      }
                      if (isLogin_2 != true) {
                          $('#error_notice').html('请先完善真实姓名');
                          return;
                      }
                      if (isLogin_3 != true) {
                          $('#error_notice').html('请先完善密码信息');
                          return;
                      }
                      if (isLogin_4 != true) {
                          $('#error_notice').html('请先完善密码信息');
                          return;
                      }
                      if (isLogin_5 != true) {
                          $('#error_notice').html('请先完善图形验证码信息');
                          return;
                      }
                  }
                    e.preventDefault();
                    /* 验证手机号码和图片验证码 */
                    $(this).css('background', '#ddd').attr('disabled', 'true').addClass('imgCodeClass');
                    /*获取 电话号码 和 图片验证码 传给 ajax 函数*/
                    var data = {
                      cellphone: $('#user_phone').val().trim(),
                      user_name: $('#user_name').val().trim(),
                      user_pwd: $('#user_pwd').val().trim(),
                      user_pwdConfirm: $('#user_pwdConfirm').val().trim(),
                      pic_code: $('#VerificationCode').val().trim()
                    };
                    $this.GetVerificationCode(data);
              })

              /* 提交按钮被点击的时候验证 */
              .on('click', '#btnLogin', function (e) {
                  if (isLogin_1 != true || isLogin_2 != true || isLogin_3 != true || isLogin_4 != true || isLogin_5 != true) {
                    if (isLogin_1 != true) {
                          $('#error_notice').html('请先完善手机号码');
                          return;
                      }
                      if (isLogin_2 != true) {
                          $('#error_notice').html('请先完善真实姓名');
                          return;
                      }
                      if (isLogin_3 != true) {
                          $('#error_notice').html('请先完善密码信息');
                          return;
                      }
                      if (isLogin_4 != true) {
                          $('#error_notice').html('请先完善密码信息');
                          return;
                      }
                      if (isLogin_5 != true) {
                          $('#error_notice').html('请先完善图形验证码信息');
                          return;
                      }
                  }

                      var smsCodeReg = /^\d{6}$/,
                      smsCode = $('#sms').val().trim();
                      if (smsCode == '') {
                        $('#error_notice').html('短信验证码不能为空');
                        return;
                      }
                      if (!smsCodeReg.test(smsCode)) {
                        $('#error_notice').html('短信验证码必须为6位数字');
                        return;
                      }

                      e.preventDefault();
                      var data = {
                          user_phone: $('#user_phone').val().trim(),
                          user_name: $('#user_name').val().trim(),
                          user_pwd: $('#user_pwd').val().trim(),
                          user_pwdConfirm: $('#user_pwdConfirm').val().trim(),
                          pic_code: $('#VerificationCode').val().trim(),
                          sms_num: $('#sms').val().trim()
                      };

                      /*登录 ajax 函数*/
                      $(this).removeAttr('btnLogin').css('background', '#ddd').val('注册中...').attr('disabled', 'true');
                      $('#user_phone').attr('disabled', 'true');
                      $('#user_name').attr('disabled', 'true');
                      $('#user_pwd').attr('disabled', 'true');
                      $('#user_pwdConfirm').attr('disabled', 'true');
                      $('#VerificationCode').attr('disabled', 'true');
                      $('#sms').attr('disabled', 'true');
                      $('[data-span="Verification"] img').removeAttr('id', 'Verification');
                      $this.AllVerification(data);

                      // $('#error_notice').html('New：提交注册！');
                      // return;
                      // console.log(data);
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

        /** 检查手机合法性 **/
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
              url: '../index.php/system/regist/check_regist',
              data: data,
              success: function (res) {
                if (res.code == 0) {
                  $('#error_notice').html(res.msg);
                  return;
                }

                isLogin_1 = true;
                $('#error_notice').html('');
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
              url: '../index.php/system/login/verify_send_sms_regist.html',
              data: data,
              success: function (list) {
                if (list.code == 0) {
                  if (list.msg == '图形验证码不对') {
                    $('#error_notice').html(list.msg);
                  } else if (list.msg == '云端服务器提示发送短信失败：触发天级流控Permits:10;') {
                    $this.countDown();
                  } else {
                    $('#error_notice').html(list.msg);
                  }
                  $('#get_sms').css('background', '#458de5').removeAttr('disabled').removeClass('imgCodeClass');
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
            $('#get_sms').val(`${startTime}秒后获取`);
            $('#btnLogin').css('background', '#458de5').removeAttr('disabled');
            $('#user_phone').attr('disabled', 'true');
            $('#user_name').attr('disabled', 'true');
            $('#user_pwd').attr('disabled', 'true');
            $('#user_pwdConfirm').attr('disabled', 'true');
            $('#VerificationCode').attr('disabled', 'true');
            var newTimer = setInterval(function () {
              startTime--;
              if (startTime < 0) {
                $('#get_sms').css('background', '#458de5').val('获取短信').removeAttr('disabled').removeClass('imgCodeClass');
                $('#btnLogin').css('background', '#ddd').attr('disabled', 'true');
                $('#user_phone').removeAttr('disabled');
                $('#user_name').removeAttr('disabled');
                $('#user_pwd').removeAttr('disabled');
                $('#user_pwdConfirm').removeAttr('disabled');
                $('#VerificationCode').removeAttr('disabled');
                clearInterval(newTimer); //停止定时器
              } else {
                $('#get_sms').attr('disabled', 'true').val(`${startTime}秒后获取`);
              }
            }, 1000);
        },


        /** 登录按钮点击后，验证手机号码，验证码，短信验证码  ajax 函数 **/
        AllVerification(alldata) {
            var $this = this;
            $.ajax({
              type: 'post',
              url: '../index.php/system/regist/regist.html',
              data: alldata,
              success: function (list) {
                if (list.code == 1) {
                    alert("注册成功，请联系管理员激活账号");
                    window.location.href = 'Dynamic_work.php';
                } else if (list.code == 0) {
                    $('#btnLogin').css('background', '#458de5').val('注册').removeAttr('disabled');
                    if (list.msg.sms_num) {
                      $('#error_notice').html(list.msg.sms_num);
                      $('#sms').removeAttr('disabled');
                    }

                    if (list.msg.pic_code) {
                      $('#error_notice').html(list.msg.pic_code);
                      $('#VerificationCode').removeAttr('disabled');
                    }

                    if (list.msg.length == 0) {
                      $('#error_notice').html('手机号码与短信验证码不符');
                      $('#user_phone').removeAttr('disabled');
                    }
                }
              },
              error: function () {
                alert('非常抱歉,服务器出现异常情况,暂时无法登录,给您带来不便,敬请谅解!');
              }
            });
        },
    };

    login.init();
</script>
</body>
</body>
</html>
