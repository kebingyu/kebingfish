$(document).ready(function(){function e(){$("#signup-message").find(".text-success").html("").end().find(".text-danger").html("")}function n(e,n){var n=n||"success",t=".text-"+n;$("#signup-message").find(t).html(e).end().modal()}$(".table-striped").on("click",".user-name",function(t){t.preventDefault();var r=$(this),a=r.find("a").text();confirm("Remove "+a+" from this event?")&&$.ajax({url:r.find("a").attr("href"),method:"DELETE",beforeSend:function(){e()}}).done(function(e){return e.ok?($(".badge").text(e.data.goer_count),r.parent().fadeOut(300,function(){$(this).remove()}),void n(a+"'s group has been removed.")):void n(e.error,"danger")})}),$("form.signup").submit(function(t){t.preventDefault();var r=$(this),a=r.attr("action");$.ajax({method:r.attr("method"),url:a,data:r.serialize(),beforeSend:function(){var n=r.find(".has-error");n.find(".error-block").html(""),n.removeClass("has-error"),e()}}).done(function(e){if(e.ok){var t=$(".table-striped tbody");$(".badge").text(e.data.goer_count);var o=r.find('input[name="name"]').val(),i=r.find('input[name="group_size"]').val()||1,d='<tr><td class="user-name"><a href="'+a+"/"+o+'">'+o+'</a></td><td class="user-group-size">'+i+"</td></tr>";return t.append(d),void n(o+"'s group has been added.")}n(e.error,"danger")}).fail(function(e){var n=e.responseJSON;for(var t in n){for(var r=$('input[name="'+t+'"]').parents(".form-group"),a=r.find(".error-block"),o=0,i=n[t].length;o<i;o++){var d='<li class="text-danger">'+n[t][o]+"</li>";a.append(d)}r.addClass("has-error")}})}),$(".js-event-edit").on("click",function(){window.location=$(this).data("url")}),$(".js-event-print").on("click",function(){window.location=$(this).data("url")})});