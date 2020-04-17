(function($) {
  $("#page #menu nav > a").unwrap();
  $("#page #menu .no-action").each(function(){
    $(this).remove();
  });
  $("#page #menu ul > a, #page #menu nav > a").each(function() {
    $(this).wrap("<li></li>");
  });
  $(document).ready(function() {
    if ($(".block_cocoon_slider_1").length) {
      $slider = $(".block_cocoon_slider_1");
      $(".inner_page_breadcrumb").replaceWith($slider);
    }
    if ($(".block_cocoon_slider_2").length) {
      $slider = $(".block_cocoon_slider_2");
      $(".inner_page_breadcrumb").replaceWith($slider);
    }
    if ($(".block_cocoon_slider_3").length) {
      $slider = $(".block_cocoon_slider_3");
      $(".inner_page_breadcrumb").replaceWith($slider);
    }
    if ($(".block_cocoon_slider_4").length) {
      $slider = $(".block_cocoon_slider_4");
      $(".inner_page_breadcrumb").replaceWith($slider);
    }
    if ($(".block_cocoon_hero_1").length) {
      $slider = $(".block_cocoon_hero_1");
      $(".inner_page_breadcrumb").replaceWith($slider);
    }
    if ($(".block_cocoon_hero_2").length) {
      $slider = $(".block_cocoon_hero_2");
      $(".inner_page_breadcrumb").replaceWith($slider);
    }
    if ($(".block_cocoon_hero_3").length) {
      $slider = $(".block_cocoon_hero_3");
      $(".inner_page_breadcrumb").replaceWith($slider);
    }
    $(".footer_menu_widget > ul > div").each(function() {
      $(this).wrap("<li class='list-inline-item'></li>");
    });
    $(".ccn_blog-row > #maincontent,.ccn_blog-row > h2,.ccn_blog-row > .addbloglink").prependTo("#ccn-main .container");
    $(".ccn-faq_according #accordion .panel:first-child .panel-collapse").addClass("show");
    $(".dashbord_nav_list > a:first-child").prepend("<span class='flaticon-puzzle-1'></span>");
    $(".dashbord_nav_list > a:nth-child(2)").prepend("<span class='flaticon-student'></span>");
    $(".dashbord_nav_list > a:nth-child(3)").prepend("<span class='flaticon-rating'></span>");
    $(".dashbord_nav_list > a:nth-child(4)").prepend("<span class='flaticon-speech-bubble'></span>");
    $(".dashbord_nav_list > a:nth-child(5)").prepend("<span class='flaticon-settings'></span>");
    $(".dashbord_nav_list > a:nth-child(6)").prepend("<span class='flaticon-logout'></span>");
    $(".dashbord_nav_list > a:nth-child(7)").prepend("<span class='flaticon-add-contact'></span>");
    $(".dashbord_nav_list > a").each(function() {
      $(this).removeClass("dropdown-item").wrap("<li></li>");
    });
    $(".dashbord_nav_list > li").wrapAll("<ul></ul>");
    $(".ccn-blog-list-entry").wrapAll("<div class='row'></div>");
    $(".addbloglink").each(function() {
      $(this).find("a").addClass("btn dbxshad btn-lg btn-thm circle white");
    });
    $("body.role-standard #ccn-main-region").each(function() {
      if (!$(this).find(".block").length && !$(this).find("#ccn-main").text().trim().length) {
        $("#ccn-main-region").css({
          'padding-top': '0',
          'padding-bottom': '0',
        });
        $("#ccn-main").remove();
      }
    });
    $("body#page-site-index.ccn_header_style_7,body#page-site-index.ccn_header_style_3,body#page-site-index.ccn_header_style_4,body#page-site-index.ccn_header_style_5,body#page-site-index.ccn_header_style_6,body#page-site-index.ccn_header_style_8").each(function() {
      var list = $('ul#respMenu');
      var listItems = list.children('li');
      list.append(listItems.get().reverse());
    });
    $(".header_top.home2 .block_cocoon_globalsearch_n, .header-nav.menu_style_home_three .block_cocoon_globalsearch_n, header .block_cocoon_library_list").addClass("ccn-alt-blk-actm");
    $("body#page-enrol-index.ccn_course_list_style_1 .generalbox.info").each(function() {
      $(this).find(".col-lg-6.col-xl-4").addClass("col-lg-12 p0 courses_list_content").removeClass("col-lg-6 col-xl-4");
      $(this).find(".top_courses").addClass("list");
    });
    if ($("body#page-enrol-index .generalbox:contains('payment')").length > 0) {
      $("body#page-enrol-index .generalbox:contains('payment')").addClass("ccn-enrol-cta-box");
    }
    /* Message Drawer Handler */
    $("#ccn-messagedrawer-close").click(function() {
      $(".drawer").attr("aria-expanded", "false").attr("aria-hidden", "true").addClass("hidden");
    });
  });
  $(window).load(function() {
    $(".comment-message").each(function() {
      var $comment = $(this);
      $(this).addClass("media csv1");
      $(this).find(".userpicture").addClass("align-self-start mr-3 ccn_userpicture").removeClass("userpicture");
      $(this).find(".time").each(function() {
        $(this).prependTo($comment.find(".text")).replaceWith("<span class='sspd_postdate fz14'>" + $(this).text() + "</span>");
      });
      $(this).find(".user").each(function() {
        $(this).prependTo($comment.find(".text")).replaceWith("<h4 class='sub_title mt-0 mb0'>" + $(this).text() + "</h4>");
      });
      $(this).find(".text_to_html").addClass("fz15 mt20");
      $(this).find(".text").addClass("media-body");
      $("<div class='custom_hr'></div>").insertAfter($comment);
    });
    $(".block_comments").each(function() {
      var $commentarea = $(this).find(".comment-area");
      $commentarea.insertAfter($(this)).addClass("comments_form");
      $commentarea.prepend("<h4>Add a Comment & Review</h4>").wrap("<div class='cs_row_seven'><div class='sfeedbacks'><div class='mbp_comment_form style2 pb0'></div></div></div>");
      $commentarea.find(".db").wrap("<div class='form-group'></div>");
      $commentarea.find(".fd a").append("<span class='flaticon-right-arrow-1'></span>");
    });
    $(".cs_row_one.ccn-pullto-breadcrumb").each(function() {
      $(".inner_page_breadcrumb").replaceWith("<section class='inner_page_breadcrumb csv2'><div class='container'><div class='row'><div class='col-xl-9'><div class='breadcrumb_content'><div class='cs_row_one csv2'><div class='cs_ins_container'></div></div></div></div></div></div></section>");
      $(this).find(".ccn-identify-course-intro").appendTo(".breadcrumb_content .cs_ins_container");
      if ($(window).width() > 1000) {
        $("#block-region-side-pre").css("margin-top", "-300px");
      }
      $(window).resize(function() {
        if ($(window).width() > 1000) {
          $("#block-region-side-pre").css("margin-top", "-300px");
        }
      });
      $(".instructor_pricing_widget").addClass("csv2");
      $(".feature_course_widget,.blog_tag_widget").addClass("csv1");
      $(".selected_filter_widget,.cs_overview,.course_content,.about_ins_container,.block_comments,.sfeedbacks").addClass("ccn-csv2");
    });
    $(".cs_row_one.ccn-pullto-breadcrumb-fullwidth").each(function() {
      $(".inner_page_breadcrumb").replaceWith("<section class='inner_page_breadcrumb csv3'><div class='container'><div class='row'><div class='col-xl-12'><div class='breadcrumb_content'><div class='cs_row_one csv3'><div class='cs_ins_container'></div></div></div></div></div></div></section>");
      $(this).find(".cs_watch_list").insertAfter($(this).find(".cs_review_enroll"));
      $(this).find(".ccn-identify-course-intro").appendTo(".breadcrumb_content .cs_ins_container");
    });
    if ($(".ccn_course_list_style_2.pagelayout-coursecategory .shadow_box").length) {
      $("#ccn-main-region").addClass("courses-list");
      $(".selected_filter_widget").each(function() {
        $(this).removeClass("style2").addClass("style3");
      });
      $(".blog_tag_widget").each(function() {
        $(this).addClass("style3 selected_filter_widget");
      });
    }
  });
  $(".user_setting > .dropdown > a").click(function() {
    $(".popover-region-notifications").addClass("collapsed");
    $(".popover-region-container").attr("aria-expanded", "false").attr("aria-hidden", "true");
  });
}(jQuery));
