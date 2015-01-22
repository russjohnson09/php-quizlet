//App = Ember.Application.create();

//App.ApplicationAdapter = DS.FixtureAdapter.extend();

App = Ember.Application.create({
    LOG_TRANSITIONS: true
});

App.Router.map(function() {
	//this.route('index', {
	this.route("cards", { path: "/" });
	this.route("about", { path: "/about" });
	this.route("favorites", { path: "/favs" });
	//this.resource('card', {path: "/card/:photo_id"});
	//this.resource('photo', {path: "/photo/:photo_id"});
	//this.resource('user', {path: "/user/:user_id"});
});

App.CardsRoute = Ember.Route.extend({
  setupController: function(controller) {
    controller.set('title', "My App");
  }
});

App.AboutRoute = Ember.Route.extend({
  setupController: function(controller) {
    controller.set('title', "My App");
  }
});

App.FavoritesRoute = Ember.Route.extend({
  setupController: function(controller) {
    controller.set('title', "My App");
  }
});