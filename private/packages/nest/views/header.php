<!DOCTYPE HTML>
<html>
<head>
    <title>{{title}}</title>
{{#meta}}
    <meta {{{.}}}/>
{{/meta}}
{{#head_js}}
    <script type="text/javascript" {{{.}}}></script>
{{/head_js}}
{{#css}}
    <link rel="stylesheet" type="text/css" {{{.}}}/>
{{/css}}
</head>
<body>
    <header>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#"><strong>Pigeon</strong>Nest</a>
                    {{#logged_in}}
                    <ul class="nav">
                        <li><a href="/nest/">Go to the dashboard</a></li>
                        <li><a href="/nest/logout/">Logout</a></li>
                    </ul>
                    {{/logged_in}}
                </div>
            </div>
        </div>
    </header>
    <section id="body">