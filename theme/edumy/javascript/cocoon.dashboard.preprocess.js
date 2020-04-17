(function($) {
  $(document).ready(function() {
    $(".ccn_receipt_handler").click(function(event) {
      event.preventDefault();
      var receiptID = $(this).attr("data-ccn-receipt-id");
      var w = window.open("", "popupWindow", "width=650, height=450, scrollbars=yes");
      var $w = $(w.document.body);
      $w.html($('#' + receiptID).html());
    });
    if ($(".path-admin-report-overviewstats").length) {
      $(".chartslist").each(function() {
        $(this).addClass("row");
        $(this).find(">li").each(function() {
          var href = $(this).find("a").attr('href');
          $(this).find("a").contents().unwrap();
          $(this).addClass("col-sm-6 col-md-6 col-lg-6 col-xl-3");
          $(this).wrapInner("<a href='" + href + "' class='ff_one'><div class='detais'></div></a>");
        });
        $(this).find(">li:nth-child(1) .ff_one").append("<div class='ff_icon'><span class='flaticon-user'></span></div>");
        $(this).find(">li:nth-child(2) .ff_one").addClass("style2").append("<div class='ff_icon'><span class='flaticon-global'></span></div>");
        $(this).find(">li:nth-child(3) .ff_one").addClass("style3").append("<div class='ff_icon'><span class='flaticon-consulting-message'></span></div>");
        $(this).find(">li:nth-child(4) .ff_one").addClass("style4").append("<div class='ff_icon'><span class='flaticon-elearning-1'></span></div>");
      });
      $(".chart").each(function() {
        $(this).addClass("application_statics mb40");
        $(this).find("h1, h2").each(function() {
          $(this).replaceWith("<h4>" + $(this).text() + "</h4>");
        });
        $(this).find("h3").each(function() {
          $(this).replaceWith("<h5>" + $(this).text() + "</h5>");
        });
      });
    }
    if ($(".path-admin-report-coursestats").length) {
      $(".chart-area").each(function() {
        $(this).wrap("<div class='application_statics mb20'></div>");
      });
      $("table").each(function() {
        $(this).addClass("application_statics");
      });
      if ($("p:contains('Export to CSV')").length > 0) {
        $("p:contains('Export to CSV') a").addClass("btn btn-secondary");
      }
    }
  });
  $(window).load(function() {
    // if ($(".path-admin-report-overviewstats").length) {
    //   $(".yui3-circle.yui3-svgCircle.yui3-seriesmarker").each(function(){
    //      $(this).attr("stroke", "#ff1053").attr("fill", "#ff1053");
    //   });
    //   $(".yui3-shape.yui3-svgShape.yui3-rect.yui3-svgRect.yui3-seriesmarker").each(function(){
    //      $(this).attr("fill", "#ff1053");
    //   });
    //   $(".yui3-shape.yui3-svgShape.yui3-path.yui3-svgPath").each(function(){
    //      $(this).attr("stroke", "#ff1053");
    //   });
    //   $(".yui3-widget.yui3-graph").each(function(){
    //     $(this).find(".yui3-path.yui3-svgPath").each(function(){
    //       $(this).attr("stroke", "#eee");
    //     });
    //   });
    //   $(".yui3-widget.yui3-axis.yui3-numericaxis, .yui3-widget.yui3-axis.yui3-categoryaxis").each(function(){
    //     $(this).find(".yui3-shape.yui3-svgShape.yui3-path.yui3-svgPath").each(function(){
    //       $(this).attr("stroke", "#eee");
    //     });
    //   });
    // }
  });
}(jQuery));
