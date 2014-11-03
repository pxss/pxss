function check()
{
 var username = document.form1.usernamesignup.value;
 var mail = document.form1.emailsignup.value;
 var password = document.form1.passwordsignup.value;
 var password2 = document.form1.passwordsignup_confirm.value;

 if (username==""|| password==""||mail==""||password2=="")
 {
  alert("任意信息不能为空，请重新填写！");
  return false;
 }
  else if(username.length<2){
     alert("用户名不能小于2个字符，请重新输入！");
  return false;
 }
 else if(username.length>20){
     alert("用户名不能超过20个字符，请重新输入！");
  return false;
 }
 else if(password.length<7){
     alert("密码怎么能小于8个字符，请重新输入！");
  return false;
 }

 else if (password!=password2)
 {
     alert("2次密码输入不一致！");
  return false;
 }

 else{
  return true;
  }

}

function test()
        {
          var temp = document.getElementById("emailsignup");
          //对电子邮件的验证
          var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
          if(!myreg.test(temp.value))
           {
              alert('提示\n\n请输入有效的E_mail！');
               myreg.focus();
                return false;
           }
        }
