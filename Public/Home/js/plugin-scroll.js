(function($) {
	$.fn.extend({
		slide : function(d) {
			var f = {
				slideItem : [],
				slideNav : [],
				eventType : 'click',
				next : '#next',
				prev : '#prev',
				N : 0,
				speed : 800,
				effect : 'normal',
				isRotate : true,
				isAddAutoNav : true,
				pause : 5000,
				addAutoNav : '<li class="' + d.slideNav.replace(/\./, '') + '"><\/li>',
				navParent : d.navParent,
				itemSelected : d.itemSelected,
				navSelected : d.navSelected,
				fadeInCallback : function() {
				},
				scrollCallback : function() {
				}
			};
			d = $.extend(f, d);
			var o = this, animate = false, timer = null, position = null, slideItem = o.find(d.slideItem), slideNav = o.find(d.slideNav), next = o.find(d.next), prev = o.find(d.prev), navParent = o.find(d.navParent), scroll = slideItem.parent(), currReg = new RegExp('\\b' + d.navSelected + '\\b'), N = d.N >= 0 ? (d.N >= slideItem.length ? 0 : d.N) : (-d.N >= slideItem.length ? 0 : -d.N);
			if (d.effect === 'scroll') {
				scroll.css('left', '-' + (parseInt(slideItem.eq(N).css('width')) * N) + 'px')
			}
			slideNav.eq(N).addClass(d.navSelected);
			slideItem.eq(N).addClass(d.itemSelected);
			o.addAutoNav = function() {
				var b;
				var c = function() {
					var a = [];
					if (slideItem && slideItem.length) {
						slideItem.each(function(i) {
							a.push(d.addAutoNav)
						});
						return a.join('')
					}
				};
				b = c();
				navParent.append(b);
				nav = navParent.find(d.slideNav);
				slideNav = nav;
				slideNav.eq(N).addClass(d.navSelected)
			};
			o.show = function(a) {
				var b = d.effect;
				if (!animate) {
					animate = true;
					switch (b) {
						case 'scroll':
							position = parseInt(slideItem.eq(a).outerWidth()) * a;
							scroll.animate({
								left : '-' + position + 'px'
							}, d.speed, function() {
								slideItem.removeClass(d.itemSelected);
								slideItem.eq(a).addClass(d.itemSelected);
								d.scrollCallback(slideItem.eq(a), slideItem, o);
								animate = false
							});
							break;
						case 'fade':
							slideItem.fadeOut(d.speed);
							slideItem.eq(a).fadeIn(d.speed, function() {
								animate = false;
								slideItem.removeClass(d.itemSelected);
								slideItem.eq(a).addClass(d.itemSelected);
								d.fadeInCallback && d.fadeInCallback(slideItem.eq(a), slideItem, o)
							});
							break;
						default:
							slideItem.removeClass(d.itemSelected).hide();
							slideItem.eq(a).show().addClass(d.itemSelected);
							animate = false;
							break
					}
					slideNav.removeClass(d.navSelected);
					slideNav.eq(a).addClass(d.navSelected)
				}
			};
			o.seq = function() {
				slideNav.each(function(i) {
					if (currReg.test($(this).attr('class'))) {
						N = i
					}
				});
				return N
			};
			o.next = function() {
				o.seq();
				N = N + 1;
				if (N >= slideItem.length) {
					N = 0
				}
				o.show(N)
			};
			o.prev = function() {
				o.seq();
				N = N - 1;
				if (N < 0) {
					N = slideItem.length - 1
				}
				o.show(N)
			};
			o.doNext = function() {
				next[d.eventType](o.next);
				o.stop(next)
			};
			o.doPrev = function() {
				prev[d.eventType](o.prev);
				o.stop(prev)
			};
			o.stop = function(a) {
				if (d.isRotate) {
					a.each(function() {
						$(this).hover(function() {
							o.stopRotate()
						}, function() {
							o.startRotate()
						})
					})
				}
			};
			o.toggle = function() {
				slideNav.each(function(i) {
					$(this)[d.eventType](function(e) {
						if (i === o.seq()) {
							return false
						}
						o.show(i)
					})
				});
				o.stop(slideNav)
			};
			o.startRotate = function() {
				timer = setTimeout(function() {
					o.next();
					o.startRotate()
				}, d.pause)
			};
			o.stopRotate = function() {
				if (timer) {
					clearTimeout(timer);
					timer = null
				}
			};
			o.setRun = function() {
				return {
					init : function() {
						if (d.isRotate) {
							o.startRotate()
						}
						if (d.isAddAutoNav) {
							o.addAutoNav()
						}
						o.toggle();
						o.doPrev();
						o.doNext()
					}
				}
			}();
			o.init = function() {
				return o.setRun.init()
			};
			return o.each(function() {
				return o.init()
			})
		}
	})
})(jQuery); 