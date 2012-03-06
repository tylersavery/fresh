<!DOCTYPE HTML>
<html>
<head>
    <title>{{title}}</title>
{{#meta}}
    <meta {{{.}}}/>
{{/meta}}
    <link rel="stylesheet" type="text/css" href="/css/base/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/base/bootstrap.min.css" />
{{#head_js}}
    <script type="text/javascript" {{{.}}}></script>
{{/head_js}}
{{#css}}
    <link rel="stylesheet" type="text/css" {{{.}}}/>
{{/css}}
</head>
<body>
	<header>
	    Welcome to <b>{{website}}</b>!
	</header>