jQuery(function($){$(document).scrollTop()>0&&($(".site-header").addClass("shrink"),$(".nav-secondary").addClass("shrink")),$(document).on("scroll",function(){$(document).scrollTop()>0?($(".site-header").addClass("shrink"),$(".nav-secondary").addClass("shrink")):($(".site-header").removeClass("shrink"),$(".nav-secondary").removeClass("shrink"))}),$("#mobile-menu-button").click(function(){$("nav.nav-secondary").toggle()}),$("div#mobile-inventory-menu-button").click(function(){$("#menu-inventory-menu").toggle()}),$(".nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>'),$(".responsive-menu-icon").click(function(){$(this).next(".nav-primary .genesis-nav-menu,  .nav-secondary .genesis-nav-menu").slideToggle()}),$(window).resize(function(){window.innerWidth>980&&($(".nav-primary .genesis-nav-menu,  .nav-secondary .genesis-nav-menu, nav .sub-menu").removeAttr("style"),$(".responsive-menu > .menu-item").removeClass("menu-open"))}),$(".responsive-menu > .menu-item").click(function(n){n.target===this&&$(this).find(".sub-menu:first").slideToggle(function(){$(this).parent().toggleClass("menu-open")})}),$(window).scroll(function(){$(window).scrollTop()+$(window).height()>=$(document).height()-450?$("#schedule-consult-button").addClass("sched-button-low"):$("#schedule-consult-button").removeClass("sched-button-low")})});