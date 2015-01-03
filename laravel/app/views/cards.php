<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<link rel='stylesheet' href='/frontend/bower_components/normalize.css/normalize.css'>
	<link rel='stylesheet' href='/frontend/css/main.css'>
</head>
<body>
	<div class="welcome">
		<h1>Cards</h1>
	</div>
	
<script type="text/x-handlebars" data-template-name="index">
    <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3 custom-grid-ul">
        {{#each}}
            <li {{bind-attr style="backgroundImage"}}>
                <div class="custom-grid">
                    {{#link-to 'photo' this}}<h5 class="custom-header">{{title}}</h5>{{/link-to}}
                    <span>Author: {{user_id}}</span>
                </div>
            </li>
 
        {{/each}}
    </ul>
</script>
	
	<script src="/frontend/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="/frontend/bower_components/handlebars/handlebars.js"></script>
	<script src="/frontend/bower_components/ember/ember.js"></script>
	<script src="/frontend/bower_components/ember-data/ember-data.js"></script>
</body>
</html>