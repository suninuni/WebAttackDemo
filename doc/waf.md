title: WAF
speaker: Zack Sun
transition: cards

[slide]

# WAF

## 云盾Web应用防火墙

[slide]

# Web 应用攻击防护

[slide]

- XSS 攻击（Cross-site scripting）
- CRLF 攻击
- SQL 注入
- 写入 WebShell 攻击
- CSRF（Cross Site Request Forgery）

[slide]

# XSS 攻击（Cross Site Script）

通过“HTML注入”篡改了网页，插入了恶意的脚本，从而在用户浏览网页时，控制用户浏览器的一种攻击。

- 反射型 XSS：诱使用户“点击”一个恶意链接
- 存储性 XSS：脚本存在服务端，例如恶意网站
- DOM Based XSS：修改页面的 DOM 节点

```javascript
// html Payload
"username=test'><img src=# onerror=alert(/xss/)"

// js Payload
img.src = '#'
document.body.appendChild(img)
```

[slide]

- 窃取 Cookie（设置`HttpOnly`，`Secure`）
- 构造请求
- 钓鱼
- 识别用户浏览器
- 识别用户安装的软件

[slide]

# CRLF 攻击

HTTP响应拆分漏洞（HTTP Response Splitting）

在 Set-Cookie 的值里插入了两次`\r\n`换行符，两次`\r\n`意味着 HTTP 头的结束，后面的都会被认为是 HTTP Body

```
http://test.com/login?email=email%0d%0a%0d%0a<script>alert(/XSS/);</script>
```

注入一个 HTTP 头，比如下面的可以关闭 IE 8 的 XSS Filter 功能

```
X-XSS-Protection: 0
```

[slide]

# SQL 注入

- 盲注（Blind Injection）：构造简单的条件语句，根据返回页面是否发生变化，来判断SQL语句是否得到执行
- Timing Attack：利用 `BENCHMARK()` 函数，可以让同一个函数执行若干次，使得结果返回的时间比平时要长；通过时间长短的变化，可以判断出注入语句是否执行成功

[slide]

# 写入 WebShell 攻击

以asp、php、jsp、asa或者cgi等网页文件形式存在的—种命令执行环境，也可以称为—种网页后门。

- 通过前台的上传业务，上传脚本
- 获得或猜测文件的完整 Url 信息
- 如果对网站存取权限或者文件夹目录权限控制不严，通过url访问这个脚本，脚本就被执行

[slide]

# CSRF 攻击（Cross Site Request Forgery）

挟制用户在当前已登录的Web应用程序上执行非本意的操作的攻击方法

[slide]

# Cookie

- Session Cokie（临时 Cookie）：没有指定 Expire 时间，浏览器关闭后，才失效，保存在浏览器进程的内存空间中
- Third-party Cookie（本地 Cookie）：指定了 Expire 时间，保存在本地
- 属性：expires domain path secure HttpOnly

[slide]

# 同源策略

- 作用：限制了来自不同源的`document`或脚本，对当前`document`读取或设置某些属性
- 什么是同源
    - 协议相同
    - 域名相同
    - 端口相同
- 限制
    - Cookie、LocalStorage 和 IndexDB 无法读取
    - DOM 无法获得
    - AJAX 请求不能发送

[slide]

# 绕过同源策略

- `<img>`、`<iframe>`、`<script>`、`<link>`等标签都可以跨域加载资源
- 一级域名相同的情况下设置其为 `document.domain`或服务器在设置 Cookie 时指定所属域名为一级域名，即可共享 Cookie
- 完全不同源
    - 片段识别符（fragment identifier）：URL的 `#` 号后面的部分，单纯的改变不会导致页面刷新
    - window.name
    - 跨文档通信API（Cross-document messaging）
- JSONP，WebSocket，[CORS](http://www.ruanyifeng.com/blog/2016/04/cors.html)

[slide]

# 浏览器的 Cookie 策略

- IE 和 Safari 出于安全考虑，默认禁止了浏览器在`<img>`、`<iframe>`、`<script>`、`<link>`等标签中发送第三方 Cookie
- 因此在这两个浏览器中需要诱使用户在当前浏览器中访问目标站点，利用 Session Cookie 进行 CSRF 攻击，其他的都可以利用第三方 Cookie 进行 CSRF 攻击
- P3P Header 是 W3C 制定的一项关于隐私的标准，由网站在返回头部中设置，设置一次即会使该域中所有请求都可以发送第三方 Cookie

[slide]

# CC 防护

攻击者借助代理服务器生成指向受害主机的合法请求，实现DDOS和伪装就叫：CC(ChallengeCollapsar)。

类似的

- Slowloris 攻击
- HTTP POST DOS：设置一个非常大的 Content-Length
- Server Limit DOS：而已的往客户端写入一个超长的 Cookie
- ReDOS：比如 `^(a+)+$` 每增加一个 `a`，路径的数量翻倍

[slide]

# 精确访问控制

[slide]

# [风险预警](https://help.aliyun.com/document_detail/48707.html?spm=5176.doc65734.6.581.u4iOGv)

- 黑客攻击
- [WordPress](https://help.aliyun.com/knowledge_detail/42198.html)
- 疑似攻击
- robots 脚本
- [爬虫访问](https://help.aliyun.com/knowledge_detail/49148.html)
- 短信滥刷

[slide]

# 数据风控

通过对同一 ip 的访问行为和阿里云信誉库去判断是否有风险从而判断是否进行人机验证

[slide]

# 网页防篡改

对页面进行缓存，用户访问到的是缓存的页面

[slide]

- 封禁地区
- 全量日志检索
- 智能防护引擎
- 防敏感信息泄露
- 防信息泄漏
- 恶意IP封禁
- [可视化大屏](https://help.aliyun.com/document_detail/65734.html?spm=5176.7753966.6.598.ENdzD9)
