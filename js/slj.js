/*
	Savannah Julian
	2013
*/

var Gallery;

$(document).ready( function ( ) {

	// Set PJAX options:
	$.pjax.defaults.scrollTo = false;

	$(document).pjax( 'a' , 'body' , {
		fragment : 'body',
		timeout : 5000
	});

	$(document).on( 'pjax:send' , function ( ) {
		// $(document.body).fadeOut();
	});

	$(document).on( 'pjax:complete' , function ( ) {
		// $(document.body).fadeIn();
		if ( ! $('#main').hasClass('home') ) {
			initGallery();
			$(document.body).animate({
				scrollTop : $('#menu-main-navigation').offset().top - 40
			});
		} else {
			$(document.body).animate({
				scrollTop : 0
			});
		}
	});

	initGallery();
});

function initGallery ( ) {
	Gallery = new Slideshow( '#slideshow' , {
		forward : ".slide-next",
		back : ".slide-prev",
		auto : false,
		slides : ".slide",
		wrapper : ".slides",
		speed : 500
	});
}

/*
	Slides
	by August Miller gusmiller.com
*/

function Slideshow ( el , opts ) {
	var self = this;

	self.el = $(el);
	self.slides = [];
	self.current = 0;
	self.options = {
		forward : $(opts.forward),
		back : $(opts.back),
		auto : opts.auto_advance || true,
		slides : $(opts.slides) || $(".slide"),
		wrapper : $(opts.wrapper) || $(".slides"),
		speed : opts.speed || 500
	};
	self.touch = {};

	self.listen();
	self.init();
}

Slideshow.prototype = {

	init : function ( ) {
		var self = this,
			els = self.options.slides;

		els.each( function ( index ) {
			self.slides.push( new Slide ( this , index ) );
		});

		self.layout();
		self.pick(0);
	},

	listen : function ( ) {
		var self = this;
		// console.log("listen()");

		$(window).on( "resize" , function ( e ) {
			self.layout( e );
		});

		$(self.options.forward).on( 'click' , function ( e ) {
			self.next( self.options.speed );
		});

		$(self.options.back).on( 'click' , function ( e ) {
			self.prev( self.options.speed );
		});

		$(window).on( "keyup" , function ( e ) {
			switch ( e.keyCode ) {
				case 39 :
					self.next( self.options.speed );
					break;
				case 37 :
					self.prev( self.options.speed );
					break;
			}
		});

		$(self.el).on( 'touchstart' , function ( e ) {
			self.touchSetup( e.originalEvent );
		});

		$(self.el).on( 'touchmove' , function ( e ) {
			self.touchPan( e.originalEvent );
		});

		$(self.el).on( 'touchend' , function ( e ) {
			self.touchConclude( e.originalEvent );
		});
	},

	touchSetup : function ( e ) {
		var self = this;
		// console.log(e);

		self.touch.start = {
			position : e.touches[0].pageX,
			time : e.timeStamp
		};
	},

	touchPan : function ( e ) {
		var self = this;
		// console.log(e);

		self.touch.delta = {
			distance : ( self.touch.start.position - e.touches[0].pageX ),
			duration : ( e.timeStamp - self.touch.start.time )
		};

		self.options.wrapper.css({
			left : ( ( - self.touch.delta.distance ) - ( self.el.width() * self.current ) )
		});
	},

	touchConclude : function ( e ) {
		var self = this;
		// console.log(e);

		if ( Math.abs( self.touch.delta.distance ) > ( self.el.width() / 4 ) ) {
			if ( self.touch.delta.distance > 0 ) {
				self.next( Math.min( self.touch.delta.duration , self.options.speed ) );
			} else {
				self.prev( Math.min( self.touch.delta.duration , self.options.speed ) );
			}
		} else {
			self.pick( self.current , 250 );
		}
	},

	next : function ( speed ) {
		var self = this;
		// console.log("next()");
		self.pick( ( ( self.current + 1 < self.slides.length ) ? ( self.current + 1 ) : ( self.slides.length - 1 ) ) , speed );
	},

	prev : function ( speed ) {
		var self = this;
		// console.log("prev()");
		self.pick( ( ( self.current - 1 >= 0 ) ? ( self.current - 1 ) : ( 0 ) ) , speed );
	},

	pick : function ( index , speed ) {
		var self = this;
		// console.log(["pick()",index]);
		if ( speed ) {
			$(self.options.wrapper).animate({
				"left" : - ( index * self.el.width() )
			} , {
				duration : speed,
				queue : false
			});
		} else {
			$(self.options.wrapper).css({
				"left" : - ( index * self.el.width() )
			});
		}
		self.current = index;
	},

	layout : function ( e ) {
		var self = this,
			width = self.el.width();
		// console.log("layout()");

		self.options.wrapper.css({
			"width" : ( self.slides.length * self.el.width() )
		});

		for ( var s = 0; s < self.slides.length; s++ ) {
			self.slides[s].resize( width );
		}

		self.pick( self.current , 500 );
	}

}

function Slide ( el , index ) {
	var self = this;

	self.el = $(el);
	self.index = index;

	// console.log("Hi, I'm a slide!");
}

Slide.prototype.resize = function ( width ) {
	var self = this;
	// console.log(["Holy fuck resize like hell bitches",width]);
	self.el.css({
		"width" : width
	});
};
