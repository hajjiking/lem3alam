<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>lem3alam.ma API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.8.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.8.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-register">
                                <a href="#endpoints-POSTapi-v1-register">POST api/v1/register</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-login">
                                <a href="#endpoints-POSTapi-v1-login">POST api/v1/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-categories">
                                <a href="#endpoints-GETapi-v1-categories">Display a listing of categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-tasks">
                                <a href="#endpoints-GETapi-v1-tasks">GET api/v1/tasks</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-tasks--task_id-">
                                <a href="#endpoints-GETapi-v1-tasks--task_id-">GET api/v1/tasks/{task_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-cities-regions">
                                <a href="#endpoints-GETapi-v1-cities-regions">Get all regions with their cities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-cities-major">
                                <a href="#endpoints-GETapi-v1-cities-major">Get major cities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-cities-all">
                                <a href="#endpoints-GETapi-v1-cities-all">Get all cities as a flat list (for dropdowns)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-cities-search">
                                <a href="#endpoints-GETapi-v1-cities-search">Search cities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-cities-region--region-">
                                <a href="#endpoints-GETapi-v1-cities-region--region-">Get cities by region</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-cities--city-">
                                <a href="#endpoints-GETapi-v1-cities--city-">Get city information</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-logout">
                                <a href="#endpoints-POSTapi-v1-logout">POST api/v1/logout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-user">
                                <a href="#endpoints-GETapi-v1-user">GET api/v1/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-profile">
                                <a href="#endpoints-GETapi-v1-profile">Get user profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-profile">
                                <a href="#endpoints-PUTapi-v1-profile">Update user profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-profile-avatar">
                                <a href="#endpoints-POSTapi-v1-profile-avatar">Upload Avatar</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-profile-avatar">
                                <a href="#endpoints-DELETEapi-v1-profile-avatar">Delete Avatar</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-tasks">
                                <a href="#endpoints-POSTapi-v1-tasks">POST api/v1/tasks</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-tasks--task_id-">
                                <a href="#endpoints-PUTapi-v1-tasks--task_id-">PUT api/v1/tasks/{task_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-tasks--task_id-">
                                <a href="#endpoints-DELETEapi-v1-tasks--task_id-">DELETE api/v1/tasks/{task_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-tasks--task_id--apply">
                                <a href="#endpoints-POSTapi-v1-tasks--task_id--apply">POST api/v1/tasks/{task_id}/apply</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-my-tasks">
                                <a href="#endpoints-GETapi-v1-my-tasks">GET api/v1/my-tasks</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-my-applications">
                                <a href="#endpoints-GETapi-v1-my-applications">GET api/v1/my-applications</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-applications--application_id--accept">
                                <a href="#endpoints-PUTapi-v1-applications--application_id--accept">PUT api/v1/applications/{application_id}/accept</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-applications--application_id--reject">
                                <a href="#endpoints-PUTapi-v1-applications--application_id--reject">PUT api/v1/applications/{application_id}/reject</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-messages">
                                <a href="#endpoints-GETapi-v1-messages">Get messages for a specific task</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-messages">
                                <a href="#endpoints-POSTapi-v1-messages">Send a message</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-messages--message_id--read">
                                <a href="#endpoints-PUTapi-v1-messages--message_id--read">Mark message as read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-conversations--userId-">
                                <a href="#endpoints-GETapi-v1-conversations--userId-">Get conversation with a specific user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-payments">
                                <a href="#endpoints-POSTapi-v1-payments">Create payment for a task</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-payments">
                                <a href="#endpoints-GETapi-v1-payments">Get payments for authenticated user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-payments--payment_id--release">
                                <a href="#endpoints-PUTapi-v1-payments--payment_id--release">PUT api/v1/payments/{payment_id}/release</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-reviews">
                                <a href="#endpoints-POSTapi-v1-reviews">Create a new review</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-reviews--userId-">
                                <a href="#endpoints-GETapi-v1-reviews--userId-">Get reviews for a specific user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-disputes">
                                <a href="#endpoints-POSTapi-v1-disputes">Create a new dispute</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-disputes">
                                <a href="#endpoints-GETapi-v1-disputes">Get disputes for authenticated user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-disputes--dispute-">
                                <a href="#endpoints-GETapi-v1-disputes--dispute-">Get dispute details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-dashboard">
                                <a href="#endpoints-GETapi-v1-admin-dashboard">GET api/v1/admin/dashboard</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-users">
                                <a href="#endpoints-GETapi-v1-admin-users">GET api/v1/admin/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-admin-users--user_id--verify">
                                <a href="#endpoints-PUTapi-v1-admin-users--user_id--verify">PUT api/v1/admin/users/{user_id}/verify</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-tasks-pending">
                                <a href="#endpoints-GETapi-v1-admin-tasks-pending">GET api/v1/admin/tasks/pending</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-disputes-pending">
                                <a href="#endpoints-GETapi-v1-admin-disputes-pending">GET api/v1/admin/disputes/pending</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-admin-disputes--dispute_id--resolve">
                                <a href="#endpoints-PUTapi-v1-admin-disputes--dispute_id--resolve">PUT api/v1/admin/disputes/{dispute_id}/resolve</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-payments-overview">
                                <a href="#endpoints-GETapi-v1-admin-payments-overview">GET api/v1/admin/payments/overview</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-commissions">
                                <a href="#endpoints-GETapi-v1-admin-commissions">GET api/v1/admin/commissions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-messaging-send">
                                <a href="#endpoints-POSTapi-v1-messaging-send">POST api/v1/messaging/send</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-messaging-history">
                                <a href="#endpoints-GETapi-v1-messaging-history">GET api/v1/messaging/history</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-messaging-typing">
                                <a href="#endpoints-POSTapi-v1-messaging-typing">POST api/v1/messaging/typing</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-messaging-read">
                                <a href="#endpoints-POSTapi-v1-messaging-read">POST api/v1/messaging/read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-taskers--tasker--reviews">
                                <a href="#endpoints-GETapi-taskers--tasker--reviews">Get reviews for a tasker (AJAX)</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: March 7, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-v1-register">POST api/v1/register</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"email\": \"kunde.eloisa@example.com\",
    \"password\": \"4[*UyPJ\\\"}6\",
    \"phone\": \"hdtqtqxbajwbpilpm\",
    \"role\": \"tasker\",
    \"city\": \"ufinllwloauydlsmsjury\",
    \"bio\": \"vojcybzvrbyickznkyglo\",
    \"hourly_rate\": 29
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "email": "kunde.eloisa@example.com",
    "password": "4[*UyPJ\"}6",
    "phone": "hdtqtqxbajwbpilpm",
    "role": "tasker",
    "city": "ufinllwloauydlsmsjury",
    "bio": "vojcybzvrbyickznkyglo",
    "hourly_rate": 29
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-register">
</span>
<span id="execution-results-POSTapi-v1-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-register" data-method="POST"
      data-path="api/v1/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-register"
                    onclick="tryItOut('POSTapi-v1-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-register"
                    onclick="cancelTryOut('POSTapi-v1-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-register"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-register"
               value="kunde.eloisa@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>kunde.eloisa@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-register"
               value="4[*UyPJ"}6"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>4[*UyPJ"}6</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-v1-register"
               value="hdtqtqxbajwbpilpm"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>hdtqtqxbajwbpilpm</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="POSTapi-v1-register"
               value="tasker"
               data-component="body">
    <br>
<p>Example: <code>tasker</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>client</code></li> <li><code>tasker</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-v1-register"
               value="ufinllwloauydlsmsjury"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>ufinllwloauydlsmsjury</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio"                data-endpoint="POSTapi-v1-register"
               value="vojcybzvrbyickznkyglo"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>vojcybzvrbyickznkyglo</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio_translations</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio_translations"                data-endpoint="POSTapi-v1-register"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>skills</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="skills"                data-endpoint="POSTapi-v1-register"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hourly_rate</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="hourly_rate"                data-endpoint="POSTapi-v1-register"
               value="29"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>29</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-login">POST api/v1/login</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"password\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "password": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-login">
</span>
<span id="execution-results-POSTapi-v1-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-login" data-method="POST"
      data-path="api/v1/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-login"
                    onclick="tryItOut('POSTapi-v1-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-login"
                    onclick="cancelTryOut('POSTapi-v1-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-login"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-login"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-categories">Display a listing of categories</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-categories">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-categories" data-method="GET"
      data-path="api/v1/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-categories"
                    onclick="tryItOut('GETapi-v1-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-categories"
                    onclick="cancelTryOut('GETapi-v1-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-tasks">GET api/v1/tasks</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-tasks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/tasks" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tasks"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-tasks">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 16,
                &quot;title&quot;: &quot;new test&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;sdvkhasfv hasdufhviu hfvushf df hifuvfh u&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 3,
                &quot;category_id&quot;: 60,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;100.00&quot;,
                &quot;budget_max&quot;: &quot;200.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;El Marsa&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;high&quot;,
                &quot;deadline&quot;: &quot;2026-02-18T22:16:00.000000Z&quot;,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-02-16T22:34:17.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-02-16T22:34:17.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;abdessamad hajji&quot;,
                    &quot;email&quot;: &quot;hajjizik@gmail.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:46:18.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-27T19:46:18.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;0661-653342&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: null,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Organization&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;Organisation&quot;,
                        &quot;ar&quot;: &quot;التنظيم&quot;
                    },
                    &quot;description&quot;: &quot;Organization&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Organisation&quot;,
                        &quot;ar&quot;: &quot;التنظيم&quot;
                    },
                    &quot;icon&quot;: null,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 5,
                    &quot;parent_id&quot;: 55,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 12,
                &quot;title&quot;: &quot;Debug Task&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;Created via debug script&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 2,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;100.00&quot;,
                &quot;budget_max&quot;: &quot;150.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: null,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;urgent&quot;,
                &quot;deadline&quot;: &quot;2025-10-20T17:01:42.000000Z&quot;,
                &quot;required_skills&quot;: [
                    &quot;php&quot;,
                    &quot;laravel&quot;
                ],
                &quot;images&quot;: [],
                &quot;is_remote&quot;: true,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-10-13T16:01:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-13T16:01:42.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Test User&quot;,
                    &quot;email&quot;: &quot;test@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;+1234567890&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: &quot;Test City&quot;,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 11,
                &quot;title&quot;: &quot;Test Task via Login Script&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;This is a test task created after successful login authentication.&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 5,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;150.00&quot;,
                &quot;budget_max&quot;: &quot;300.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Test Location&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;medium&quot;,
                &quot;deadline&quot;: &quot;2025-10-03T03:31:53.000000Z&quot;,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-26T02:31:53.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-26T02:31:53.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Test Client&quot;,
                    &quot;email&quot;: &quot;client@test.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-26T02:27:31.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-26T02:27:31.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: null,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: null,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 10,
                &quot;title&quot;: &quot;Test Task Creation&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;This is a test task to verify the creation process works correctly.&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 5,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;100.00&quot;,
                &quot;budget_max&quot;: &quot;200.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Test Location&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;medium&quot;,
                &quot;deadline&quot;: null,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-26T02:28:24.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-26T02:28:24.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Test Client&quot;,
                    &quot;email&quot;: &quot;client@test.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-26T02:27:31.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-26T02:27:31.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: null,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: null,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 8,
                &quot;title&quot;: &quot;Test Form Submission - 2025-09-08 03:22:01&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;This is a test to debug form submission issues.&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 2,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;150.00&quot;,
                &quot;budget_max&quot;: &quot;150.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Test Location&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;medium&quot;,
                &quot;deadline&quot;: &quot;2025-09-18T00:00:00.000000Z&quot;,
                &quot;required_skills&quot;: [
                    &quot;PHP&quot;,
                    &quot;Laravel&quot;,
                    &quot;JavaScript&quot;
                ],
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-08T02:22:01.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-08T02:22:01.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Test User&quot;,
                    &quot;email&quot;: &quot;test@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;+1234567890&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: &quot;Test City&quot;,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 6,
                &quot;title&quot;: &quot;Final Test Task&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;Testing if task creation still works&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 2,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;300.00&quot;,
                &quot;budget_max&quot;: &quot;300.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Final Test Location&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;medium&quot;,
                &quot;deadline&quot;: null,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-06T23:37:21.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-06T23:37:21.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Test User&quot;,
                    &quot;email&quot;: &quot;test@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;+1234567890&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: &quot;Test City&quot;,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 5,
                &quot;title&quot;: &quot;Web Form Test Task&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;Testing task creation through web form simulation&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 2,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;250.00&quot;,
                &quot;budget_max&quot;: &quot;250.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Web Test Location&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;high&quot;,
                &quot;deadline&quot;: null,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-06T23:36:41.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-06T23:36:41.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Test User&quot;,
                    &quot;email&quot;: &quot;test@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;+1234567890&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: &quot;Test City&quot;,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 3,
                &quot;title&quot;: &quot;Test Task with Budget Max&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;This is a test task to verify creation functionality&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 2,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;100.00&quot;,
                &quot;budget_max&quot;: &quot;200.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Test Location&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;medium&quot;,
                &quot;deadline&quot;: null,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-06T23:30:58.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-06T23:30:58.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Test User&quot;,
                    &quot;email&quot;: &quot;test@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;+1234567890&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: &quot;Test City&quot;,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 4,
                &quot;title&quot;: &quot;Test Task Same Budget&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;Test with same min/max budget&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 2,
                &quot;category_id&quot;: 46,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;150.00&quot;,
                &quot;budget_max&quot;: &quot;150.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Test Location 2&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;high&quot;,
                &quot;deadline&quot;: null,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: false,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-06T23:30:58.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-06T23:30:58.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Test User&quot;,
                    &quot;email&quot;: &quot;test@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;+1234567890&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: &quot;Test City&quot;,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Home Repairs &amp; Maintenance&quot;,
                    &quot;name_translations&quot;: {
                        &quot;fr&quot;: &quot;R&eacute;parations et Entretien de Maison&quot;,
                        &quot;ar&quot;: &quot;إصلاحات وصيانة المنزل&quot;
                    },
                    &quot;description&quot;: &quot;Professional home repair and maintenance services&quot;,
                    &quot;description_translations&quot;: {
                        &quot;fr&quot;: &quot;Services professionnels de r&eacute;paration et d&#039;entretien de maison&quot;,
                        &quot;ar&quot;: &quot;خدمات إصلاح وصيانة المنزل المهنية&quot;
                    },
                    &quot;icon&quot;: &quot;tools&quot;,
                    &quot;color&quot;: &quot;#3B82F6&quot;,
                    &quot;is_active&quot;: true,
                    &quot;sort_order&quot;: 1,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:41.000000Z&quot;
                },
                &quot;applications&quot;: []
            },
            {
                &quot;id&quot;: 2,
                &quot;title&quot;: &quot;Sample Task 1&quot;,
                &quot;title_translations&quot;: null,
                &quot;description&quot;: &quot;Test task for debugging 404 on show route&quot;,
                &quot;description_translations&quot;: null,
                &quot;client_id&quot;: 2,
                &quot;category_id&quot;: 1,
                &quot;assigned_tasker_id&quot;: null,
                &quot;budget_min&quot;: &quot;50.00&quot;,
                &quot;budget_max&quot;: &quot;100.00&quot;,
                &quot;budget_type&quot;: &quot;fixed&quot;,
                &quot;payment_method&quot;: &quot;cash&quot;,
                &quot;location&quot;: &quot;Test Location&quot;,
                &quot;latitude&quot;: null,
                &quot;longitude&quot;: null,
                &quot;status&quot;: &quot;open&quot;,
                &quot;urgency&quot;: &quot;medium&quot;,
                &quot;deadline&quot;: null,
                &quot;required_skills&quot;: null,
                &quot;images&quot;: null,
                &quot;is_remote&quot;: true,
                &quot;applications_count&quot;: 0,
                &quot;assigned_at&quot;: null,
                &quot;started_at&quot;: null,
                &quot;completed_at&quot;: null,
                &quot;completion_requested_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-08-31T20:12:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-08-31T20:12:42.000000Z&quot;,
                &quot;client&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Test User&quot;,
                    &quot;email&quot;: &quot;test@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
                    &quot;role&quot;: &quot;client&quot;,
                    &quot;phone&quot;: &quot;+1234567890&quot;,
                    &quot;bio&quot;: null,
                    &quot;bio_translations&quot;: null,
                    &quot;profile_image&quot;: null,
                    &quot;city&quot;: &quot;Test City&quot;,
                    &quot;address&quot;: null,
                    &quot;rating&quot;: &quot;0.00&quot;,
                    &quot;total_reviews&quot;: 0,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;is_verified&quot;: false,
                    &quot;verified_at&quot;: null,
                    &quot;skills&quot;: null,
                    &quot;hourly_rate&quot;: null,
                    &quot;available&quot;: true
                },
                &quot;category&quot;: null,
                &quot;applications&quot;: []
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost:8000/api/v1/tasks?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost:8000/api/v1/tasks?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/tasks?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost:8000/api/v1/tasks&quot;,
        &quot;per_page&quot;: 15,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 10,
        &quot;total&quot;: 10
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-tasks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-tasks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tasks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-tasks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tasks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-tasks" data-method="GET"
      data-path="api/v1/tasks"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tasks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-tasks"
                    onclick="tryItOut('GETapi-v1-tasks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-tasks"
                    onclick="cancelTryOut('GETapi-v1-tasks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-tasks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/tasks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-tasks--task_id-">GET api/v1/tasks/{task_id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-tasks--task_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/tasks/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tasks/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-tasks--task_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Sample Task 1&quot;,
        &quot;title_translations&quot;: null,
        &quot;description&quot;: &quot;Test task for debugging 404 on show route&quot;,
        &quot;description_translations&quot;: null,
        &quot;client_id&quot;: 2,
        &quot;category_id&quot;: 1,
        &quot;assigned_tasker_id&quot;: null,
        &quot;budget_min&quot;: &quot;50.00&quot;,
        &quot;budget_max&quot;: &quot;100.00&quot;,
        &quot;budget_type&quot;: &quot;fixed&quot;,
        &quot;payment_method&quot;: &quot;cash&quot;,
        &quot;location&quot;: &quot;Test Location&quot;,
        &quot;latitude&quot;: null,
        &quot;longitude&quot;: null,
        &quot;status&quot;: &quot;open&quot;,
        &quot;urgency&quot;: &quot;medium&quot;,
        &quot;deadline&quot;: null,
        &quot;required_skills&quot;: null,
        &quot;images&quot;: null,
        &quot;is_remote&quot;: true,
        &quot;applications_count&quot;: 0,
        &quot;assigned_at&quot;: null,
        &quot;started_at&quot;: null,
        &quot;completed_at&quot;: null,
        &quot;completion_requested_at&quot;: null,
        &quot;created_at&quot;: &quot;2025-08-31T20:12:42.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-31T20:12:42.000000Z&quot;,
        &quot;client&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Test User&quot;,
            &quot;email&quot;: &quot;test@example.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;created_at&quot;: &quot;2025-08-27T19:43:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-04T19:45:42.000000Z&quot;,
            &quot;role&quot;: &quot;client&quot;,
            &quot;phone&quot;: &quot;+1234567890&quot;,
            &quot;bio&quot;: null,
            &quot;bio_translations&quot;: null,
            &quot;profile_image&quot;: null,
            &quot;city&quot;: &quot;Test City&quot;,
            &quot;address&quot;: null,
            &quot;rating&quot;: &quot;0.00&quot;,
            &quot;total_reviews&quot;: 0,
            &quot;status&quot;: &quot;active&quot;,
            &quot;is_verified&quot;: false,
            &quot;verified_at&quot;: null,
            &quot;skills&quot;: null,
            &quot;hourly_rate&quot;: null,
            &quot;available&quot;: true
        },
        &quot;category&quot;: null,
        &quot;applications&quot;: [],
        &quot;assigned_tasker&quot;: null
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-tasks--task_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-tasks--task_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tasks--task_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-tasks--task_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tasks--task_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-tasks--task_id-" data-method="GET"
      data-path="api/v1/tasks/{task_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tasks--task_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-tasks--task_id-"
                    onclick="tryItOut('GETapi-v1-tasks--task_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-tasks--task_id-"
                    onclick="cancelTryOut('GETapi-v1-tasks--task_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-tasks--task_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/tasks/{task_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="GETapi-v1-tasks--task_id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-cities-regions">Get all regions with their cities</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-cities-regions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/cities/regions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cities/regions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities-regions">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;tanger_tetouan_al_hoceima&quot;: {
            &quot;name&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;name_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;cities&quot;: {
                &quot;tanger&quot;: {
                    &quot;name&quot;: &quot;Tanger&quot;,
                    &quot;name_ar&quot;: &quot;طنجة&quot;
                },
                &quot;tetouan&quot;: {
                    &quot;name&quot;: &quot;T&eacute;touan&quot;,
                    &quot;name_ar&quot;: &quot;تطوان&quot;
                },
                &quot;al_hoceima&quot;: {
                    &quot;name&quot;: &quot;Al Hoce&iuml;ma&quot;,
                    &quot;name_ar&quot;: &quot;الحسيمة&quot;
                },
                &quot;chefchaouen&quot;: {
                    &quot;name&quot;: &quot;Chefchaouen&quot;,
                    &quot;name_ar&quot;: &quot;شفشاون&quot;
                },
                &quot;larache&quot;: {
                    &quot;name&quot;: &quot;Larache&quot;,
                    &quot;name_ar&quot;: &quot;العرائش&quot;
                },
                &quot;ksar_el_kebir&quot;: {
                    &quot;name&quot;: &quot;Ksar El K&eacute;bir&quot;,
                    &quot;name_ar&quot;: &quot;القصر الكبير&quot;
                },
                &quot;ouezzane&quot;: {
                    &quot;name&quot;: &quot;Ouezzane&quot;,
                    &quot;name_ar&quot;: &quot;وزان&quot;
                },
                &quot;fnideq&quot;: {
                    &quot;name&quot;: &quot;Fnideq&quot;,
                    &quot;name_ar&quot;: &quot;الفنيدق&quot;
                },
                &quot;mdiq&quot;: {
                    &quot;name&quot;: &quot;M&#039;diq&quot;,
                    &quot;name_ar&quot;: &quot;المضيق&quot;
                },
                &quot;martil&quot;: {
                    &quot;name&quot;: &quot;Martil&quot;,
                    &quot;name_ar&quot;: &quot;مارتيل&quot;
                },
                &quot;asilah&quot;: {
                    &quot;name&quot;: &quot;Asilah&quot;,
                    &quot;name_ar&quot;: &quot;أصيلة&quot;
                },
                &quot;souk_el_arbaa_du_rharb&quot;: {
                    &quot;name&quot;: &quot;Souk El Arbaa du Rharb&quot;,
                    &quot;name_ar&quot;: &quot;سوق الأربعاء الغرب&quot;
                },
                &quot;bni_bouayach&quot;: {
                    &quot;name&quot;: &quot;Bni Bouayach&quot;,
                    &quot;name_ar&quot;: &quot;بني بوعياش&quot;
                },
                &quot;imzouren&quot;: {
                    &quot;name&quot;: &quot;Imzouren&quot;,
                    &quot;name_ar&quot;: &quot;إمزورن&quot;
                },
                &quot;bni_ansar&quot;: {
                    &quot;name&quot;: &quot;Bni Ansar&quot;,
                    &quot;name_ar&quot;: &quot;بني انصار&quot;
                },
                &quot;zaio&quot;: {
                    &quot;name&quot;: &quot;Za&iuml;o&quot;,
                    &quot;name_ar&quot;: &quot;زايو&quot;
                }
            }
        },
        &quot;oriental&quot;: {
            &quot;name&quot;: &quot;Oriental&quot;,
            &quot;name_ar&quot;: &quot;الشرق&quot;,
            &quot;cities&quot;: {
                &quot;oujda&quot;: {
                    &quot;name&quot;: &quot;Oujda&quot;,
                    &quot;name_ar&quot;: &quot;وجدة&quot;
                },
                &quot;berkane&quot;: {
                    &quot;name&quot;: &quot;Berkane&quot;,
                    &quot;name_ar&quot;: &quot;بركان&quot;
                },
                &quot;nador&quot;: {
                    &quot;name&quot;: &quot;Nador&quot;,
                    &quot;name_ar&quot;: &quot;الناظور&quot;
                },
                &quot;taourirt&quot;: {
                    &quot;name&quot;: &quot;Taourirt&quot;,
                    &quot;name_ar&quot;: &quot;تاوريرت&quot;
                },
                &quot;guercif&quot;: {
                    &quot;name&quot;: &quot;Guercif&quot;,
                    &quot;name_ar&quot;: &quot;جرسيف&quot;
                },
                &quot;figuig&quot;: {
                    &quot;name&quot;: &quot;Figuig&quot;,
                    &quot;name_ar&quot;: &quot;فجيج&quot;
                },
                &quot;driouch&quot;: {
                    &quot;name&quot;: &quot;Driouch&quot;,
                    &quot;name_ar&quot;: &quot;الدريوش&quot;
                },
                &quot;jerada&quot;: {
                    &quot;name&quot;: &quot;Jerada&quot;,
                    &quot;name_ar&quot;: &quot;جرادة&quot;
                },
                &quot;al_aroui&quot;: {
                    &quot;name&quot;: &quot;Al Aroui&quot;,
                    &quot;name_ar&quot;: &quot;العروي&quot;
                },
                &quot;ahfir&quot;: {
                    &quot;name&quot;: &quot;Ahfir&quot;,
                    &quot;name_ar&quot;: &quot;أحفير&quot;
                },
                &quot;beni_drar&quot;: {
                    &quot;name&quot;: &quot;Beni Drar&quot;,
                    &quot;name_ar&quot;: &quot;بني درار&quot;
                },
                &quot;el_aioun_sidi_mellouk&quot;: {
                    &quot;name&quot;: &quot;El Aioun Sidi Mellouk&quot;,
                    &quot;name_ar&quot;: &quot;العيون سيدي ملوك&quot;
                },
                &quot;tendrara&quot;: {
                    &quot;name&quot;: &quot;Tendrara&quot;,
                    &quot;name_ar&quot;: &quot;تندرارة&quot;
                },
                &quot;debdou&quot;: {
                    &quot;name&quot;: &quot;Debdou&quot;,
                    &quot;name_ar&quot;: &quot;دبدو&quot;
                },
                &quot;selouane&quot;: {
                    &quot;name&quot;: &quot;Selouane&quot;,
                    &quot;name_ar&quot;: &quot;سلوان&quot;
                },
                &quot;bni_chiker&quot;: {
                    &quot;name&quot;: &quot;Bni Chiker&quot;,
                    &quot;name_ar&quot;: &quot;بني شيكر&quot;
                },
                &quot;midar&quot;: {
                    &quot;name&quot;: &quot;Midar&quot;,
                    &quot;name_ar&quot;: &quot;ميدار&quot;
                },
                &quot;ras_el_ma&quot;: {
                    &quot;name&quot;: &quot;Ras El Ma&quot;,
                    &quot;name_ar&quot;: &quot;رأس الماء&quot;
                },
                &quot;talsint&quot;: {
                    &quot;name&quot;: &quot;Talsint&quot;,
                    &quot;name_ar&quot;: &quot;تالسينت&quot;
                },
                &quot;bouarfa&quot;: {
                    &quot;name&quot;: &quot;Bouarfa&quot;,
                    &quot;name_ar&quot;: &quot;بوعرفة&quot;
                }
            }
        },
        &quot;fes_meknes&quot;: {
            &quot;name&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;name_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;cities&quot;: {
                &quot;fes&quot;: {
                    &quot;name&quot;: &quot;F&egrave;s&quot;,
                    &quot;name_ar&quot;: &quot;فاس&quot;
                },
                &quot;meknes&quot;: {
                    &quot;name&quot;: &quot;Mekn&egrave;s&quot;,
                    &quot;name_ar&quot;: &quot;مكناس&quot;
                },
                &quot;taza&quot;: {
                    &quot;name&quot;: &quot;Taza&quot;,
                    &quot;name_ar&quot;: &quot;تازة&quot;
                },
                &quot;sefrou&quot;: {
                    &quot;name&quot;: &quot;Sefrou&quot;,
                    &quot;name_ar&quot;: &quot;صفرو&quot;
                },
                &quot;el_hajeb&quot;: {
                    &quot;name&quot;: &quot;El Hajeb&quot;,
                    &quot;name_ar&quot;: &quot;الحاجب&quot;
                },
                &quot;ifrane&quot;: {
                    &quot;name&quot;: &quot;Ifrane&quot;,
                    &quot;name_ar&quot;: &quot;إفران&quot;
                },
                &quot;azrou&quot;: {
                    &quot;name&quot;: &quot;Azrou&quot;,
                    &quot;name_ar&quot;: &quot;أزرو&quot;
                },
                &quot;boulemane&quot;: {
                    &quot;name&quot;: &quot;Boulemane&quot;,
                    &quot;name_ar&quot;: &quot;بولمان&quot;
                },
                &quot;moulay_yacoub&quot;: {
                    &quot;name&quot;: &quot;Moulay Yacoub&quot;,
                    &quot;name_ar&quot;: &quot;مولاي يعقوب&quot;
                },
                &quot;imouzzer_kandar&quot;: {
                    &quot;name&quot;: &quot;Imouzzer Kandar&quot;,
                    &quot;name_ar&quot;: &quot;إموزار كندر&quot;
                },
                &quot;bouknadel&quot;: {
                    &quot;name&quot;: &quot;Bouknadel&quot;,
                    &quot;name_ar&quot;: &quot;بوقنادل&quot;
                },
                &quot;ribat_el_kheir&quot;: {
                    &quot;name&quot;: &quot;Ribat El Kheir&quot;,
                    &quot;name_ar&quot;: &quot;رباط الخير&quot;
                },
                &quot;guigou&quot;: {
                    &quot;name&quot;: &quot;Guigou&quot;,
                    &quot;name_ar&quot;: &quot;كيكو&quot;
                },
                &quot;ain_taoujdate&quot;: {
                    &quot;name&quot;: &quot;A&iuml;n Taoujdate&quot;,
                    &quot;name_ar&quot;: &quot;عين تاوجطات&quot;
                },
                &quot;mrhassiyine&quot;: {
                    &quot;name&quot;: &quot;Mrhassiyine&quot;,
                    &quot;name_ar&quot;: &quot;مرحاسيين&quot;
                },
                &quot;sebt_jamaa&quot;: {
                    &quot;name&quot;: &quot;Sebt Jamaa&quot;,
                    &quot;name_ar&quot;: &quot;سبت جماعة&quot;
                },
                &quot;oulad_tayeb&quot;: {
                    &quot;name&quot;: &quot;Oulad Tayeb&quot;,
                    &quot;name_ar&quot;: &quot;أولاد طيب&quot;
                },
                &quot;sabaa_aiyoun&quot;: {
                    &quot;name&quot;: &quot;Sabaa Aiyoun&quot;,
                    &quot;name_ar&quot;: &quot;سبعة عيون&quot;
                },
                &quot;karia_ba_mohamed&quot;: {
                    &quot;name&quot;: &quot;Karia Ba Mohamed&quot;,
                    &quot;name_ar&quot;: &quot;قرية با محمد&quot;
                },
                &quot;ghouazi&quot;: {
                    &quot;name&quot;: &quot;Ghouazi&quot;,
                    &quot;name_ar&quot;: &quot;غوازي&quot;
                },
                &quot;hattane&quot;: {
                    &quot;name&quot;: &quot;Hattane&quot;,
                    &quot;name_ar&quot;: &quot;حطان&quot;
                },
                &quot;tahla&quot;: {
                    &quot;name&quot;: &quot;Tahla&quot;,
                    &quot;name_ar&quot;: &quot;تاهلة&quot;
                }
            }
        },
        &quot;rabat_sale_kenitra&quot;: {
            &quot;name&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;name_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;cities&quot;: {
                &quot;rabat&quot;: {
                    &quot;name&quot;: &quot;Rabat&quot;,
                    &quot;name_ar&quot;: &quot;الرباط&quot;,
                    &quot;is_capital&quot;: true
                },
                &quot;sale&quot;: {
                    &quot;name&quot;: &quot;Sal&eacute;&quot;,
                    &quot;name_ar&quot;: &quot;سلا&quot;
                },
                &quot;kenitra&quot;: {
                    &quot;name&quot;: &quot;K&eacute;nitra&quot;,
                    &quot;name_ar&quot;: &quot;القنيطرة&quot;
                },
                &quot;temara&quot;: {
                    &quot;name&quot;: &quot;Temara&quot;,
                    &quot;name_ar&quot;: &quot;تمارة&quot;
                },
                &quot;skhirat&quot;: {
                    &quot;name&quot;: &quot;Skhirat&quot;,
                    &quot;name_ar&quot;: &quot;الصخيرات&quot;
                },
                &quot;sidi_kacem&quot;: {
                    &quot;name&quot;: &quot;Sidi Kacem&quot;,
                    &quot;name_ar&quot;: &quot;سيدي قاسم&quot;
                },
                &quot;sidi_slimane&quot;: {
                    &quot;name&quot;: &quot;Sidi Slimane&quot;,
                    &quot;name_ar&quot;: &quot;سيدي سليمان&quot;
                },
                &quot;khemisset&quot;: {
                    &quot;name&quot;: &quot;Kh&eacute;misset&quot;,
                    &quot;name_ar&quot;: &quot;الخميسات&quot;
                },
                &quot;tiflet&quot;: {
                    &quot;name&quot;: &quot;Tiflet&quot;,
                    &quot;name_ar&quot;: &quot;تيفلت&quot;
                },
                &quot;rommani&quot;: {
                    &quot;name&quot;: &quot;Rommani&quot;,
                    &quot;name_ar&quot;: &quot;رماني&quot;
                },
                &quot;sidi_yahya_zaer&quot;: {
                    &quot;name&quot;: &quot;Sidi Yahya Zaer&quot;,
                    &quot;name_ar&quot;: &quot;سيدي يحيى زعير&quot;
                },
                &quot;ain_el_aouda&quot;: {
                    &quot;name&quot;: &quot;A&iuml;n El Aouda&quot;,
                    &quot;name_ar&quot;: &quot;عين العودة&quot;
                },
                &quot;harhoura&quot;: {
                    &quot;name&quot;: &quot;Harhoura&quot;,
                    &quot;name_ar&quot;: &quot;هرهورة&quot;
                },
                &quot;oulmes&quot;: {
                    &quot;name&quot;: &quot;Oulm&egrave;s&quot;,
                    &quot;name_ar&quot;: &quot;ولماس&quot;
                },
                &quot;sidi_allal_el_bahraoui&quot;: {
                    &quot;name&quot;: &quot;Sidi Allal El Bahraoui&quot;,
                    &quot;name_ar&quot;: &quot;سيدي علال البحراوي&quot;
                },
                &quot;sidi_bouknadel&quot;: {
                    &quot;name&quot;: &quot;Sidi Bouknadel&quot;,
                    &quot;name_ar&quot;: &quot;سيدي بوقنادل&quot;
                },
                &quot;sidi_taibi&quot;: {
                    &quot;name&quot;: &quot;Sidi Taibi&quot;,
                    &quot;name_ar&quot;: &quot;سيدي طيبي&quot;
                },
                &quot;arbaoua&quot;: {
                    &quot;name&quot;: &quot;Arbaoua&quot;,
                    &quot;name_ar&quot;: &quot;أرباوة&quot;
                },
                &quot;moulay_bousselham&quot;: {
                    &quot;name&quot;: &quot;Moulay Bousselham&quot;,
                    &quot;name_ar&quot;: &quot;مولاي بوسلهام&quot;
                },
                &quot;beni_malik&quot;: {
                    &quot;name&quot;: &quot;Beni Malik&quot;,
                    &quot;name_ar&quot;: &quot;بني مالك&quot;
                },
                &quot;dar_bel_amri&quot;: {
                    &quot;name&quot;: &quot;Dar Bel Amri&quot;,
                    &quot;name_ar&quot;: &quot;دار بلعمري&quot;
                }
            }
        },
        &quot;beni_mellal_khenifra&quot;: {
            &quot;name&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;name_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;cities&quot;: {
                &quot;beni_mellal&quot;: {
                    &quot;name&quot;: &quot;B&eacute;ni Mellal&quot;,
                    &quot;name_ar&quot;: &quot;بني ملال&quot;
                },
                &quot;khenifra&quot;: {
                    &quot;name&quot;: &quot;Kh&eacute;nifra&quot;,
                    &quot;name_ar&quot;: &quot;خنيفرة&quot;
                },
                &quot;khouribga&quot;: {
                    &quot;name&quot;: &quot;Khouribga&quot;,
                    &quot;name_ar&quot;: &quot;خريبكة&quot;
                },
                &quot;fquih_ben_salah&quot;: {
                    &quot;name&quot;: &quot;Fquih Ben Salah&quot;,
                    &quot;name_ar&quot;: &quot;الفقيه بن صالح&quot;
                },
                &quot;kasba_tadla&quot;: {
                    &quot;name&quot;: &quot;Kasba Tadla&quot;,
                    &quot;name_ar&quot;: &quot;قصبة تادلة&quot;
                },
                &quot;ouaouizeght&quot;: {
                    &quot;name&quot;: &quot;Ouaouizeght&quot;,
                    &quot;name_ar&quot;: &quot;واويزغت&quot;
                },
                &quot;el_ksiba&quot;: {
                    &quot;name&quot;: &quot;El Ksiba&quot;,
                    &quot;name_ar&quot;: &quot;القصيبة&quot;
                },
                &quot;ait_ouchen&quot;: {
                    &quot;name&quot;: &quot;A&iuml;t Ouchen&quot;,
                    &quot;name_ar&quot;: &quot;آيت أوشن&quot;
                },
                &quot;aghbala&quot;: {
                    &quot;name&quot;: &quot;Aghbala&quot;,
                    &quot;name_ar&quot;: &quot;أغبالة&quot;
                },
                &quot;zaouiat_cheikh&quot;: {
                    &quot;name&quot;: &quot;Zaouiat Cheikh&quot;,
                    &quot;name_ar&quot;: &quot;زاوية الشيخ&quot;
                },
                &quot;oulad_ayad&quot;: {
                    &quot;name&quot;: &quot;Oulad Ayad&quot;,
                    &quot;name_ar&quot;: &quot;أولاد عياد&quot;
                },
                &quot;sebt_ait_rahou&quot;: {
                    &quot;name&quot;: &quot;Sebt Ait Rahou&quot;,
                    &quot;name_ar&quot;: &quot;سبت آيت راحو&quot;
                },
                &quot;sidi_jaber&quot;: {
                    &quot;name&quot;: &quot;Sidi Jaber&quot;,
                    &quot;name_ar&quot;: &quot;سيدي جابر&quot;
                },
                &quot;dar_oulad_zidouh&quot;: {
                    &quot;name&quot;: &quot;Dar Oulad Zidouh&quot;,
                    &quot;name_ar&quot;: &quot;دار أولاد زيدوح&quot;
                },
                &quot;bradia&quot;: {
                    &quot;name&quot;: &quot;Bradia&quot;,
                    &quot;name_ar&quot;: &quot;براضية&quot;
                },
                &quot;boujniba&quot;: {
                    &quot;name&quot;: &quot;Boujniba&quot;,
                    &quot;name_ar&quot;: &quot;بوجنيبة&quot;
                },
                &quot;mrirt&quot;: {
                    &quot;name&quot;: &quot;M&#039;rirt&quot;,
                    &quot;name_ar&quot;: &quot;مريرت&quot;
                },
                &quot;tighassaline&quot;: {
                    &quot;name&quot;: &quot;Tighassaline&quot;,
                    &quot;name_ar&quot;: &quot;تيغساليين&quot;
                },
                &quot;ait_ishaq&quot;: {
                    &quot;name&quot;: &quot;Ait Ishaq&quot;,
                    &quot;name_ar&quot;: &quot;آيت إسحاق&quot;
                }
            }
        },
        &quot;casablanca_settat&quot;: {
            &quot;name&quot;: &quot;Casablanca-Settat&quot;,
            &quot;name_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;cities&quot;: {
                &quot;casablanca&quot;: {
                    &quot;name&quot;: &quot;Casablanca&quot;,
                    &quot;name_ar&quot;: &quot;الدار البيضاء&quot;,
                    &quot;is_major&quot;: true
                },
                &quot;settat&quot;: {
                    &quot;name&quot;: &quot;Settat&quot;,
                    &quot;name_ar&quot;: &quot;سطات&quot;
                },
                &quot;mohammedia&quot;: {
                    &quot;name&quot;: &quot;Mohamm&eacute;dia&quot;,
                    &quot;name_ar&quot;: &quot;المحمدية&quot;
                },
                &quot;el_jadida&quot;: {
                    &quot;name&quot;: &quot;El Jadida&quot;,
                    &quot;name_ar&quot;: &quot;الجديدة&quot;
                },
                &quot;benslimane&quot;: {
                    &quot;name&quot;: &quot;Benslimane&quot;,
                    &quot;name_ar&quot;: &quot;بنسليمان&quot;
                },
                &quot;berrechid&quot;: {
                    &quot;name&quot;: &quot;Berrechid&quot;,
                    &quot;name_ar&quot;: &quot;برشيد&quot;
                },
                &quot;sidi_bennour&quot;: {
                    &quot;name&quot;: &quot;Sidi Bennour&quot;,
                    &quot;name_ar&quot;: &quot;سيدي بنور&quot;
                },
                &quot;nouaceur&quot;: {
                    &quot;name&quot;: &quot;Nouaceur&quot;,
                    &quot;name_ar&quot;: &quot;النواصر&quot;
                },
                &quot;mediouna&quot;: {
                    &quot;name&quot;: &quot;M&eacute;diouna&quot;,
                    &quot;name_ar&quot;: &quot;مديونة&quot;
                },
                &quot;lahraouyine&quot;: {
                    &quot;name&quot;: &quot;Lahraouyine&quot;,
                    &quot;name_ar&quot;: &quot;الهراويين&quot;
                },
                &quot;dar_bouazza&quot;: {
                    &quot;name&quot;: &quot;Dar Bouazza&quot;,
                    &quot;name_ar&quot;: &quot;دار بوعزة&quot;
                },
                &quot;ben_ahmed&quot;: {
                    &quot;name&quot;: &quot;Ben Ahmed&quot;,
                    &quot;name_ar&quot;: &quot;بن أحمد&quot;
                },
                &quot;oulad_abbou&quot;: {
                    &quot;name&quot;: &quot;Oulad Abbou&quot;,
                    &quot;name_ar&quot;: &quot;أولاد عبو&quot;
                },
                &quot;zemamra&quot;: {
                    &quot;name&quot;: &quot;Zemamra&quot;,
                    &quot;name_ar&quot;: &quot;زمامرة&quot;
                },
                &quot;oualidia&quot;: {
                    &quot;name&quot;: &quot;Oualidia&quot;,
                    &quot;name_ar&quot;: &quot;الوليدية&quot;
                },
                &quot;azemmour&quot;: {
                    &quot;name&quot;: &quot;Azemmour&quot;,
                    &quot;name_ar&quot;: &quot;أزمور&quot;
                },
                &quot;bir_jdid&quot;: {
                    &quot;name&quot;: &quot;Bir Jdid&quot;,
                    &quot;name_ar&quot;: &quot;بير جديد&quot;
                },
                &quot;el_borouj&quot;: {
                    &quot;name&quot;: &quot;El Borouj&quot;,
                    &quot;name_ar&quot;: &quot;البروج&quot;
                },
                &quot;guisser&quot;: {
                    &quot;name&quot;: &quot;Guisser&quot;,
                    &quot;name_ar&quot;: &quot;كيسر&quot;
                },
                &quot;had_soualem&quot;: {
                    &quot;name&quot;: &quot;Had Soualem&quot;,
                    &quot;name_ar&quot;: &quot;حد السوالم&quot;
                },
                &quot;loulad&quot;: {
                    &quot;name&quot;: &quot;Loulad&quot;,
                    &quot;name_ar&quot;: &quot;لولاد&quot;
                },
                &quot;oulad_hriz_sahel&quot;: {
                    &quot;name&quot;: &quot;Oulad H&#039;Riz Sahel&quot;,
                    &quot;name_ar&quot;: &quot;أولاد حريز الساحل&quot;
                },
                &quot;sidi_rahhal&quot;: {
                    &quot;name&quot;: &quot;Sidi Rahhal&quot;,
                    &quot;name_ar&quot;: &quot;سيدي رحال&quot;
                },
                &quot;tit_mellil&quot;: {
                    &quot;name&quot;: &quot;Tit Mellil&quot;,
                    &quot;name_ar&quot;: &quot;تيط مليل&quot;
                },
                &quot;bejaad&quot;: {
                    &quot;name&quot;: &quot;Bejaad&quot;,
                    &quot;name_ar&quot;: &quot;بجعد&quot;
                }
            }
        },
        &quot;marrakech_safi&quot;: {
            &quot;name&quot;: &quot;Marrakech-Safi&quot;,
            &quot;name_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;cities&quot;: {
                &quot;marrakech&quot;: {
                    &quot;name&quot;: &quot;Marrakech&quot;,
                    &quot;name_ar&quot;: &quot;مراكش&quot;,
                    &quot;is_major&quot;: true
                },
                &quot;safi&quot;: {
                    &quot;name&quot;: &quot;Safi&quot;,
                    &quot;name_ar&quot;: &quot;آسفي&quot;
                },
                &quot;essaouira&quot;: {
                    &quot;name&quot;: &quot;Essaouira&quot;,
                    &quot;name_ar&quot;: &quot;الصويرة&quot;
                },
                &quot;youssoufia&quot;: {
                    &quot;name&quot;: &quot;Youssoufia&quot;,
                    &quot;name_ar&quot;: &quot;اليوسفية&quot;
                },
                &quot;el_kelaa_des_sraghna&quot;: {
                    &quot;name&quot;: &quot;El Kel&acirc;a des Sraghna&quot;,
                    &quot;name_ar&quot;: &quot;قلعة السراغنة&quot;
                },
                &quot;chichaoua&quot;: {
                    &quot;name&quot;: &quot;Chichaoua&quot;,
                    &quot;name_ar&quot;: &quot;شيشاوة&quot;
                },
                &quot;rehamna&quot;: {
                    &quot;name&quot;: &quot;Rehamna&quot;,
                    &quot;name_ar&quot;: &quot;الرحامنة&quot;
                },
                &quot;benguerir&quot;: {
                    &quot;name&quot;: &quot;Bengu&eacute;rir&quot;,
                    &quot;name_ar&quot;: &quot;بنجرير&quot;
                },
                &quot;sidi_bou_othmane&quot;: {
                    &quot;name&quot;: &quot;Sidi Bou Othmane&quot;,
                    &quot;name_ar&quot;: &quot;سيدي بوعثمان&quot;
                },
                &quot;ait_ourir&quot;: {
                    &quot;name&quot;: &quot;Ait Ourir&quot;,
                    &quot;name_ar&quot;: &quot;آيت أورير&quot;
                },
                &quot;tahannaout&quot;: {
                    &quot;name&quot;: &quot;Tahannaout&quot;,
                    &quot;name_ar&quot;: &quot;تحناوت&quot;
                },
                &quot;amizmiz&quot;: {
                    &quot;name&quot;: &quot;Amizmiz&quot;,
                    &quot;name_ar&quot;: &quot;أميزميز&quot;
                },
                &quot;demnate&quot;: {
                    &quot;name&quot;: &quot;Demnate&quot;,
                    &quot;name_ar&quot;: &quot;دمنات&quot;
                },
                &quot;el_kelaa&quot;: {
                    &quot;name&quot;: &quot;El Kela&acirc;&quot;,
                    &quot;name_ar&quot;: &quot;القلعة&quot;
                },
                &quot;sidi_smaiil&quot;: {
                    &quot;name&quot;: &quot;Sidi Smai&#039;il&quot;,
                    &quot;name_ar&quot;: &quot;سيدي اسماعيل&quot;
                },
                &quot;jemaat_shaim&quot;: {
                    &quot;name&quot;: &quot;Jemaat Shaim&quot;,
                    &quot;name_ar&quot;: &quot;جماعة شعيم&quot;
                },
                &quot;sebt_gzoula&quot;: {
                    &quot;name&quot;: &quot;Sebt Gzoula&quot;,
                    &quot;name_ar&quot;: &quot;سبت كزولة&quot;
                },
                &quot;smimou&quot;: {
                    &quot;name&quot;: &quot;Smimou&quot;,
                    &quot;name_ar&quot;: &quot;سميمو&quot;
                },
                &quot;bouabout&quot;: {
                    &quot;name&quot;: &quot;Bouabout&quot;,
                    &quot;name_ar&quot;: &quot;بوعبوط&quot;
                },
                &quot;ighoud&quot;: {
                    &quot;name&quot;: &quot;Ighoud&quot;,
                    &quot;name_ar&quot;: &quot;إغود&quot;
                },
                &quot;laattaouia&quot;: {
                    &quot;name&quot;: &quot;Laattaouia&quot;,
                    &quot;name_ar&quot;: &quot;العطاوية&quot;
                },
                &quot;sidi_abdelkader&quot;: {
                    &quot;name&quot;: &quot;Sidi Abdelkader&quot;,
                    &quot;name_ar&quot;: &quot;سيدي عبد القادر&quot;
                },
                &quot;tamanar&quot;: {
                    &quot;name&quot;: &quot;Tamanar&quot;,
                    &quot;name_ar&quot;: &quot;تامنار&quot;
                },
                &quot;zaouiat_ben_hmida&quot;: {
                    &quot;name&quot;: &quot;Zaouiat Ben Hmida&quot;,
                    &quot;name_ar&quot;: &quot;زاوية بن حميدة&quot;
                }
            }
        },
        &quot;draa_tafilalet&quot;: {
            &quot;name&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;name_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;cities&quot;: {
                &quot;errachidia&quot;: {
                    &quot;name&quot;: &quot;Errachidia&quot;,
                    &quot;name_ar&quot;: &quot;الراشيدية&quot;
                },
                &quot;ouarzazate&quot;: {
                    &quot;name&quot;: &quot;Ouarzazate&quot;,
                    &quot;name_ar&quot;: &quot;ورزازات&quot;
                },
                &quot;tinghir&quot;: {
                    &quot;name&quot;: &quot;Tinghir&quot;,
                    &quot;name_ar&quot;: &quot;تنغير&quot;
                },
                &quot;zagora&quot;: {
                    &quot;name&quot;: &quot;Zagora&quot;,
                    &quot;name_ar&quot;: &quot;زاكورة&quot;
                },
                &quot;midelt&quot;: {
                    &quot;name&quot;: &quot;Midelt&quot;,
                    &quot;name_ar&quot;: &quot;ميدلت&quot;
                },
                &quot;boumalne_dades&quot;: {
                    &quot;name&quot;: &quot;Boumalne Dad&egrave;s&quot;,
                    &quot;name_ar&quot;: &quot;بومالن دادس&quot;
                },
                &quot;kelaat_mgouna&quot;: {
                    &quot;name&quot;: &quot;Kelaat M&#039;Gouna&quot;,
                    &quot;name_ar&quot;: &quot;قلعة مكونة&quot;
                },
                &quot;tinejdad&quot;: {
                    &quot;name&quot;: &quot;Tinejdad&quot;,
                    &quot;name_ar&quot;: &quot;تنجداد&quot;
                },
                &quot;alnif&quot;: {
                    &quot;name&quot;: &quot;Alnif&quot;,
                    &quot;name_ar&quot;: &quot;النيف&quot;
                },
                &quot;jorf&quot;: {
                    &quot;name&quot;: &quot;Jorf&quot;,
                    &quot;name_ar&quot;: &quot;جرف&quot;
                },
                &quot;gourrama&quot;: {
                    &quot;name&quot;: &quot;Gourrama&quot;,
                    &quot;name_ar&quot;: &quot;كورامة&quot;
                },
                &quot;rissani&quot;: {
                    &quot;name&quot;: &quot;Rissani&quot;,
                    &quot;name_ar&quot;: &quot;الريصاني&quot;
                },
                &quot;erfoud&quot;: {
                    &quot;name&quot;: &quot;Erfoud&quot;,
                    &quot;name_ar&quot;: &quot;أرفود&quot;
                },
                &quot;ait_benhaddou&quot;: {
                    &quot;name&quot;: &quot;A&iuml;t Benhaddou&quot;,
                    &quot;name_ar&quot;: &quot;آيت بن حدو&quot;
                },
                &quot;skoura&quot;: {
                    &quot;name&quot;: &quot;Skoura&quot;,
                    &quot;name_ar&quot;: &quot;صكورة&quot;
                },
                &quot;tazarine&quot;: {
                    &quot;name&quot;: &quot;Tazarine&quot;,
                    &quot;name_ar&quot;: &quot;تازارين&quot;
                },
                &quot;nkob&quot;: {
                    &quot;name&quot;: &quot;N&#039;Kob&quot;,
                    &quot;name_ar&quot;: &quot;نقوب&quot;
                },
                &quot;boudnib&quot;: {
                    &quot;name&quot;: &quot;Boudnib&quot;,
                    &quot;name_ar&quot;: &quot;بودنيب&quot;
                },
                &quot;goulmima&quot;: {
                    &quot;name&quot;: &quot;Goulmima&quot;,
                    &quot;name_ar&quot;: &quot;كلميمة&quot;
                },
                &quot;imilchil&quot;: {
                    &quot;name&quot;: &quot;Imilchil&quot;,
                    &quot;name_ar&quot;: &quot;إميلشيل&quot;
                },
                &quot;itzer&quot;: {
                    &quot;name&quot;: &quot;Itzer&quot;,
                    &quot;name_ar&quot;: &quot;إتزر&quot;
                },
                &quot;mssici&quot;: {
                    &quot;name&quot;: &quot;M&#039;ssici&quot;,
                    &quot;name_ar&quot;: &quot;مسيسي&quot;
                },
                &quot;outat_el_haj&quot;: {
                    &quot;name&quot;: &quot;Outat El Haj&quot;,
                    &quot;name_ar&quot;: &quot;وطاط الحاج&quot;
                },
                &quot;zawyat_sidi_hamza&quot;: {
                    &quot;name&quot;: &quot;Zawyat Sidi Hamza&quot;,
                    &quot;name_ar&quot;: &quot;زاوية سيدي حمزة&quot;
                }
            }
        },
        &quot;souss_massa&quot;: {
            &quot;name&quot;: &quot;Souss-Massa&quot;,
            &quot;name_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;cities&quot;: {
                &quot;agadir&quot;: {
                    &quot;name&quot;: &quot;Agadir&quot;,
                    &quot;name_ar&quot;: &quot;أكادير&quot;,
                    &quot;is_major&quot;: true
                },
                &quot;inezgane&quot;: {
                    &quot;name&quot;: &quot;Inezgane&quot;,
                    &quot;name_ar&quot;: &quot;إنزكان&quot;
                },
                &quot;ait_melloul&quot;: {
                    &quot;name&quot;: &quot;A&iuml;t Melloul&quot;,
                    &quot;name_ar&quot;: &quot;آيت ملول&quot;
                },
                &quot;taroudant&quot;: {
                    &quot;name&quot;: &quot;Taroudant&quot;,
                    &quot;name_ar&quot;: &quot;تارودانت&quot;
                },
                &quot;tiznit&quot;: {
                    &quot;name&quot;: &quot;Tiznit&quot;,
                    &quot;name_ar&quot;: &quot;تزنيت&quot;
                },
                &quot;oulad_teima&quot;: {
                    &quot;name&quot;: &quot;Oulad Teima&quot;,
                    &quot;name_ar&quot;: &quot;أولاد تايمة&quot;
                },
                &quot;biougra&quot;: {
                    &quot;name&quot;: &quot;Biougra&quot;,
                    &quot;name_ar&quot;: &quot;بيوكرى&quot;
                },
                &quot;ait_baha&quot;: {
                    &quot;name&quot;: &quot;A&iuml;t Baha&quot;,
                    &quot;name_ar&quot;: &quot;آيت باها&quot;
                },
                &quot;belfaa&quot;: {
                    &quot;name&quot;: &quot;Belfaa&quot;,
                    &quot;name_ar&quot;: &quot;بلفاع&quot;
                },
                &quot;bigoudine&quot;: {
                    &quot;name&quot;: &quot;Bigoudine&quot;,
                    &quot;name_ar&quot;: &quot;بيكودين&quot;
                },
                &quot;bouizakarne&quot;: {
                    &quot;name&quot;: &quot;Bouizakarne&quot;,
                    &quot;name_ar&quot;: &quot;بويزكارن&quot;
                },
                &quot;el_guerdane&quot;: {
                    &quot;name&quot;: &quot;El Guerdane&quot;,
                    &quot;name_ar&quot;: &quot;الكردان&quot;
                },
                &quot;irherm&quot;: {
                    &quot;name&quot;: &quot;Irherm&quot;,
                    &quot;name_ar&quot;: &quot;إرهرم&quot;
                },
                &quot;ouijjane&quot;: {
                    &quot;name&quot;: &quot;Ouijjane&quot;,
                    &quot;name_ar&quot;: &quot;ويجان&quot;
                },
                &quot;sebt_el_guerdane&quot;: {
                    &quot;name&quot;: &quot;Sebt El Guerdane&quot;,
                    &quot;name_ar&quot;: &quot;سبت الكردان&quot;
                },
                &quot;sidi_bibi&quot;: {
                    &quot;name&quot;: &quot;Sidi Bibi&quot;,
                    &quot;name_ar&quot;: &quot;سيدي بيبي&quot;
                },
                &quot;tafraout&quot;: {
                    &quot;name&quot;: &quot;Tafraout&quot;,
                    &quot;name_ar&quot;: &quot;تافراوت&quot;
                },
                &quot;temsia&quot;: {
                    &quot;name&quot;: &quot;Temsia&quot;,
                    &quot;name_ar&quot;: &quot;تمسية&quot;
                },
                &quot;chtouka_ait_baha&quot;: {
                    &quot;name&quot;: &quot;Chtouka-A&iuml;t Baha&quot;,
                    &quot;name_ar&quot;: &quot;شتوكة آيت باها&quot;
                }
            }
        },
        &quot;guelmim_oued_noun&quot;: {
            &quot;name&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;name_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;cities&quot;: {
                &quot;guelmim&quot;: {
                    &quot;name&quot;: &quot;Guelmim&quot;,
                    &quot;name_ar&quot;: &quot;كلميم&quot;
                },
                &quot;sidi_ifni&quot;: {
                    &quot;name&quot;: &quot;Sidi Ifni&quot;,
                    &quot;name_ar&quot;: &quot;سيدي إفني&quot;
                },
                &quot;tan_tan&quot;: {
                    &quot;name&quot;: &quot;Tan-Tan&quot;,
                    &quot;name_ar&quot;: &quot;طانطان&quot;
                },
                &quot;assa&quot;: {
                    &quot;name&quot;: &quot;Assa&quot;,
                    &quot;name_ar&quot;: &quot;أسا&quot;
                },
                &quot;fam_el_hisn&quot;: {
                    &quot;name&quot;: &quot;Fam El Hisn&quot;,
                    &quot;name_ar&quot;: &quot;فم الحصن&quot;
                },
                &quot;taghjijt&quot;: {
                    &quot;name&quot;: &quot;Taghjijt&quot;,
                    &quot;name_ar&quot;: &quot;تاغجيجت&quot;
                },
                &quot;mirleft&quot;: {
                    &quot;name&quot;: &quot;Mirleft&quot;,
                    &quot;name_ar&quot;: &quot;ميرلفت&quot;
                },
                &quot;akka&quot;: {
                    &quot;name&quot;: &quot;Akka&quot;,
                    &quot;name_ar&quot;: &quot;أقا&quot;
                },
                &quot;tata&quot;: {
                    &quot;name&quot;: &quot;Tata&quot;,
                    &quot;name_ar&quot;: &quot;طاطا&quot;
                }
            }
        },
        &quot;laayoune_sakia_el_hamra&quot;: {
            &quot;name&quot;: &quot;La&acirc;youne-Sakia El Hamra&quot;,
            &quot;name_ar&quot;: &quot;العيون الساقية الحمراء&quot;,
            &quot;cities&quot;: {
                &quot;laayoune&quot;: {
                    &quot;name&quot;: &quot;La&acirc;youne&quot;,
                    &quot;name_ar&quot;: &quot;العيون&quot;
                },
                &quot;boujdour&quot;: {
                    &quot;name&quot;: &quot;Boujdour&quot;,
                    &quot;name_ar&quot;: &quot;بوجدور&quot;
                },
                &quot;tarfaya&quot;: {
                    &quot;name&quot;: &quot;Tarfaya&quot;,
                    &quot;name_ar&quot;: &quot;طرفاية&quot;
                },
                &quot;smara&quot;: {
                    &quot;name&quot;: &quot;Smara&quot;,
                    &quot;name_ar&quot;: &quot;السمارة&quot;
                },
                &quot;el_marsa&quot;: {
                    &quot;name&quot;: &quot;El Marsa&quot;,
                    &quot;name_ar&quot;: &quot;المرسى&quot;
                }
            }
        },
        &quot;dakhla_oued_ed_dahab&quot;: {
            &quot;name&quot;: &quot;Dakhla-Oued Ed-Dahab&quot;,
            &quot;name_ar&quot;: &quot;الداخلة وادي الذهب&quot;,
            &quot;cities&quot;: {
                &quot;dakhla&quot;: {
                    &quot;name&quot;: &quot;Dakhla&quot;,
                    &quot;name_ar&quot;: &quot;الداخلة&quot;
                },
                &quot;aousserd&quot;: {
                    &quot;name&quot;: &quot;Aousserd&quot;,
                    &quot;name_ar&quot;: &quot;أوسرد&quot;
                },
                &quot;bir_gandouz&quot;: {
                    &quot;name&quot;: &quot;Bir Gandouz&quot;,
                    &quot;name_ar&quot;: &quot;بير كندوز&quot;
                },
                &quot;guerguerat&quot;: {
                    &quot;name&quot;: &quot;Guerguerat&quot;,
                    &quot;name_ar&quot;: &quot;الكركرات&quot;
                }
            }
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cities-regions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities-regions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities-regions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities-regions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities-regions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities-regions" data-method="GET"
      data-path="api/v1/cities/regions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities-regions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities-regions"
                    onclick="tryItOut('GETapi-v1-cities-regions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities-regions"
                    onclick="cancelTryOut('GETapi-v1-cities-regions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities-regions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities/regions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cities-regions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cities-regions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-cities-major">Get major cities</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-cities-major">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/cities/major" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cities/major"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities-major">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;casablanca&quot;: {
            &quot;name&quot;: &quot;Casablanca&quot;,
            &quot;name_ar&quot;: &quot;الدار البيضاء&quot;,
            &quot;region&quot;: &quot;casablanca_settat&quot;
        },
        &quot;rabat&quot;: {
            &quot;name&quot;: &quot;Rabat&quot;,
            &quot;name_ar&quot;: &quot;الرباط&quot;,
            &quot;region&quot;: &quot;rabat_sale_kenitra&quot;,
            &quot;is_capital&quot;: true
        },
        &quot;marrakech&quot;: {
            &quot;name&quot;: &quot;Marrakech&quot;,
            &quot;name_ar&quot;: &quot;مراكش&quot;,
            &quot;region&quot;: &quot;marrakech_safi&quot;
        },
        &quot;fes&quot;: {
            &quot;name&quot;: &quot;F&egrave;s&quot;,
            &quot;name_ar&quot;: &quot;فاس&quot;,
            &quot;region&quot;: &quot;fes_meknes&quot;
        },
        &quot;tanger&quot;: {
            &quot;name&quot;: &quot;Tanger&quot;,
            &quot;name_ar&quot;: &quot;طنجة&quot;,
            &quot;region&quot;: &quot;tanger_tetouan_al_hoceima&quot;
        },
        &quot;agadir&quot;: {
            &quot;name&quot;: &quot;Agadir&quot;,
            &quot;name_ar&quot;: &quot;أكادير&quot;,
            &quot;region&quot;: &quot;souss_massa&quot;
        },
        &quot;meknes&quot;: {
            &quot;name&quot;: &quot;Mekn&egrave;s&quot;,
            &quot;name_ar&quot;: &quot;مكناس&quot;,
            &quot;region&quot;: &quot;fes_meknes&quot;
        },
        &quot;oujda&quot;: {
            &quot;name&quot;: &quot;Oujda&quot;,
            &quot;name_ar&quot;: &quot;وجدة&quot;,
            &quot;region&quot;: &quot;oriental&quot;
        },
        &quot;kenitra&quot;: {
            &quot;name&quot;: &quot;K&eacute;nitra&quot;,
            &quot;name_ar&quot;: &quot;القنيطرة&quot;,
            &quot;region&quot;: &quot;rabat_sale_kenitra&quot;
        },
        &quot;tetouan&quot;: {
            &quot;name&quot;: &quot;T&eacute;touan&quot;,
            &quot;name_ar&quot;: &quot;تطوان&quot;,
            &quot;region&quot;: &quot;tanger_tetouan_al_hoceima&quot;
        },
        &quot;safi&quot;: {
            &quot;name&quot;: &quot;Safi&quot;,
            &quot;name_ar&quot;: &quot;آسفي&quot;,
            &quot;region&quot;: &quot;marrakech_safi&quot;
        },
        &quot;mohammedia&quot;: {
            &quot;name&quot;: &quot;Mohamm&eacute;dia&quot;,
            &quot;name_ar&quot;: &quot;المحمدية&quot;,
            &quot;region&quot;: &quot;casablanca_settat&quot;
        },
        &quot;khouribga&quot;: {
            &quot;name&quot;: &quot;Khouribga&quot;,
            &quot;name_ar&quot;: &quot;خريبكة&quot;,
            &quot;region&quot;: &quot;beni_mellal_khenifra&quot;
        },
        &quot;beni_mellal&quot;: {
            &quot;name&quot;: &quot;B&eacute;ni Mellal&quot;,
            &quot;name_ar&quot;: &quot;بني ملال&quot;,
            &quot;region&quot;: &quot;beni_mellal_khenifra&quot;
        },
        &quot;el_jadida&quot;: {
            &quot;name&quot;: &quot;El Jadida&quot;,
            &quot;name_ar&quot;: &quot;الجديدة&quot;,
            &quot;region&quot;: &quot;casablanca_settat&quot;
        },
        &quot;taza&quot;: {
            &quot;name&quot;: &quot;Taza&quot;,
            &quot;name_ar&quot;: &quot;تازة&quot;,
            &quot;region&quot;: &quot;fes_meknes&quot;
        },
        &quot;nador&quot;: {
            &quot;name&quot;: &quot;Nador&quot;,
            &quot;name_ar&quot;: &quot;الناظور&quot;,
            &quot;region&quot;: &quot;oriental&quot;
        },
        &quot;settat&quot;: {
            &quot;name&quot;: &quot;Settat&quot;,
            &quot;name_ar&quot;: &quot;سطات&quot;,
            &quot;region&quot;: &quot;casablanca_settat&quot;
        },
        &quot;larache&quot;: {
            &quot;name&quot;: &quot;Larache&quot;,
            &quot;name_ar&quot;: &quot;العرائش&quot;,
            &quot;region&quot;: &quot;tanger_tetouan_al_hoceima&quot;
        },
        &quot;khenifra&quot;: {
            &quot;name&quot;: &quot;Kh&eacute;nifra&quot;,
            &quot;name_ar&quot;: &quot;خنيفرة&quot;,
            &quot;region&quot;: &quot;beni_mellal_khenifra&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cities-major" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities-major"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities-major"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities-major" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities-major">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities-major" data-method="GET"
      data-path="api/v1/cities/major"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities-major', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities-major"
                    onclick="tryItOut('GETapi-v1-cities-major');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities-major"
                    onclick="cancelTryOut('GETapi-v1-cities-major');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities-major"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities/major</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cities-major"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cities-major"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-cities-all">Get all cities as a flat list (for dropdowns)</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-cities-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/cities/all" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cities/all"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities-all">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;key&quot;: &quot;tanger&quot;,
            &quot;name&quot;: &quot;Tanger&quot;,
            &quot;name_ar&quot;: &quot;طنجة&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;tetouan&quot;,
            &quot;name&quot;: &quot;T&eacute;touan&quot;,
            &quot;name_ar&quot;: &quot;تطوان&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;al_hoceima&quot;,
            &quot;name&quot;: &quot;Al Hoce&iuml;ma&quot;,
            &quot;name_ar&quot;: &quot;الحسيمة&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;chefchaouen&quot;,
            &quot;name&quot;: &quot;Chefchaouen&quot;,
            &quot;name_ar&quot;: &quot;شفشاون&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;larache&quot;,
            &quot;name&quot;: &quot;Larache&quot;,
            &quot;name_ar&quot;: &quot;العرائش&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;ksar_el_kebir&quot;,
            &quot;name&quot;: &quot;Ksar El K&eacute;bir&quot;,
            &quot;name_ar&quot;: &quot;القصر الكبير&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ouezzane&quot;,
            &quot;name&quot;: &quot;Ouezzane&quot;,
            &quot;name_ar&quot;: &quot;وزان&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;fnideq&quot;,
            &quot;name&quot;: &quot;Fnideq&quot;,
            &quot;name_ar&quot;: &quot;الفنيدق&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;mdiq&quot;,
            &quot;name&quot;: &quot;M&#039;diq&quot;,
            &quot;name_ar&quot;: &quot;المضيق&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;martil&quot;,
            &quot;name&quot;: &quot;Martil&quot;,
            &quot;name_ar&quot;: &quot;مارتيل&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;asilah&quot;,
            &quot;name&quot;: &quot;Asilah&quot;,
            &quot;name_ar&quot;: &quot;أصيلة&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;souk_el_arbaa_du_rharb&quot;,
            &quot;name&quot;: &quot;Souk El Arbaa du Rharb&quot;,
            &quot;name_ar&quot;: &quot;سوق الأربعاء الغرب&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bni_bouayach&quot;,
            &quot;name&quot;: &quot;Bni Bouayach&quot;,
            &quot;name_ar&quot;: &quot;بني بوعياش&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;imzouren&quot;,
            &quot;name&quot;: &quot;Imzouren&quot;,
            &quot;name_ar&quot;: &quot;إمزورن&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bni_ansar&quot;,
            &quot;name&quot;: &quot;Bni Ansar&quot;,
            &quot;name_ar&quot;: &quot;بني انصار&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;zaio&quot;,
            &quot;name&quot;: &quot;Za&iuml;o&quot;,
            &quot;name_ar&quot;: &quot;زايو&quot;,
            &quot;region&quot;: &quot;Tanger-T&eacute;touan-Al Hoce&iuml;ma&quot;,
            &quot;region_ar&quot;: &quot;طنجة تطوان الحسيمة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oujda&quot;,
            &quot;name&quot;: &quot;Oujda&quot;,
            &quot;name_ar&quot;: &quot;وجدة&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;berkane&quot;,
            &quot;name&quot;: &quot;Berkane&quot;,
            &quot;name_ar&quot;: &quot;بركان&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;nador&quot;,
            &quot;name&quot;: &quot;Nador&quot;,
            &quot;name_ar&quot;: &quot;الناظور&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;taourirt&quot;,
            &quot;name&quot;: &quot;Taourirt&quot;,
            &quot;name_ar&quot;: &quot;تاوريرت&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;guercif&quot;,
            &quot;name&quot;: &quot;Guercif&quot;,
            &quot;name_ar&quot;: &quot;جرسيف&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;figuig&quot;,
            &quot;name&quot;: &quot;Figuig&quot;,
            &quot;name_ar&quot;: &quot;فجيج&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;driouch&quot;,
            &quot;name&quot;: &quot;Driouch&quot;,
            &quot;name_ar&quot;: &quot;الدريوش&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;jerada&quot;,
            &quot;name&quot;: &quot;Jerada&quot;,
            &quot;name_ar&quot;: &quot;جرادة&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;al_aroui&quot;,
            &quot;name&quot;: &quot;Al Aroui&quot;,
            &quot;name_ar&quot;: &quot;العروي&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ahfir&quot;,
            &quot;name&quot;: &quot;Ahfir&quot;,
            &quot;name_ar&quot;: &quot;أحفير&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;beni_drar&quot;,
            &quot;name&quot;: &quot;Beni Drar&quot;,
            &quot;name_ar&quot;: &quot;بني درار&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_aioun_sidi_mellouk&quot;,
            &quot;name&quot;: &quot;El Aioun Sidi Mellouk&quot;,
            &quot;name_ar&quot;: &quot;العيون سيدي ملوك&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tendrara&quot;,
            &quot;name&quot;: &quot;Tendrara&quot;,
            &quot;name_ar&quot;: &quot;تندرارة&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;debdou&quot;,
            &quot;name&quot;: &quot;Debdou&quot;,
            &quot;name_ar&quot;: &quot;دبدو&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;selouane&quot;,
            &quot;name&quot;: &quot;Selouane&quot;,
            &quot;name_ar&quot;: &quot;سلوان&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bni_chiker&quot;,
            &quot;name&quot;: &quot;Bni Chiker&quot;,
            &quot;name_ar&quot;: &quot;بني شيكر&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;midar&quot;,
            &quot;name&quot;: &quot;Midar&quot;,
            &quot;name_ar&quot;: &quot;ميدار&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ras_el_ma&quot;,
            &quot;name&quot;: &quot;Ras El Ma&quot;,
            &quot;name_ar&quot;: &quot;رأس الماء&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;talsint&quot;,
            &quot;name&quot;: &quot;Talsint&quot;,
            &quot;name_ar&quot;: &quot;تالسينت&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bouarfa&quot;,
            &quot;name&quot;: &quot;Bouarfa&quot;,
            &quot;name_ar&quot;: &quot;بوعرفة&quot;,
            &quot;region&quot;: &quot;Oriental&quot;,
            &quot;region_ar&quot;: &quot;الشرق&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;fes&quot;,
            &quot;name&quot;: &quot;F&egrave;s&quot;,
            &quot;name_ar&quot;: &quot;فاس&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;meknes&quot;,
            &quot;name&quot;: &quot;Mekn&egrave;s&quot;,
            &quot;name_ar&quot;: &quot;مكناس&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;taza&quot;,
            &quot;name&quot;: &quot;Taza&quot;,
            &quot;name_ar&quot;: &quot;تازة&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;sefrou&quot;,
            &quot;name&quot;: &quot;Sefrou&quot;,
            &quot;name_ar&quot;: &quot;صفرو&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_hajeb&quot;,
            &quot;name&quot;: &quot;El Hajeb&quot;,
            &quot;name_ar&quot;: &quot;الحاجب&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ifrane&quot;,
            &quot;name&quot;: &quot;Ifrane&quot;,
            &quot;name_ar&quot;: &quot;إفران&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;azrou&quot;,
            &quot;name&quot;: &quot;Azrou&quot;,
            &quot;name_ar&quot;: &quot;أزرو&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;boulemane&quot;,
            &quot;name&quot;: &quot;Boulemane&quot;,
            &quot;name_ar&quot;: &quot;بولمان&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;moulay_yacoub&quot;,
            &quot;name&quot;: &quot;Moulay Yacoub&quot;,
            &quot;name_ar&quot;: &quot;مولاي يعقوب&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;imouzzer_kandar&quot;,
            &quot;name&quot;: &quot;Imouzzer Kandar&quot;,
            &quot;name_ar&quot;: &quot;إموزار كندر&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bouknadel&quot;,
            &quot;name&quot;: &quot;Bouknadel&quot;,
            &quot;name_ar&quot;: &quot;بوقنادل&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ribat_el_kheir&quot;,
            &quot;name&quot;: &quot;Ribat El Kheir&quot;,
            &quot;name_ar&quot;: &quot;رباط الخير&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;guigou&quot;,
            &quot;name&quot;: &quot;Guigou&quot;,
            &quot;name_ar&quot;: &quot;كيكو&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ain_taoujdate&quot;,
            &quot;name&quot;: &quot;A&iuml;n Taoujdate&quot;,
            &quot;name_ar&quot;: &quot;عين تاوجطات&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;mrhassiyine&quot;,
            &quot;name&quot;: &quot;Mrhassiyine&quot;,
            &quot;name_ar&quot;: &quot;مرحاسيين&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sebt_jamaa&quot;,
            &quot;name&quot;: &quot;Sebt Jamaa&quot;,
            &quot;name_ar&quot;: &quot;سبت جماعة&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oulad_tayeb&quot;,
            &quot;name&quot;: &quot;Oulad Tayeb&quot;,
            &quot;name_ar&quot;: &quot;أولاد طيب&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sabaa_aiyoun&quot;,
            &quot;name&quot;: &quot;Sabaa Aiyoun&quot;,
            &quot;name_ar&quot;: &quot;سبعة عيون&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;karia_ba_mohamed&quot;,
            &quot;name&quot;: &quot;Karia Ba Mohamed&quot;,
            &quot;name_ar&quot;: &quot;قرية با محمد&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ghouazi&quot;,
            &quot;name&quot;: &quot;Ghouazi&quot;,
            &quot;name_ar&quot;: &quot;غوازي&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;hattane&quot;,
            &quot;name&quot;: &quot;Hattane&quot;,
            &quot;name_ar&quot;: &quot;حطان&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tahla&quot;,
            &quot;name&quot;: &quot;Tahla&quot;,
            &quot;name_ar&quot;: &quot;تاهلة&quot;,
            &quot;region&quot;: &quot;F&egrave;s-Mekn&egrave;s&quot;,
            &quot;region_ar&quot;: &quot;فاس مكناس&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;rabat&quot;,
            &quot;name&quot;: &quot;Rabat&quot;,
            &quot;name_ar&quot;: &quot;الرباط&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;sale&quot;,
            &quot;name&quot;: &quot;Sal&eacute;&quot;,
            &quot;name_ar&quot;: &quot;سلا&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;kenitra&quot;,
            &quot;name&quot;: &quot;K&eacute;nitra&quot;,
            &quot;name_ar&quot;: &quot;القنيطرة&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;temara&quot;,
            &quot;name&quot;: &quot;Temara&quot;,
            &quot;name_ar&quot;: &quot;تمارة&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;skhirat&quot;,
            &quot;name&quot;: &quot;Skhirat&quot;,
            &quot;name_ar&quot;: &quot;الصخيرات&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_kacem&quot;,
            &quot;name&quot;: &quot;Sidi Kacem&quot;,
            &quot;name_ar&quot;: &quot;سيدي قاسم&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_slimane&quot;,
            &quot;name&quot;: &quot;Sidi Slimane&quot;,
            &quot;name_ar&quot;: &quot;سيدي سليمان&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;khemisset&quot;,
            &quot;name&quot;: &quot;Kh&eacute;misset&quot;,
            &quot;name_ar&quot;: &quot;الخميسات&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tiflet&quot;,
            &quot;name&quot;: &quot;Tiflet&quot;,
            &quot;name_ar&quot;: &quot;تيفلت&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;rommani&quot;,
            &quot;name&quot;: &quot;Rommani&quot;,
            &quot;name_ar&quot;: &quot;رماني&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_yahya_zaer&quot;,
            &quot;name&quot;: &quot;Sidi Yahya Zaer&quot;,
            &quot;name_ar&quot;: &quot;سيدي يحيى زعير&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ain_el_aouda&quot;,
            &quot;name&quot;: &quot;A&iuml;n El Aouda&quot;,
            &quot;name_ar&quot;: &quot;عين العودة&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;harhoura&quot;,
            &quot;name&quot;: &quot;Harhoura&quot;,
            &quot;name_ar&quot;: &quot;هرهورة&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oulmes&quot;,
            &quot;name&quot;: &quot;Oulm&egrave;s&quot;,
            &quot;name_ar&quot;: &quot;ولماس&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_allal_el_bahraoui&quot;,
            &quot;name&quot;: &quot;Sidi Allal El Bahraoui&quot;,
            &quot;name_ar&quot;: &quot;سيدي علال البحراوي&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_bouknadel&quot;,
            &quot;name&quot;: &quot;Sidi Bouknadel&quot;,
            &quot;name_ar&quot;: &quot;سيدي بوقنادل&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_taibi&quot;,
            &quot;name&quot;: &quot;Sidi Taibi&quot;,
            &quot;name_ar&quot;: &quot;سيدي طيبي&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;arbaoua&quot;,
            &quot;name&quot;: &quot;Arbaoua&quot;,
            &quot;name_ar&quot;: &quot;أرباوة&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;moulay_bousselham&quot;,
            &quot;name&quot;: &quot;Moulay Bousselham&quot;,
            &quot;name_ar&quot;: &quot;مولاي بوسلهام&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;beni_malik&quot;,
            &quot;name&quot;: &quot;Beni Malik&quot;,
            &quot;name_ar&quot;: &quot;بني مالك&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;dar_bel_amri&quot;,
            &quot;name&quot;: &quot;Dar Bel Amri&quot;,
            &quot;name_ar&quot;: &quot;دار بلعمري&quot;,
            &quot;region&quot;: &quot;Rabat-Sal&eacute;-K&eacute;nitra&quot;,
            &quot;region_ar&quot;: &quot;الرباط سلا القنيطرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;beni_mellal&quot;,
            &quot;name&quot;: &quot;B&eacute;ni Mellal&quot;,
            &quot;name_ar&quot;: &quot;بني ملال&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;khenifra&quot;,
            &quot;name&quot;: &quot;Kh&eacute;nifra&quot;,
            &quot;name_ar&quot;: &quot;خنيفرة&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;khouribga&quot;,
            &quot;name&quot;: &quot;Khouribga&quot;,
            &quot;name_ar&quot;: &quot;خريبكة&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;fquih_ben_salah&quot;,
            &quot;name&quot;: &quot;Fquih Ben Salah&quot;,
            &quot;name_ar&quot;: &quot;الفقيه بن صالح&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;kasba_tadla&quot;,
            &quot;name&quot;: &quot;Kasba Tadla&quot;,
            &quot;name_ar&quot;: &quot;قصبة تادلة&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ouaouizeght&quot;,
            &quot;name&quot;: &quot;Ouaouizeght&quot;,
            &quot;name_ar&quot;: &quot;واويزغت&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_ksiba&quot;,
            &quot;name&quot;: &quot;El Ksiba&quot;,
            &quot;name_ar&quot;: &quot;القصيبة&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ait_ouchen&quot;,
            &quot;name&quot;: &quot;A&iuml;t Ouchen&quot;,
            &quot;name_ar&quot;: &quot;آيت أوشن&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;aghbala&quot;,
            &quot;name&quot;: &quot;Aghbala&quot;,
            &quot;name_ar&quot;: &quot;أغبالة&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;zaouiat_cheikh&quot;,
            &quot;name&quot;: &quot;Zaouiat Cheikh&quot;,
            &quot;name_ar&quot;: &quot;زاوية الشيخ&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oulad_ayad&quot;,
            &quot;name&quot;: &quot;Oulad Ayad&quot;,
            &quot;name_ar&quot;: &quot;أولاد عياد&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sebt_ait_rahou&quot;,
            &quot;name&quot;: &quot;Sebt Ait Rahou&quot;,
            &quot;name_ar&quot;: &quot;سبت آيت راحو&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_jaber&quot;,
            &quot;name&quot;: &quot;Sidi Jaber&quot;,
            &quot;name_ar&quot;: &quot;سيدي جابر&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;dar_oulad_zidouh&quot;,
            &quot;name&quot;: &quot;Dar Oulad Zidouh&quot;,
            &quot;name_ar&quot;: &quot;دار أولاد زيدوح&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bradia&quot;,
            &quot;name&quot;: &quot;Bradia&quot;,
            &quot;name_ar&quot;: &quot;براضية&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;boujniba&quot;,
            &quot;name&quot;: &quot;Boujniba&quot;,
            &quot;name_ar&quot;: &quot;بوجنيبة&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;mrirt&quot;,
            &quot;name&quot;: &quot;M&#039;rirt&quot;,
            &quot;name_ar&quot;: &quot;مريرت&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tighassaline&quot;,
            &quot;name&quot;: &quot;Tighassaline&quot;,
            &quot;name_ar&quot;: &quot;تيغساليين&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ait_ishaq&quot;,
            &quot;name&quot;: &quot;Ait Ishaq&quot;,
            &quot;name_ar&quot;: &quot;آيت إسحاق&quot;,
            &quot;region&quot;: &quot;B&eacute;ni Mellal-Kh&eacute;nifra&quot;,
            &quot;region_ar&quot;: &quot;بني ملال خنيفرة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;casablanca&quot;,
            &quot;name&quot;: &quot;Casablanca&quot;,
            &quot;name_ar&quot;: &quot;الدار البيضاء&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;settat&quot;,
            &quot;name&quot;: &quot;Settat&quot;,
            &quot;name_ar&quot;: &quot;سطات&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;mohammedia&quot;,
            &quot;name&quot;: &quot;Mohamm&eacute;dia&quot;,
            &quot;name_ar&quot;: &quot;المحمدية&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;el_jadida&quot;,
            &quot;name&quot;: &quot;El Jadida&quot;,
            &quot;name_ar&quot;: &quot;الجديدة&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;benslimane&quot;,
            &quot;name&quot;: &quot;Benslimane&quot;,
            &quot;name_ar&quot;: &quot;بنسليمان&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;berrechid&quot;,
            &quot;name&quot;: &quot;Berrechid&quot;,
            &quot;name_ar&quot;: &quot;برشيد&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_bennour&quot;,
            &quot;name&quot;: &quot;Sidi Bennour&quot;,
            &quot;name_ar&quot;: &quot;سيدي بنور&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;nouaceur&quot;,
            &quot;name&quot;: &quot;Nouaceur&quot;,
            &quot;name_ar&quot;: &quot;النواصر&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;mediouna&quot;,
            &quot;name&quot;: &quot;M&eacute;diouna&quot;,
            &quot;name_ar&quot;: &quot;مديونة&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;lahraouyine&quot;,
            &quot;name&quot;: &quot;Lahraouyine&quot;,
            &quot;name_ar&quot;: &quot;الهراويين&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;dar_bouazza&quot;,
            &quot;name&quot;: &quot;Dar Bouazza&quot;,
            &quot;name_ar&quot;: &quot;دار بوعزة&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ben_ahmed&quot;,
            &quot;name&quot;: &quot;Ben Ahmed&quot;,
            &quot;name_ar&quot;: &quot;بن أحمد&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oulad_abbou&quot;,
            &quot;name&quot;: &quot;Oulad Abbou&quot;,
            &quot;name_ar&quot;: &quot;أولاد عبو&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;zemamra&quot;,
            &quot;name&quot;: &quot;Zemamra&quot;,
            &quot;name_ar&quot;: &quot;زمامرة&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oualidia&quot;,
            &quot;name&quot;: &quot;Oualidia&quot;,
            &quot;name_ar&quot;: &quot;الوليدية&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;azemmour&quot;,
            &quot;name&quot;: &quot;Azemmour&quot;,
            &quot;name_ar&quot;: &quot;أزمور&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bir_jdid&quot;,
            &quot;name&quot;: &quot;Bir Jdid&quot;,
            &quot;name_ar&quot;: &quot;بير جديد&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_borouj&quot;,
            &quot;name&quot;: &quot;El Borouj&quot;,
            &quot;name_ar&quot;: &quot;البروج&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;guisser&quot;,
            &quot;name&quot;: &quot;Guisser&quot;,
            &quot;name_ar&quot;: &quot;كيسر&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;had_soualem&quot;,
            &quot;name&quot;: &quot;Had Soualem&quot;,
            &quot;name_ar&quot;: &quot;حد السوالم&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;loulad&quot;,
            &quot;name&quot;: &quot;Loulad&quot;,
            &quot;name_ar&quot;: &quot;لولاد&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oulad_hriz_sahel&quot;,
            &quot;name&quot;: &quot;Oulad H&#039;Riz Sahel&quot;,
            &quot;name_ar&quot;: &quot;أولاد حريز الساحل&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_rahhal&quot;,
            &quot;name&quot;: &quot;Sidi Rahhal&quot;,
            &quot;name_ar&quot;: &quot;سيدي رحال&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tit_mellil&quot;,
            &quot;name&quot;: &quot;Tit Mellil&quot;,
            &quot;name_ar&quot;: &quot;تيط مليل&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bejaad&quot;,
            &quot;name&quot;: &quot;Bejaad&quot;,
            &quot;name_ar&quot;: &quot;بجعد&quot;,
            &quot;region&quot;: &quot;Casablanca-Settat&quot;,
            &quot;region_ar&quot;: &quot;الدار البيضاء سطات&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;marrakech&quot;,
            &quot;name&quot;: &quot;Marrakech&quot;,
            &quot;name_ar&quot;: &quot;مراكش&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;safi&quot;,
            &quot;name&quot;: &quot;Safi&quot;,
            &quot;name_ar&quot;: &quot;آسفي&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;essaouira&quot;,
            &quot;name&quot;: &quot;Essaouira&quot;,
            &quot;name_ar&quot;: &quot;الصويرة&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;youssoufia&quot;,
            &quot;name&quot;: &quot;Youssoufia&quot;,
            &quot;name_ar&quot;: &quot;اليوسفية&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_kelaa_des_sraghna&quot;,
            &quot;name&quot;: &quot;El Kel&acirc;a des Sraghna&quot;,
            &quot;name_ar&quot;: &quot;قلعة السراغنة&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;chichaoua&quot;,
            &quot;name&quot;: &quot;Chichaoua&quot;,
            &quot;name_ar&quot;: &quot;شيشاوة&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;rehamna&quot;,
            &quot;name&quot;: &quot;Rehamna&quot;,
            &quot;name_ar&quot;: &quot;الرحامنة&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;benguerir&quot;,
            &quot;name&quot;: &quot;Bengu&eacute;rir&quot;,
            &quot;name_ar&quot;: &quot;بنجرير&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_bou_othmane&quot;,
            &quot;name&quot;: &quot;Sidi Bou Othmane&quot;,
            &quot;name_ar&quot;: &quot;سيدي بوعثمان&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ait_ourir&quot;,
            &quot;name&quot;: &quot;Ait Ourir&quot;,
            &quot;name_ar&quot;: &quot;آيت أورير&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tahannaout&quot;,
            &quot;name&quot;: &quot;Tahannaout&quot;,
            &quot;name_ar&quot;: &quot;تحناوت&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;amizmiz&quot;,
            &quot;name&quot;: &quot;Amizmiz&quot;,
            &quot;name_ar&quot;: &quot;أميزميز&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;demnate&quot;,
            &quot;name&quot;: &quot;Demnate&quot;,
            &quot;name_ar&quot;: &quot;دمنات&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_kelaa&quot;,
            &quot;name&quot;: &quot;El Kela&acirc;&quot;,
            &quot;name_ar&quot;: &quot;القلعة&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_smaiil&quot;,
            &quot;name&quot;: &quot;Sidi Smai&#039;il&quot;,
            &quot;name_ar&quot;: &quot;سيدي اسماعيل&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;jemaat_shaim&quot;,
            &quot;name&quot;: &quot;Jemaat Shaim&quot;,
            &quot;name_ar&quot;: &quot;جماعة شعيم&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sebt_gzoula&quot;,
            &quot;name&quot;: &quot;Sebt Gzoula&quot;,
            &quot;name_ar&quot;: &quot;سبت كزولة&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;smimou&quot;,
            &quot;name&quot;: &quot;Smimou&quot;,
            &quot;name_ar&quot;: &quot;سميمو&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bouabout&quot;,
            &quot;name&quot;: &quot;Bouabout&quot;,
            &quot;name_ar&quot;: &quot;بوعبوط&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ighoud&quot;,
            &quot;name&quot;: &quot;Ighoud&quot;,
            &quot;name_ar&quot;: &quot;إغود&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;laattaouia&quot;,
            &quot;name&quot;: &quot;Laattaouia&quot;,
            &quot;name_ar&quot;: &quot;العطاوية&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_abdelkader&quot;,
            &quot;name&quot;: &quot;Sidi Abdelkader&quot;,
            &quot;name_ar&quot;: &quot;سيدي عبد القادر&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tamanar&quot;,
            &quot;name&quot;: &quot;Tamanar&quot;,
            &quot;name_ar&quot;: &quot;تامنار&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;zaouiat_ben_hmida&quot;,
            &quot;name&quot;: &quot;Zaouiat Ben Hmida&quot;,
            &quot;name_ar&quot;: &quot;زاوية بن حميدة&quot;,
            &quot;region&quot;: &quot;Marrakech-Safi&quot;,
            &quot;region_ar&quot;: &quot;مراكش آسفي&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;errachidia&quot;,
            &quot;name&quot;: &quot;Errachidia&quot;,
            &quot;name_ar&quot;: &quot;الراشيدية&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ouarzazate&quot;,
            &quot;name&quot;: &quot;Ouarzazate&quot;,
            &quot;name_ar&quot;: &quot;ورزازات&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tinghir&quot;,
            &quot;name&quot;: &quot;Tinghir&quot;,
            &quot;name_ar&quot;: &quot;تنغير&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;zagora&quot;,
            &quot;name&quot;: &quot;Zagora&quot;,
            &quot;name_ar&quot;: &quot;زاكورة&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;midelt&quot;,
            &quot;name&quot;: &quot;Midelt&quot;,
            &quot;name_ar&quot;: &quot;ميدلت&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;boumalne_dades&quot;,
            &quot;name&quot;: &quot;Boumalne Dad&egrave;s&quot;,
            &quot;name_ar&quot;: &quot;بومالن دادس&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;kelaat_mgouna&quot;,
            &quot;name&quot;: &quot;Kelaat M&#039;Gouna&quot;,
            &quot;name_ar&quot;: &quot;قلعة مكونة&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tinejdad&quot;,
            &quot;name&quot;: &quot;Tinejdad&quot;,
            &quot;name_ar&quot;: &quot;تنجداد&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;alnif&quot;,
            &quot;name&quot;: &quot;Alnif&quot;,
            &quot;name_ar&quot;: &quot;النيف&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;jorf&quot;,
            &quot;name&quot;: &quot;Jorf&quot;,
            &quot;name_ar&quot;: &quot;جرف&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;gourrama&quot;,
            &quot;name&quot;: &quot;Gourrama&quot;,
            &quot;name_ar&quot;: &quot;كورامة&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;rissani&quot;,
            &quot;name&quot;: &quot;Rissani&quot;,
            &quot;name_ar&quot;: &quot;الريصاني&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;erfoud&quot;,
            &quot;name&quot;: &quot;Erfoud&quot;,
            &quot;name_ar&quot;: &quot;أرفود&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ait_benhaddou&quot;,
            &quot;name&quot;: &quot;A&iuml;t Benhaddou&quot;,
            &quot;name_ar&quot;: &quot;آيت بن حدو&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;skoura&quot;,
            &quot;name&quot;: &quot;Skoura&quot;,
            &quot;name_ar&quot;: &quot;صكورة&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tazarine&quot;,
            &quot;name&quot;: &quot;Tazarine&quot;,
            &quot;name_ar&quot;: &quot;تازارين&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;nkob&quot;,
            &quot;name&quot;: &quot;N&#039;Kob&quot;,
            &quot;name_ar&quot;: &quot;نقوب&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;boudnib&quot;,
            &quot;name&quot;: &quot;Boudnib&quot;,
            &quot;name_ar&quot;: &quot;بودنيب&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;goulmima&quot;,
            &quot;name&quot;: &quot;Goulmima&quot;,
            &quot;name_ar&quot;: &quot;كلميمة&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;imilchil&quot;,
            &quot;name&quot;: &quot;Imilchil&quot;,
            &quot;name_ar&quot;: &quot;إميلشيل&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;itzer&quot;,
            &quot;name&quot;: &quot;Itzer&quot;,
            &quot;name_ar&quot;: &quot;إتزر&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;mssici&quot;,
            &quot;name&quot;: &quot;M&#039;ssici&quot;,
            &quot;name_ar&quot;: &quot;مسيسي&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;outat_el_haj&quot;,
            &quot;name&quot;: &quot;Outat El Haj&quot;,
            &quot;name_ar&quot;: &quot;وطاط الحاج&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;zawyat_sidi_hamza&quot;,
            &quot;name&quot;: &quot;Zawyat Sidi Hamza&quot;,
            &quot;name_ar&quot;: &quot;زاوية سيدي حمزة&quot;,
            &quot;region&quot;: &quot;Dr&acirc;a-Tafilalet&quot;,
            &quot;region_ar&quot;: &quot;درعة تافيلالت&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;agadir&quot;,
            &quot;name&quot;: &quot;Agadir&quot;,
            &quot;name_ar&quot;: &quot;أكادير&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: true
        },
        {
            &quot;key&quot;: &quot;inezgane&quot;,
            &quot;name&quot;: &quot;Inezgane&quot;,
            &quot;name_ar&quot;: &quot;إنزكان&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ait_melloul&quot;,
            &quot;name&quot;: &quot;A&iuml;t Melloul&quot;,
            &quot;name_ar&quot;: &quot;آيت ملول&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;taroudant&quot;,
            &quot;name&quot;: &quot;Taroudant&quot;,
            &quot;name_ar&quot;: &quot;تارودانت&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tiznit&quot;,
            &quot;name&quot;: &quot;Tiznit&quot;,
            &quot;name_ar&quot;: &quot;تزنيت&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;oulad_teima&quot;,
            &quot;name&quot;: &quot;Oulad Teima&quot;,
            &quot;name_ar&quot;: &quot;أولاد تايمة&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;biougra&quot;,
            &quot;name&quot;: &quot;Biougra&quot;,
            &quot;name_ar&quot;: &quot;بيوكرى&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ait_baha&quot;,
            &quot;name&quot;: &quot;A&iuml;t Baha&quot;,
            &quot;name_ar&quot;: &quot;آيت باها&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;belfaa&quot;,
            &quot;name&quot;: &quot;Belfaa&quot;,
            &quot;name_ar&quot;: &quot;بلفاع&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bigoudine&quot;,
            &quot;name&quot;: &quot;Bigoudine&quot;,
            &quot;name_ar&quot;: &quot;بيكودين&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bouizakarne&quot;,
            &quot;name&quot;: &quot;Bouizakarne&quot;,
            &quot;name_ar&quot;: &quot;بويزكارن&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_guerdane&quot;,
            &quot;name&quot;: &quot;El Guerdane&quot;,
            &quot;name_ar&quot;: &quot;الكردان&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;irherm&quot;,
            &quot;name&quot;: &quot;Irherm&quot;,
            &quot;name_ar&quot;: &quot;إرهرم&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;ouijjane&quot;,
            &quot;name&quot;: &quot;Ouijjane&quot;,
            &quot;name_ar&quot;: &quot;ويجان&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sebt_el_guerdane&quot;,
            &quot;name&quot;: &quot;Sebt El Guerdane&quot;,
            &quot;name_ar&quot;: &quot;سبت الكردان&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_bibi&quot;,
            &quot;name&quot;: &quot;Sidi Bibi&quot;,
            &quot;name_ar&quot;: &quot;سيدي بيبي&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tafraout&quot;,
            &quot;name&quot;: &quot;Tafraout&quot;,
            &quot;name_ar&quot;: &quot;تافراوت&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;temsia&quot;,
            &quot;name&quot;: &quot;Temsia&quot;,
            &quot;name_ar&quot;: &quot;تمسية&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;chtouka_ait_baha&quot;,
            &quot;name&quot;: &quot;Chtouka-A&iuml;t Baha&quot;,
            &quot;name_ar&quot;: &quot;شتوكة آيت باها&quot;,
            &quot;region&quot;: &quot;Souss-Massa&quot;,
            &quot;region_ar&quot;: &quot;سوس ماسة&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;guelmim&quot;,
            &quot;name&quot;: &quot;Guelmim&quot;,
            &quot;name_ar&quot;: &quot;كلميم&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;sidi_ifni&quot;,
            &quot;name&quot;: &quot;Sidi Ifni&quot;,
            &quot;name_ar&quot;: &quot;سيدي إفني&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tan_tan&quot;,
            &quot;name&quot;: &quot;Tan-Tan&quot;,
            &quot;name_ar&quot;: &quot;طانطان&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;assa&quot;,
            &quot;name&quot;: &quot;Assa&quot;,
            &quot;name_ar&quot;: &quot;أسا&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;fam_el_hisn&quot;,
            &quot;name&quot;: &quot;Fam El Hisn&quot;,
            &quot;name_ar&quot;: &quot;فم الحصن&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;taghjijt&quot;,
            &quot;name&quot;: &quot;Taghjijt&quot;,
            &quot;name_ar&quot;: &quot;تاغجيجت&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;mirleft&quot;,
            &quot;name&quot;: &quot;Mirleft&quot;,
            &quot;name_ar&quot;: &quot;ميرلفت&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;akka&quot;,
            &quot;name&quot;: &quot;Akka&quot;,
            &quot;name_ar&quot;: &quot;أقا&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tata&quot;,
            &quot;name&quot;: &quot;Tata&quot;,
            &quot;name_ar&quot;: &quot;طاطا&quot;,
            &quot;region&quot;: &quot;Guelmim-Oued Noun&quot;,
            &quot;region_ar&quot;: &quot;كلميم واد نون&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;laayoune&quot;,
            &quot;name&quot;: &quot;La&acirc;youne&quot;,
            &quot;name_ar&quot;: &quot;العيون&quot;,
            &quot;region&quot;: &quot;La&acirc;youne-Sakia El Hamra&quot;,
            &quot;region_ar&quot;: &quot;العيون الساقية الحمراء&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;boujdour&quot;,
            &quot;name&quot;: &quot;Boujdour&quot;,
            &quot;name_ar&quot;: &quot;بوجدور&quot;,
            &quot;region&quot;: &quot;La&acirc;youne-Sakia El Hamra&quot;,
            &quot;region_ar&quot;: &quot;العيون الساقية الحمراء&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;tarfaya&quot;,
            &quot;name&quot;: &quot;Tarfaya&quot;,
            &quot;name_ar&quot;: &quot;طرفاية&quot;,
            &quot;region&quot;: &quot;La&acirc;youne-Sakia El Hamra&quot;,
            &quot;region_ar&quot;: &quot;العيون الساقية الحمراء&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;smara&quot;,
            &quot;name&quot;: &quot;Smara&quot;,
            &quot;name_ar&quot;: &quot;السمارة&quot;,
            &quot;region&quot;: &quot;La&acirc;youne-Sakia El Hamra&quot;,
            &quot;region_ar&quot;: &quot;العيون الساقية الحمراء&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;el_marsa&quot;,
            &quot;name&quot;: &quot;El Marsa&quot;,
            &quot;name_ar&quot;: &quot;المرسى&quot;,
            &quot;region&quot;: &quot;La&acirc;youne-Sakia El Hamra&quot;,
            &quot;region_ar&quot;: &quot;العيون الساقية الحمراء&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;dakhla&quot;,
            &quot;name&quot;: &quot;Dakhla&quot;,
            &quot;name_ar&quot;: &quot;الداخلة&quot;,
            &quot;region&quot;: &quot;Dakhla-Oued Ed-Dahab&quot;,
            &quot;region_ar&quot;: &quot;الداخلة وادي الذهب&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;aousserd&quot;,
            &quot;name&quot;: &quot;Aousserd&quot;,
            &quot;name_ar&quot;: &quot;أوسرد&quot;,
            &quot;region&quot;: &quot;Dakhla-Oued Ed-Dahab&quot;,
            &quot;region_ar&quot;: &quot;الداخلة وادي الذهب&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;bir_gandouz&quot;,
            &quot;name&quot;: &quot;Bir Gandouz&quot;,
            &quot;name_ar&quot;: &quot;بير كندوز&quot;,
            &quot;region&quot;: &quot;Dakhla-Oued Ed-Dahab&quot;,
            &quot;region_ar&quot;: &quot;الداخلة وادي الذهب&quot;,
            &quot;is_major&quot;: false
        },
        {
            &quot;key&quot;: &quot;guerguerat&quot;,
            &quot;name&quot;: &quot;Guerguerat&quot;,
            &quot;name_ar&quot;: &quot;الكركرات&quot;,
            &quot;region&quot;: &quot;Dakhla-Oued Ed-Dahab&quot;,
            &quot;region_ar&quot;: &quot;الداخلة وادي الذهب&quot;,
            &quot;is_major&quot;: false
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cities-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities-all" data-method="GET"
      data-path="api/v1/cities/all"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities-all"
                    onclick="tryItOut('GETapi-v1-cities-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities-all"
                    onclick="cancelTryOut('GETapi-v1-cities-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities/all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cities-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cities-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-cities-search">Search cities</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-cities-search">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/cities/search" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cities/search"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities-search">
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Query must be at least 2 characters&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cities-search" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities-search"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities-search"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities-search" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities-search">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities-search" data-method="GET"
      data-path="api/v1/cities/search"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities-search', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities-search"
                    onclick="tryItOut('GETapi-v1-cities-search');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities-search"
                    onclick="cancelTryOut('GETapi-v1-cities-search');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities-search"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities/search</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cities-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cities-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-cities-region--region-">Get cities by region</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-cities-region--region-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/cities/region/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cities/region/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities-region--region-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Region not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cities-region--region-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities-region--region-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities-region--region-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities-region--region-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities-region--region-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities-region--region-" data-method="GET"
      data-path="api/v1/cities/region/{region}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities-region--region-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities-region--region-"
                    onclick="tryItOut('GETapi-v1-cities-region--region-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities-region--region-"
                    onclick="cancelTryOut('GETapi-v1-cities-region--region-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities-region--region-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities/region/{region}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cities-region--region-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cities-region--region-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>region</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="region"                data-endpoint="GETapi-v1-cities-region--region-"
               value="consequatur"
               data-component="url">
    <br>
<p>The region. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-cities--city-">Get city information</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-cities--city-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/cities/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cities/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities--city-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;City not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cities--city-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities--city-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities--city-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities--city-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities--city-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities--city-" data-method="GET"
      data-path="api/v1/cities/{city}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities--city-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities--city-"
                    onclick="tryItOut('GETapi-v1-cities--city-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities--city-"
                    onclick="cancelTryOut('GETapi-v1-cities--city-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities--city-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities/{city}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cities--city-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cities--city-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="GETapi-v1-cities--city-"
               value="consequatur"
               data-component="url">
    <br>
<p>The city. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-logout">POST api/v1/logout</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-logout">
</span>
<span id="execution-results-POSTapi-v1-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-logout" data-method="POST"
      data-path="api/v1/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-logout"
                    onclick="tryItOut('POSTapi-v1-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-logout"
                    onclick="cancelTryOut('POSTapi-v1-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-user">GET api/v1/user</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-user" data-method="GET"
      data-path="api/v1/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-user"
                    onclick="tryItOut('GETapi-v1-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-user"
                    onclick="cancelTryOut('GETapi-v1-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-profile">Get user profile</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-profile" data-method="GET"
      data-path="api/v1/profile"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-profile"
                    onclick="tryItOut('GETapi-v1-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-profile"
                    onclick="cancelTryOut('GETapi-v1-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTapi-v1-profile">Update user profile</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/profile" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=vmqeopfuudtdsufvyvddq"\
    --form "email=kunde.eloisa@example.com"\
    --form "phone=hfqcoynlazghdtqtq"\
    --form "bio_fr=xbajwbpilpmufinllwloa"\
    --form "bio_ar=uydlsmsjuryvojcybzvrb"\
    --form "location=yickznkygloigmkwxphlv"\
    --form "latitude=-90"\
    --form "longitude=-179"\
    --form "avatar=@C:\Users\abdessamad\AppData\Local\Temp\php2EEB.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/profile"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'vmqeopfuudtdsufvyvddq');
body.append('email', 'kunde.eloisa@example.com');
body.append('phone', 'hfqcoynlazghdtqtq');
body.append('bio_fr', 'xbajwbpilpmufinllwloa');
body.append('bio_ar', 'uydlsmsjuryvojcybzvrb');
body.append('location', 'yickznkygloigmkwxphlv');
body.append('latitude', '-90');
body.append('longitude', '-179');
body.append('avatar', document.querySelector('input[name="avatar"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-profile">
</span>
<span id="execution-results-PUTapi-v1-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-profile" data-method="PUT"
      data-path="api/v1/profile"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-profile"
                    onclick="tryItOut('PUTapi-v1-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-profile"
                    onclick="cancelTryOut('PUTapi-v1-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-profile"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-profile"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-v1-profile"
               value="kunde.eloisa@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>kunde.eloisa@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-v1-profile"
               value="hfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>hfqcoynlazghdtqtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio_fr</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio_fr"                data-endpoint="PUTapi-v1-profile"
               value="xbajwbpilpmufinllwloa"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>xbajwbpilpmufinllwloa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio_ar"                data-endpoint="PUTapi-v1-profile"
               value="uydlsmsjuryvojcybzvrb"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>uydlsmsjuryvojcybzvrb</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>location</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="location"                data-endpoint="PUTapi-v1-profile"
               value="yickznkygloigmkwxphlv"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>yickznkygloigmkwxphlv</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>latitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="latitude"                data-endpoint="PUTapi-v1-profile"
               value="-90"
               data-component="body">
    <br>
<p>Must be between -90 and 90. Example: <code>-90</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>longitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="longitude"                data-endpoint="PUTapi-v1-profile"
               value="-179"
               data-component="body">
    <br>
<p>Must be between -180 and 180. Example: <code>-179</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="avatar"                data-endpoint="PUTapi-v1-profile"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\abdessamad\AppData\Local\Temp\php2EEB.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-profile-avatar">Upload Avatar</h2>

<p>
</p>

<p>Upload a new avatar for the user.</p>

<span id="example-requests-POSTapi-v1-profile-avatar">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/profile/avatar" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "avatar=@C:\Users\abdessamad\AppData\Local\Temp\php2F3B.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/profile/avatar"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('avatar', document.querySelector('input[name="avatar"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-profile-avatar">
</span>
<span id="execution-results-POSTapi-v1-profile-avatar" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-profile-avatar"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-profile-avatar"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-profile-avatar" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-profile-avatar">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-profile-avatar" data-method="POST"
      data-path="api/v1/profile/avatar"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-profile-avatar', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-profile-avatar"
                    onclick="tryItOut('POSTapi-v1-profile-avatar');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-profile-avatar"
                    onclick="cancelTryOut('POSTapi-v1-profile-avatar');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-profile-avatar"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/profile/avatar</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-profile-avatar"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-profile-avatar"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="avatar"                data-endpoint="POSTapi-v1-profile-avatar"
               value=""
               data-component="body">
    <br>
<p>The image file for the avatar. Example: <code>C:\Users\abdessamad\AppData\Local\Temp\php2F3B.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-profile-avatar">Delete Avatar</h2>

<p>
</p>

<p>Remove the user's current avatar.</p>

<span id="example-requests-DELETEapi-v1-profile-avatar">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/profile/avatar" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/profile/avatar"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-profile-avatar">
</span>
<span id="execution-results-DELETEapi-v1-profile-avatar" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-profile-avatar"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-profile-avatar"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-profile-avatar" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-profile-avatar">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-profile-avatar" data-method="DELETE"
      data-path="api/v1/profile/avatar"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-profile-avatar', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-profile-avatar"
                    onclick="tryItOut('DELETEapi-v1-profile-avatar');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-profile-avatar"
                    onclick="cancelTryOut('DELETEapi-v1-profile-avatar');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-profile-avatar"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/profile/avatar</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-profile-avatar"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-profile-avatar"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-tasks">POST api/v1/tasks</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-tasks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/tasks" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=Fix my sink"\
    --form "title_translations[fr]=Titre en français"\
    --form "description=The sink is leaking water."\
    --form "description_translations[fr]=Description en français"\
    --form "category_id=1"\
    --form "budget_min=50"\
    --form "budget_max=100"\
    --form "budget_type=fixed"\
    --form "payment_method=cash"\
    --form "city=Casablanca"\
    --form "address=123 Main St"\
    --form "latitude=33.5731"\
    --form "longitude=-7.5898"\
    --form "urgency=high"\
    --form "deadline=2025-12-31"\
    --form "required_skills[]=plumbing"\
    --form "is_remote="\
    --form "images[]=@C:\Users\abdessamad\AppData\Local\Temp\php3007.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tasks"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'Fix my sink');
body.append('title_translations[fr]', 'Titre en français');
body.append('description', 'The sink is leaking water.');
body.append('description_translations[fr]', 'Description en français');
body.append('category_id', '1');
body.append('budget_min', '50');
body.append('budget_max', '100');
body.append('budget_type', 'fixed');
body.append('payment_method', 'cash');
body.append('city', 'Casablanca');
body.append('address', '123 Main St');
body.append('latitude', '33.5731');
body.append('longitude', '-7.5898');
body.append('urgency', 'high');
body.append('deadline', '2025-12-31');
body.append('required_skills[]', 'plumbing');
body.append('is_remote', '');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-tasks">
</span>
<span id="execution-results-POSTapi-v1-tasks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-tasks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-tasks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-tasks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-tasks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-tasks" data-method="POST"
      data-path="api/v1/tasks"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-tasks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-tasks"
                    onclick="tryItOut('POSTapi-v1-tasks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-tasks"
                    onclick="cancelTryOut('POSTapi-v1-tasks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-tasks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/tasks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-tasks"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-v1-tasks"
               value="Fix my sink"
               data-component="body">
    <br>
<p>The title of the task. Must not be greater than 255 characters. Example: <code>Fix my sink</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title_translations</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title_translations"                data-endpoint="POSTapi-v1-tasks"
               value=""
               data-component="body">
    <br>
<p>Translations for the title (e.g., {"fr": "...", "ar": "..."}).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-tasks"
               value="The sink is leaking water."
               data-component="body">
    <br>
<p>Detailed description of the task. Example: <code>The sink is leaking water.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description_translations</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description_translations"                data-endpoint="POSTapi-v1-tasks"
               value=""
               data-component="body">
    <br>
<p>Translations for the description.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category_id"                data-endpoint="POSTapi-v1-tasks"
               value="1"
               data-component="body">
    <br>
<p>The ID of the category the task belongs to. The <code>id</code> of an existing record in the categories table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_min"                data-endpoint="POSTapi-v1-tasks"
               value="50"
               data-component="body">
    <br>
<p>Minimum budget. Must be at least 0. Example: <code>50</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_max"                data-endpoint="POSTapi-v1-tasks"
               value="100"
               data-component="body">
    <br>
<p>Maximum budget. Must be at least 0. Example: <code>100</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="budget_type"                data-endpoint="POSTapi-v1-tasks"
               value="fixed"
               data-component="body">
    <br>
<p>Type of budget (fixed, hourly, negotiable). Example: <code>fixed</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>fixed</code></li> <li><code>hourly</code></li> <li><code>negotiable</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="POSTapi-v1-tasks"
               value="cash"
               data-component="body">
    <br>
<p>Preferred payment method (cash, card, online). Example: <code>cash</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>cash</code></li> <li><code>card</code></li> <li><code>online</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-v1-tasks"
               value="Casablanca"
               data-component="body">
    <br>
<p>City where the task is located. Must not be greater than 100 characters. Example: <code>Casablanca</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-v1-tasks"
               value="123 Main St"
               data-component="body">
    <br>
<p>Specific address for the task. Must not be greater than 255 characters. Example: <code>123 Main St</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>latitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="latitude"                data-endpoint="POSTapi-v1-tasks"
               value="33.5731"
               data-component="body">
    <br>
<p>Latitude coordinate. Must be between -90 and 90. Example: <code>33.5731</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>longitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="longitude"                data-endpoint="POSTapi-v1-tasks"
               value="-7.5898"
               data-component="body">
    <br>
<p>Longitude coordinate. Must be between -180 and 180. Example: <code>-7.5898</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>urgency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="urgency"                data-endpoint="POSTapi-v1-tasks"
               value="high"
               data-component="body">
    <br>
<p>Urgency level (low, medium, high, urgent). Example: <code>high</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>low</code></li> <li><code>medium</code></li> <li><code>high</code></li> <li><code>urgent</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deadline</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="deadline"                data-endpoint="POSTapi-v1-tasks"
               value="2025-12-31"
               data-component="body">
    <br>
<p>Deadline for the task. Must be a valid date. Must be a date after <code>today</code>. Example: <code>2025-12-31</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>required_skills</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="required_skills"                data-endpoint="POSTapi-v1-tasks"
               value=""
               data-component="body">
    <br>
<p>List of required skills.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="POSTapi-v1-tasks"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="POSTapi-v1-tasks"
               data-component="body">
    <br>
<p>Image file. Must be an image. Must not be greater than 2048 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_remote</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-tasks" style="display: none">
            <input type="radio" name="is_remote"
                   value="true"
                   data-endpoint="POSTapi-v1-tasks"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-tasks" style="display: none">
            <input type="radio" name="is_remote"
                   value="false"
                   data-endpoint="POSTapi-v1-tasks"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the task can be done remotely. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-v1-tasks--task_id-">PUT api/v1/tasks/{task_id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-tasks--task_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/tasks/2" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=Fix my sink"\
    --form "title_translations[fr]=Titre en français"\
    --form "description=The sink is leaking water."\
    --form "description_translations[fr]=Description en français"\
    --form "category_id=1"\
    --form "budget_min=50"\
    --form "budget_max=100"\
    --form "budget_type=fixed"\
    --form "payment_method=cash"\
    --form "city=Casablanca"\
    --form "address=123 Main St"\
    --form "latitude=33.5731"\
    --form "longitude=-7.5898"\
    --form "urgency=high"\
    --form "deadline=2025-12-31"\
    --form "required_skills[]=plumbing"\
    --form "is_remote="\
    --form "images[]=@C:\Users\abdessamad\AppData\Local\Temp\php3047.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tasks/2"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'Fix my sink');
body.append('title_translations[fr]', 'Titre en français');
body.append('description', 'The sink is leaking water.');
body.append('description_translations[fr]', 'Description en français');
body.append('category_id', '1');
body.append('budget_min', '50');
body.append('budget_max', '100');
body.append('budget_type', 'fixed');
body.append('payment_method', 'cash');
body.append('city', 'Casablanca');
body.append('address', '123 Main St');
body.append('latitude', '33.5731');
body.append('longitude', '-7.5898');
body.append('urgency', 'high');
body.append('deadline', '2025-12-31');
body.append('required_skills[]', 'plumbing');
body.append('is_remote', '');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-tasks--task_id-">
</span>
<span id="execution-results-PUTapi-v1-tasks--task_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-tasks--task_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-tasks--task_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-tasks--task_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-tasks--task_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-tasks--task_id-" data-method="PUT"
      data-path="api/v1/tasks/{task_id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-tasks--task_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-tasks--task_id-"
                    onclick="tryItOut('PUTapi-v1-tasks--task_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-tasks--task_id-"
                    onclick="cancelTryOut('PUTapi-v1-tasks--task_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-tasks--task_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/tasks/{task_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>2</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="Fix my sink"
               data-component="body">
    <br>
<p>The title of the task. Must not be greater than 255 characters. Example: <code>Fix my sink</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title_translations</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title_translations"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value=""
               data-component="body">
    <br>
<p>Translations for the title (e.g., {"fr": "...", "ar": "..."}).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="The sink is leaking water."
               data-component="body">
    <br>
<p>Detailed description of the task. Example: <code>The sink is leaking water.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description_translations</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description_translations"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value=""
               data-component="body">
    <br>
<p>Translations for the description.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category_id"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="1"
               data-component="body">
    <br>
<p>The ID of the category the task belongs to. The <code>id</code> of an existing record in the categories table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_min"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="50"
               data-component="body">
    <br>
<p>Minimum budget. Must be at least 0. Example: <code>50</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_max"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="100"
               data-component="body">
    <br>
<p>Maximum budget. Must be at least 0. Example: <code>100</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="budget_type"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="fixed"
               data-component="body">
    <br>
<p>Type of budget (fixed, hourly, negotiable). Example: <code>fixed</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>fixed</code></li> <li><code>hourly</code></li> <li><code>negotiable</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="cash"
               data-component="body">
    <br>
<p>Preferred payment method (cash, card, online). Example: <code>cash</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>cash</code></li> <li><code>card</code></li> <li><code>online</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="Casablanca"
               data-component="body">
    <br>
<p>City where the task is located. Must not be greater than 100 characters. Example: <code>Casablanca</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="123 Main St"
               data-component="body">
    <br>
<p>Specific address for the task. Must not be greater than 255 characters. Example: <code>123 Main St</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>latitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="latitude"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="33.5731"
               data-component="body">
    <br>
<p>Latitude coordinate. Must be between -90 and 90. Example: <code>33.5731</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>longitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="longitude"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="-7.5898"
               data-component="body">
    <br>
<p>Longitude coordinate. Must be between -180 and 180. Example: <code>-7.5898</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>urgency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="urgency"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="high"
               data-component="body">
    <br>
<p>Urgency level (low, medium, high, urgent). Example: <code>high</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>low</code></li> <li><code>medium</code></li> <li><code>high</code></li> <li><code>urgent</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deadline</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="deadline"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="2025-12-31"
               data-component="body">
    <br>
<p>Deadline for the task. Must be a valid date. Must be a date after <code>today</code>. Example: <code>2025-12-31</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>required_skills</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="required_skills"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value=""
               data-component="body">
    <br>
<p>List of required skills.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="PUTapi-v1-tasks--task_id-"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="PUTapi-v1-tasks--task_id-"
               data-component="body">
    <br>
<p>Image file. Must be an image. Must not be greater than 2048 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_remote</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-tasks--task_id-" style="display: none">
            <input type="radio" name="is_remote"
                   value="true"
                   data-endpoint="PUTapi-v1-tasks--task_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-tasks--task_id-" style="display: none">
            <input type="radio" name="is_remote"
                   value="false"
                   data-endpoint="PUTapi-v1-tasks--task_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the task can be done remotely. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-tasks--task_id-">DELETE api/v1/tasks/{task_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-tasks--task_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/tasks/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tasks/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-tasks--task_id-">
</span>
<span id="execution-results-DELETEapi-v1-tasks--task_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-tasks--task_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-tasks--task_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-tasks--task_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-tasks--task_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-tasks--task_id-" data-method="DELETE"
      data-path="api/v1/tasks/{task_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-tasks--task_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-tasks--task_id-"
                    onclick="tryItOut('DELETEapi-v1-tasks--task_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-tasks--task_id-"
                    onclick="cancelTryOut('DELETEapi-v1-tasks--task_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-tasks--task_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/tasks/{task_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="DELETEapi-v1-tasks--task_id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-tasks--task_id--apply">POST api/v1/tasks/{task_id}/apply</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-tasks--task_id--apply">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/tasks/2/apply" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"proposal\": \"I can fix this in 2 hours.\",
    \"proposal_translations\": {
        \"fr\": \"Ma proposition...\"
    },
    \"proposed_budget\": 80,
    \"estimated_duration\": \"2 hours\",
    \"experience_description\": \"I have 5 years of plumbing experience.\",
    \"portfolio_items\": [
        {
            \"title\": \"Project 1\",
            \"url\": \"...\"
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tasks/2/apply"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "proposal": "I can fix this in 2 hours.",
    "proposal_translations": {
        "fr": "Ma proposition..."
    },
    "proposed_budget": 80,
    "estimated_duration": "2 hours",
    "experience_description": "I have 5 years of plumbing experience.",
    "portfolio_items": [
        {
            "title": "Project 1",
            "url": "..."
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-tasks--task_id--apply">
</span>
<span id="execution-results-POSTapi-v1-tasks--task_id--apply" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-tasks--task_id--apply"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-tasks--task_id--apply"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-tasks--task_id--apply" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-tasks--task_id--apply">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-tasks--task_id--apply" data-method="POST"
      data-path="api/v1/tasks/{task_id}/apply"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-tasks--task_id--apply', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-tasks--task_id--apply"
                    onclick="tryItOut('POSTapi-v1-tasks--task_id--apply');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-tasks--task_id--apply"
                    onclick="cancelTryOut('POSTapi-v1-tasks--task_id--apply');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-tasks--task_id--apply"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/tasks/{task_id}/apply</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value="2"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>2</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>proposal</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="proposal"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value="I can fix this in 2 hours."
               data-component="body">
    <br>
<p>Your proposal for the task. Example: <code>I can fix this in 2 hours.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>proposal_translations</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="proposal_translations"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value=""
               data-component="body">
    <br>
<p>Translations for the proposal.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>proposed_budget</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="proposed_budget"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value="80"
               data-component="body">
    <br>
<p>The amount you are asking for. Must be at least 0. Example: <code>80</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>estimated_duration</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="estimated_duration"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value="2 hours"
               data-component="body">
    <br>
<p>Estimated time to complete the task. Must not be greater than 100 characters. Example: <code>2 hours</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>experience_description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="experience_description"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value="I have 5 years of plumbing experience."
               data-component="body">
    <br>
<p>Brief description of your relevant experience. Example: <code>I have 5 years of plumbing experience.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>portfolio_items</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="portfolio_items"                data-endpoint="POSTapi-v1-tasks--task_id--apply"
               value=""
               data-component="body">
    <br>
<p>List of portfolio items to showcase.</p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-my-tasks">GET api/v1/my-tasks</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-my-tasks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/my-tasks" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/my-tasks"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-my-tasks">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-my-tasks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-my-tasks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-my-tasks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-my-tasks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-my-tasks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-my-tasks" data-method="GET"
      data-path="api/v1/my-tasks"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-my-tasks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-my-tasks"
                    onclick="tryItOut('GETapi-v1-my-tasks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-my-tasks"
                    onclick="cancelTryOut('GETapi-v1-my-tasks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-my-tasks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/my-tasks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-my-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-my-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-my-applications">GET api/v1/my-applications</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-my-applications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/my-applications" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/my-applications"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-my-applications">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-my-applications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-my-applications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-my-applications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-my-applications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-my-applications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-my-applications" data-method="GET"
      data-path="api/v1/my-applications"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-my-applications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-my-applications"
                    onclick="tryItOut('GETapi-v1-my-applications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-my-applications"
                    onclick="cancelTryOut('GETapi-v1-my-applications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-my-applications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/my-applications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-my-applications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-my-applications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTapi-v1-applications--application_id--accept">PUT api/v1/applications/{application_id}/accept</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-applications--application_id--accept">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/applications/1/accept" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/applications/1/accept"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-applications--application_id--accept">
</span>
<span id="execution-results-PUTapi-v1-applications--application_id--accept" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-applications--application_id--accept"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-applications--application_id--accept"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-applications--application_id--accept" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-applications--application_id--accept">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-applications--application_id--accept" data-method="PUT"
      data-path="api/v1/applications/{application_id}/accept"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-applications--application_id--accept', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-applications--application_id--accept"
                    onclick="tryItOut('PUTapi-v1-applications--application_id--accept');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-applications--application_id--accept"
                    onclick="cancelTryOut('PUTapi-v1-applications--application_id--accept');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-applications--application_id--accept"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/applications/{application_id}/accept</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-applications--application_id--accept"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-applications--application_id--accept"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>application_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="application_id"                data-endpoint="PUTapi-v1-applications--application_id--accept"
               value="1"
               data-component="url">
    <br>
<p>The ID of the application. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-applications--application_id--reject">PUT api/v1/applications/{application_id}/reject</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-applications--application_id--reject">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/applications/1/reject" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/applications/1/reject"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-applications--application_id--reject">
</span>
<span id="execution-results-PUTapi-v1-applications--application_id--reject" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-applications--application_id--reject"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-applications--application_id--reject"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-applications--application_id--reject" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-applications--application_id--reject">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-applications--application_id--reject" data-method="PUT"
      data-path="api/v1/applications/{application_id}/reject"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-applications--application_id--reject', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-applications--application_id--reject"
                    onclick="tryItOut('PUTapi-v1-applications--application_id--reject');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-applications--application_id--reject"
                    onclick="cancelTryOut('PUTapi-v1-applications--application_id--reject');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-applications--application_id--reject"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/applications/{application_id}/reject</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-applications--application_id--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-applications--application_id--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>application_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="application_id"                data-endpoint="PUTapi-v1-applications--application_id--reject"
               value="1"
               data-component="url">
    <br>
<p>The ID of the application. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-messages">Get messages for a specific task</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/messages" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/messages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-messages">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-messages" data-method="GET"
      data-path="api/v1/messages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-messages"
                    onclick="tryItOut('GETapi-v1-messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-messages"
                    onclick="cancelTryOut('GETapi-v1-messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-messages">Send a message</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/messages" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "receiver_id=consequatur"\
    --form "content_fr=mqeopfuudtdsufvyvddqa"\
    --form "content_ar=mniihfqcoynlazghdtqtq"\
    --form "attachment=@C:\Users\abdessamad\AppData\Local\Temp\php319F.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/messages"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('receiver_id', 'consequatur');
body.append('content_fr', 'mqeopfuudtdsufvyvddqa');
body.append('content_ar', 'mniihfqcoynlazghdtqtq');
body.append('attachment', document.querySelector('input[name="attachment"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-messages">
</span>
<span id="execution-results-POSTapi-v1-messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-messages" data-method="POST"
      data-path="api/v1/messages"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-messages"
                    onclick="tryItOut('POSTapi-v1-messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-messages"
                    onclick="cancelTryOut('POSTapi-v1-messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-messages"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_id"                data-endpoint="POSTapi-v1-messages"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content_fr</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content_fr"                data-endpoint="POSTapi-v1-messages"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>This field is required when <code>content_ar</code> is not present. Must not be greater than 5000 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content_ar"                data-endpoint="POSTapi-v1-messages"
               value="mniihfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>This field is required when <code>content_fr</code> is not present. Must not be greater than 5000 characters. Example: <code>mniihfqcoynlazghdtqtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="attachment"                data-endpoint="POSTapi-v1-messages"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 25600 kilobytes. Example: <code>C:\Users\abdessamad\AppData\Local\Temp\php319F.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-v1-messages--message_id--read">Mark message as read</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-messages--message_id--read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/messages/17/read" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/messages/17/read"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-messages--message_id--read">
</span>
<span id="execution-results-PUTapi-v1-messages--message_id--read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-messages--message_id--read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-messages--message_id--read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-messages--message_id--read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-messages--message_id--read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-messages--message_id--read" data-method="PUT"
      data-path="api/v1/messages/{message_id}/read"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-messages--message_id--read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-messages--message_id--read"
                    onclick="tryItOut('PUTapi-v1-messages--message_id--read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-messages--message_id--read"
                    onclick="cancelTryOut('PUTapi-v1-messages--message_id--read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-messages--message_id--read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/messages/{message_id}/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-messages--message_id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-messages--message_id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>message_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="message_id"                data-endpoint="PUTapi-v1-messages--message_id--read"
               value="17"
               data-component="url">
    <br>
<p>The ID of the message. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-conversations--userId-">Get conversation with a specific user</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-conversations--userId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/conversations/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/conversations/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-conversations--userId-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-conversations--userId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-conversations--userId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-conversations--userId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-conversations--userId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-conversations--userId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-conversations--userId-" data-method="GET"
      data-path="api/v1/conversations/{userId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-conversations--userId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-conversations--userId-"
                    onclick="tryItOut('GETapi-v1-conversations--userId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-conversations--userId-"
                    onclick="cancelTryOut('GETapi-v1-conversations--userId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-conversations--userId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/conversations/{userId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-conversations--userId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-conversations--userId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="userId"                data-endpoint="GETapi-v1-conversations--userId-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-payments">Create payment for a task</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-payments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/payments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"task_id\": \"consequatur\",
    \"payment_method\": \"cash\",
    \"amount\": 45
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/payments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "task_id": "consequatur",
    "payment_method": "cash",
    "amount": 45
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payments">
</span>
<span id="execution-results-POSTapi-v1-payments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payments" data-method="POST"
      data-path="api/v1/payments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payments"
                    onclick="tryItOut('POSTapi-v1-payments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payments"
                    onclick="cancelTryOut('POSTapi-v1-payments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="task_id"                data-endpoint="POSTapi-v1-payments"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the tasks table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="POSTapi-v1-payments"
               value="cash"
               data-component="body">
    <br>
<p>Example: <code>cash</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>cash</code></li> <li><code>bank_transfer</code></li> <li><code>mobile_money</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-v1-payments"
               value="45"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>45</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-payments">Get payments for authenticated user</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-payments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/payments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/payments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-payments">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-payments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-payments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-payments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-payments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-payments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-payments" data-method="GET"
      data-path="api/v1/payments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-payments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-payments"
                    onclick="tryItOut('GETapi-v1-payments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-payments"
                    onclick="cancelTryOut('GETapi-v1-payments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-payments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/payments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-payments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-payments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTapi-v1-payments--payment_id--release">PUT api/v1/payments/{payment_id}/release</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-payments--payment_id--release">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/payments/17/release" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/payments/17/release"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-payments--payment_id--release">
</span>
<span id="execution-results-PUTapi-v1-payments--payment_id--release" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-payments--payment_id--release"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-payments--payment_id--release"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-payments--payment_id--release" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-payments--payment_id--release">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-payments--payment_id--release" data-method="PUT"
      data-path="api/v1/payments/{payment_id}/release"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-payments--payment_id--release', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-payments--payment_id--release"
                    onclick="tryItOut('PUTapi-v1-payments--payment_id--release');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-payments--payment_id--release"
                    onclick="cancelTryOut('PUTapi-v1-payments--payment_id--release');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-payments--payment_id--release"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/payments/{payment_id}/release</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-payments--payment_id--release"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-payments--payment_id--release"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>payment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="payment_id"                data-endpoint="PUTapi-v1-payments--payment_id--release"
               value="17"
               data-component="url">
    <br>
<p>The ID of the payment. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-reviews">Create a new review</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reviewee_id\": \"consequatur\",
    \"rating\": 3,
    \"comment_fr\": \"qeopfuudtdsufvyvddqam\",
    \"comment_ar\": \"niihfqcoynlazghdtqtqx\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/reviews"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reviewee_id": "consequatur",
    "rating": 3,
    "comment_fr": "qeopfuudtdsufvyvddqam",
    "comment_ar": "niihfqcoynlazghdtqtqx"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-reviews">
</span>
<span id="execution-results-POSTapi-v1-reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-reviews" data-method="POST"
      data-path="api/v1/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-reviews"
                    onclick="tryItOut('POSTapi-v1-reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-reviews"
                    onclick="cancelTryOut('POSTapi-v1-reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reviewee_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reviewee_id"                data-endpoint="POSTapi-v1-reviews"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-v1-reviews"
               value="3"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment_fr</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment_fr"                data-endpoint="POSTapi-v1-reviews"
               value="qeopfuudtdsufvyvddqam"
               data-component="body">
    <br>
<p>This field is required when <code>comment_ar</code> is not present. Must not be greater than 1000 characters. Example: <code>qeopfuudtdsufvyvddqam</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment_ar"                data-endpoint="POSTapi-v1-reviews"
               value="niihfqcoynlazghdtqtqx"
               data-component="body">
    <br>
<p>This field is required when <code>comment_fr</code> is not present. Must not be greater than 1000 characters. Example: <code>niihfqcoynlazghdtqtqx</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-reviews--userId-">Get reviews for a specific user</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-reviews--userId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/reviews/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/reviews/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-reviews--userId-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-reviews--userId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-reviews--userId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-reviews--userId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-reviews--userId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-reviews--userId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-reviews--userId-" data-method="GET"
      data-path="api/v1/reviews/{userId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-reviews--userId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-reviews--userId-"
                    onclick="tryItOut('GETapi-v1-reviews--userId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-reviews--userId-"
                    onclick="cancelTryOut('GETapi-v1-reviews--userId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-reviews--userId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/reviews/{userId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-reviews--userId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-reviews--userId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="userId"                data-endpoint="GETapi-v1-reviews--userId-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-disputes">Create a new dispute</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-disputes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/disputes" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "respondent_id=consequatur"\
    --form "type=communication"\
    --form "title_fr=mqeopfuudtdsufvyvddqa"\
    --form "title_ar=mniihfqcoynlazghdtqtq"\
    --form "description_fr=xbajwbpilpmufinllwloa"\
    --form "description_ar=uydlsmsjuryvojcybzvrb"\
    --form "evidence=@C:\Users\abdessamad\AppData\Local\Temp\php3308.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/disputes"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('respondent_id', 'consequatur');
body.append('type', 'communication');
body.append('title_fr', 'mqeopfuudtdsufvyvddqa');
body.append('title_ar', 'mniihfqcoynlazghdtqtq');
body.append('description_fr', 'xbajwbpilpmufinllwloa');
body.append('description_ar', 'uydlsmsjuryvojcybzvrb');
body.append('evidence', document.querySelector('input[name="evidence"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-disputes">
</span>
<span id="execution-results-POSTapi-v1-disputes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-disputes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-disputes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-disputes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-disputes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-disputes" data-method="POST"
      data-path="api/v1/disputes"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-disputes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-disputes"
                    onclick="tryItOut('POSTapi-v1-disputes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-disputes"
                    onclick="cancelTryOut('POSTapi-v1-disputes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-disputes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/disputes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-disputes"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-disputes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>respondent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="respondent_id"                data-endpoint="POSTapi-v1-disputes"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-v1-disputes"
               value="communication"
               data-component="body">
    <br>
<p>Example: <code>communication</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>payment</code></li> <li><code>quality</code></li> <li><code>communication</code></li> <li><code>other</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title_fr</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title_fr"                data-endpoint="POSTapi-v1-disputes"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>This field is required when <code>title_ar</code> is not present. Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title_ar"                data-endpoint="POSTapi-v1-disputes"
               value="mniihfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>This field is required when <code>title_fr</code> is not present. Must not be greater than 255 characters. Example: <code>mniihfqcoynlazghdtqtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description_fr</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description_fr"                data-endpoint="POSTapi-v1-disputes"
               value="xbajwbpilpmufinllwloa"
               data-component="body">
    <br>
<p>This field is required when <code>description_ar</code> is not present. Must not be greater than 2000 characters. Example: <code>xbajwbpilpmufinllwloa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description_ar"                data-endpoint="POSTapi-v1-disputes"
               value="uydlsmsjuryvojcybzvrb"
               data-component="body">
    <br>
<p>This field is required when <code>description_fr</code> is not present. Must not be greater than 2000 characters. Example: <code>uydlsmsjuryvojcybzvrb</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>evidence</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="evidence"                data-endpoint="POSTapi-v1-disputes"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 10240 kilobytes. Example: <code>C:\Users\abdessamad\AppData\Local\Temp\php3308.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-disputes">Get disputes for authenticated user</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-disputes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/disputes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/disputes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-disputes">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-disputes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-disputes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-disputes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-disputes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-disputes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-disputes" data-method="GET"
      data-path="api/v1/disputes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-disputes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-disputes"
                    onclick="tryItOut('GETapi-v1-disputes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-disputes"
                    onclick="cancelTryOut('GETapi-v1-disputes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-disputes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/disputes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-disputes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-disputes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-disputes--dispute-">Get dispute details</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-disputes--dispute-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/disputes/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/disputes/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-disputes--dispute-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-disputes--dispute-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-disputes--dispute-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-disputes--dispute-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-disputes--dispute-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-disputes--dispute-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-disputes--dispute-" data-method="GET"
      data-path="api/v1/disputes/{dispute}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-disputes--dispute-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-disputes--dispute-"
                    onclick="tryItOut('GETapi-v1-disputes--dispute-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-disputes--dispute-"
                    onclick="cancelTryOut('GETapi-v1-disputes--dispute-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-disputes--dispute-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/disputes/{dispute}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-disputes--dispute-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-disputes--dispute-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>dispute</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="dispute"                data-endpoint="GETapi-v1-disputes--dispute-"
               value="consequatur"
               data-component="url">
    <br>
<p>The dispute. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-dashboard">GET api/v1/admin/dashboard</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/dashboard" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/dashboard"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-dashboard">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-dashboard" data-method="GET"
      data-path="api/v1/admin/dashboard"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-dashboard"
                    onclick="tryItOut('GETapi-v1-admin-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-dashboard"
                    onclick="cancelTryOut('GETapi-v1-admin-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-admin-users">GET api/v1/admin/users</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-users">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-users" data-method="GET"
      data-path="api/v1/admin/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-users"
                    onclick="tryItOut('GETapi-v1-admin-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-users"
                    onclick="cancelTryOut('GETapi-v1-admin-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTapi-v1-admin-users--user_id--verify">PUT api/v1/admin/users/{user_id}/verify</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-users--user_id--verify">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/users/1/verify" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/users/1/verify"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-users--user_id--verify">
</span>
<span id="execution-results-PUTapi-v1-admin-users--user_id--verify" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-users--user_id--verify"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-users--user_id--verify"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-users--user_id--verify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-users--user_id--verify">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-users--user_id--verify" data-method="PUT"
      data-path="api/v1/admin/users/{user_id}/verify"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-users--user_id--verify', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-users--user_id--verify"
                    onclick="tryItOut('PUTapi-v1-admin-users--user_id--verify');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-users--user_id--verify"
                    onclick="cancelTryOut('PUTapi-v1-admin-users--user_id--verify');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-users--user_id--verify"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/users/{user_id}/verify</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-users--user_id--verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-users--user_id--verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="PUTapi-v1-admin-users--user_id--verify"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-tasks-pending">GET api/v1/admin/tasks/pending</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-tasks-pending">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/tasks/pending" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/tasks/pending"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-tasks-pending">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-tasks-pending" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-tasks-pending"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-tasks-pending"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-tasks-pending" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-tasks-pending">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-tasks-pending" data-method="GET"
      data-path="api/v1/admin/tasks/pending"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-tasks-pending', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-tasks-pending"
                    onclick="tryItOut('GETapi-v1-admin-tasks-pending');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-tasks-pending"
                    onclick="cancelTryOut('GETapi-v1-admin-tasks-pending');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-tasks-pending"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/tasks/pending</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-tasks-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-tasks-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-admin-disputes-pending">GET api/v1/admin/disputes/pending</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-disputes-pending">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/disputes/pending" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/disputes/pending"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-disputes-pending">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-disputes-pending" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-disputes-pending"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-disputes-pending"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-disputes-pending" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-disputes-pending">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-disputes-pending" data-method="GET"
      data-path="api/v1/admin/disputes/pending"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-disputes-pending', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-disputes-pending"
                    onclick="tryItOut('GETapi-v1-admin-disputes-pending');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-disputes-pending"
                    onclick="cancelTryOut('GETapi-v1-admin-disputes-pending');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-disputes-pending"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/disputes/pending</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-disputes-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-disputes-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTapi-v1-admin-disputes--dispute_id--resolve">PUT api/v1/admin/disputes/{dispute_id}/resolve</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-disputes--dispute_id--resolve">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/disputes/17/resolve" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"resolution\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/disputes/17/resolve"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "resolution": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-disputes--dispute_id--resolve">
</span>
<span id="execution-results-PUTapi-v1-admin-disputes--dispute_id--resolve" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-disputes--dispute_id--resolve"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-disputes--dispute_id--resolve"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-disputes--dispute_id--resolve" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-disputes--dispute_id--resolve">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-disputes--dispute_id--resolve" data-method="PUT"
      data-path="api/v1/admin/disputes/{dispute_id}/resolve"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-disputes--dispute_id--resolve', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-disputes--dispute_id--resolve"
                    onclick="tryItOut('PUTapi-v1-admin-disputes--dispute_id--resolve');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-disputes--dispute_id--resolve"
                    onclick="cancelTryOut('PUTapi-v1-admin-disputes--dispute_id--resolve');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-disputes--dispute_id--resolve"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/disputes/{dispute_id}/resolve</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-disputes--dispute_id--resolve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-disputes--dispute_id--resolve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>dispute_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="dispute_id"                data-endpoint="PUTapi-v1-admin-disputes--dispute_id--resolve"
               value="17"
               data-component="url">
    <br>
<p>The ID of the dispute. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>resolution</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="resolution"                data-endpoint="PUTapi-v1-admin-disputes--dispute_id--resolve"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-admin-payments-overview">GET api/v1/admin/payments/overview</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-payments-overview">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/payments/overview" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/payments/overview"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-payments-overview">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-payments-overview" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-payments-overview"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-payments-overview"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-payments-overview" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-payments-overview">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-payments-overview" data-method="GET"
      data-path="api/v1/admin/payments/overview"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-payments-overview', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-payments-overview"
                    onclick="tryItOut('GETapi-v1-admin-payments-overview');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-payments-overview"
                    onclick="cancelTryOut('GETapi-v1-admin-payments-overview');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-payments-overview"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/payments/overview</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-payments-overview"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-payments-overview"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-admin-commissions">GET api/v1/admin/commissions</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-commissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/commissions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/commissions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-commissions">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-commissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-commissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-commissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-commissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-commissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-commissions" data-method="GET"
      data-path="api/v1/admin/commissions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-commissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-commissions"
                    onclick="tryItOut('GETapi-v1-admin-commissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-commissions"
                    onclick="cancelTryOut('GETapi-v1-admin-commissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-commissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/commissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-commissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-commissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-messaging-send">POST api/v1/messaging/send</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-messaging-send">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/messaging/send" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "receiver_id=consequatur"\
    --form "content=mqeopfuudtdsufvyvddqa"\
    --form "attachment=@C:\Users\abdessamad\AppData\Local\Temp\php34DE.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/messaging/send"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('receiver_id', 'consequatur');
body.append('content', 'mqeopfuudtdsufvyvddqa');
body.append('attachment', document.querySelector('input[name="attachment"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-messaging-send">
</span>
<span id="execution-results-POSTapi-v1-messaging-send" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-messaging-send"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-messaging-send"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-messaging-send" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-messaging-send">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-messaging-send" data-method="POST"
      data-path="api/v1/messaging/send"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-messaging-send', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-messaging-send"
                    onclick="tryItOut('POSTapi-v1-messaging-send');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-messaging-send"
                    onclick="cancelTryOut('POSTapi-v1-messaging-send');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-messaging-send"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/messaging/send</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-messaging-send"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-messaging-send"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_id"                data-endpoint="POSTapi-v1-messaging-send"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-v1-messaging-send"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>This field is required when <code>attachment</code> is not present. Must not be greater than 5000 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="attachment"                data-endpoint="POSTapi-v1-messaging-send"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 25600 kilobytes. Example: <code>C:\Users\abdessamad\AppData\Local\Temp\php34DE.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-messaging-history">GET api/v1/messaging/history</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-messaging-history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/messaging/history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"with_user_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/messaging/history"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "with_user_id": 17
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-messaging-history">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 30
x-ratelimit-remaining: 29
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Token not provided&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-messaging-history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-messaging-history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-messaging-history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-messaging-history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-messaging-history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-messaging-history" data-method="GET"
      data-path="api/v1/messaging/history"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-messaging-history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-messaging-history"
                    onclick="tryItOut('GETapi-v1-messaging-history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-messaging-history"
                    onclick="cancelTryOut('GETapi-v1-messaging-history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-messaging-history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/messaging/history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-messaging-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-messaging-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>with_user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="with_user_id"                data-endpoint="GETapi-v1-messaging-history"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-messaging-typing">POST api/v1/messaging/typing</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-messaging-typing">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/messaging/typing" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"receiver_id\": 17,
    \"typing\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/messaging/typing"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "receiver_id": 17,
    "typing": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-messaging-typing">
</span>
<span id="execution-results-POSTapi-v1-messaging-typing" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-messaging-typing"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-messaging-typing"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-messaging-typing" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-messaging-typing">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-messaging-typing" data-method="POST"
      data-path="api/v1/messaging/typing"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-messaging-typing', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-messaging-typing"
                    onclick="tryItOut('POSTapi-v1-messaging-typing');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-messaging-typing"
                    onclick="cancelTryOut('POSTapi-v1-messaging-typing');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-messaging-typing"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/messaging/typing</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-messaging-typing"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-messaging-typing"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="receiver_id"                data-endpoint="POSTapi-v1-messaging-typing"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>typing</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-messaging-typing" style="display: none">
            <input type="radio" name="typing"
                   value="true"
                   data-endpoint="POSTapi-v1-messaging-typing"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-messaging-typing" style="display: none">
            <input type="radio" name="typing"
                   value="false"
                   data-endpoint="POSTapi-v1-messaging-typing"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-messaging-read">POST api/v1/messaging/read</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-messaging-read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/messaging/read" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"message_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/messaging/read"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "message_id": 17
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-messaging-read">
</span>
<span id="execution-results-POSTapi-v1-messaging-read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-messaging-read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-messaging-read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-messaging-read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-messaging-read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-messaging-read" data-method="POST"
      data-path="api/v1/messaging/read"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-messaging-read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-messaging-read"
                    onclick="tryItOut('POSTapi-v1-messaging-read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-messaging-read"
                    onclick="cancelTryOut('POSTapi-v1-messaging-read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-messaging-read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/messaging/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-messaging-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-messaging-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="message_id"                data-endpoint="POSTapi-v1-messaging-read"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-taskers--tasker--reviews">Get reviews for a tasker (AJAX)</h2>

<p>
</p>



<span id="example-requests-GETapi-taskers--tasker--reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/taskers/consequatur/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/taskers/consequatur/reviews"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-taskers--tasker--reviews">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6InAzWVptM0EyU00rNDdWK1NZRGlqb0E9PSIsInZhbHVlIjoiTTAxRXFTVjIva1ZQQjJ6Z29oQURrU1haY3lYdHlEVVcxYndQeEgwYXN3UUM2NVRkWkJpZTRINjlmcVJiWUVTVm4xUTdEdlduU0o2MHBaZmg5Njc5VkVNcG1GVnRkQ0xIM053WXlEUVhyRVBVL0xXWXhmcnhQeHFwTzJ4VEllSXoiLCJtYWMiOiI5NWJiODUyZTM3YTg2YjExOWMzYTI3NzJmNTc3YTY1ZjNlZjRjMjJkODU5NTJkZGU5OTBiYTZmNTVkMTViNGUwIiwidGFnIjoiIn0%3D; expires=Sat, 07 Mar 2026 14:52:14 GMT; Max-Age=7200; path=/; samesite=lax; lem3alamma-session=eyJpdiI6IjNBMC82M0ptcHhESkxBbHprajNCNEE9PSIsInZhbHVlIjoiNnVnempHc1dDKzhtZTBwc0hhRDJYMHhKRjlUeHRwY3BJT2FudkRYT3VDYXp0NXVpeFZZaEhTRUVIOGZnUHU3Y0t6NnRta2F6ZVNZM3dLZ3g4QTNYYzhaTFFCMDd2V1lLU1ROZVJpOUZjbU45QVNUWDhpemtRQVJVY1hmV0NtRE4iLCJtYWMiOiIyNzNmOWM4ZGFiY2Y3ZmE5YmZlZGJjNzFkYmRhODU0NjRiZGNlYzY1Njc4OGJkNDY4YWE2ZjViYmZmZGFiYWI5IiwidGFnIjoiIn0%3D; expires=Sat, 07 Mar 2026 14:52:14 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\User] consequatur&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-taskers--tasker--reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-taskers--tasker--reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-taskers--tasker--reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-taskers--tasker--reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-taskers--tasker--reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-taskers--tasker--reviews" data-method="GET"
      data-path="api/taskers/{tasker}/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-taskers--tasker--reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-taskers--tasker--reviews"
                    onclick="tryItOut('GETapi-taskers--tasker--reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-taskers--tasker--reviews"
                    onclick="cancelTryOut('GETapi-taskers--tasker--reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-taskers--tasker--reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/taskers/{tasker}/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-taskers--tasker--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-taskers--tasker--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tasker</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tasker"                data-endpoint="GETapi-taskers--tasker--reviews"
               value="consequatur"
               data-component="url">
    <br>
<p>The tasker. Example: <code>consequatur</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
