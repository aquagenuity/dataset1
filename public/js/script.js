$(function() {
    var c = {
        lines: 9,
        length: 4,
        width: 3,
        radius: 4,
        corners: 1,
        rotate: 0,
        color: "#fff",
        speed: 1.2,
        trail: 50,
        shadow: false,
        hwaccel: false,
        className: "spinner",
        zIndex: 2000000000,
        top: "13px",
        left: "auto"
    };
    var d = ["#aaacac", "#867d73", "#5f5c6a"];
    var a = 0;

    function b() {
        a = ((a == 2) ? 0 : a + 1);
        nextScreen = ((a == 2) ? 0 : a + 1);
        $(".screen").delay(300).animate({
            left: "-=288"
        }, 400, function() {
            $("#screen_" + nextScreen).animate({
                left: "288"
            }, 0)
        });
        if (a == 0) {
            $("#bg_0").animate({
                opacity: 1
            }, 0);
            $("#bg_2").animate({
                opacity: 0
            }, 1000)
        } else {
            $("#bg_" + a).animate({
                opacity: 1
            }, 1000, function() {
                $("#bg_" + (a - 1)).animate({
                    opacity: 0
                }, 0)
            })
        }
        $(".footer").removeClass("bg_1 bg_2 bg_3").addClass("bg_" + a);
        $("#submit").removeClass("bg_1 bg_2 bg_3").addClass("bg_" + a)
    }
    $("#subscribe").submit(function() {
        $("#submit").attr("disabled", true);
        $("#submit").attr("value", "");
        var f = document.getElementById("submitwrapper");
        var g = new Spinner(c).spin(f);
        $.ajax({
            url: "handler/subscribe",
            data: "email=" + escape($("#email").val()),
            success: function(data) {
              g.stop();
              $("#submit").attr("value", "Go");
              $("#message").css({
                  opacity: 0,
                  display: "block"
              });

              var msg = null;
              if(data.status == 'success'){
                msg = "Success! Check your email.";
                $("#message").css("color", "#3fb35b");
                $("#email").val("")
              } else {
                msg = data.error;
                $("#message").css("color", "#cc1919")
              }

              $("#message").text(msg);

              $("#message").animate({
                  opacity: 1
              }, 300, function() {
                  $("#message").delay(2000).animate({
                      opacity: 0
                  }, 300, function() {
                      $("#message").css("display", "none");
                      $("#submit").attr("disabled", false)
                  })
              })

            }
        });
        return false
    })
});