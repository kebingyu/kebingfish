$(document).ready(function(){function e(){$("#signup-message").find(".text-success").html("").end().find(".text-danger").html("")}function t(e,t){var t=t||"success",n=".text-"+t;$("#signup-message").find(n).html(e).end().modal()}$(".table-striped").on("click",".user-name",function(n){n.preventDefault();var r=$(this),a=r.find("a").text();confirm("Remove "+a+" from this event?")&&$.ajax({url:r.find("a").attr("href"),method:"DELETE",beforeSend:function(){e()}}).done(function(e){return e.ok?($(".badge").text(e.data.goer_count),r.parent().fadeOut(300,function(){$(this).remove()}),void t(a+"'s group has been removed.")):void t(e.error,"danger")})}),$("form.signup").submit(function(n){n.preventDefault();var r=$(this),a=r.attr("action");$.ajax({method:r.attr("method"),url:a,data:r.serialize(),beforeSend:function(){var t=r.find(".has-error");t.find(".error-block").html(""),t.removeClass("has-error"),e()}}).done(function(e){if(e.ok){var n=$(".table-striped tbody");$(".badge").text(e.data.goer_count);var o=r.find('input[name="name"]').val(),i=r.find('input[name="group_size"]').val()||1,d='<tr><td class="user-name"><a href="'+a+"/"+o+'">'+o+'</a></td><td class="user-group-size">'+i+"</td>";if($("th.user-option").length>0){var s=r.find('select[name="option"]').val();d+='<td class="user-option">'+s+"</td>"}return d+="</tr>",n.append(d),void t(o+"'s group has been added.")}t(e.error,"danger")}).fail(function(e){var t=e.responseJSON;for(var n in t){for(var r=$('input[name="'+n+'"]').parents(".form-group"),a=r.find(".error-block"),o=0,i=t[n].length;o<i;o++){var d='<li class="text-danger">'+t[n][o]+"</li>";a.append(d)}r.addClass("has-error")}})}),$(".js-event-edit").on("click",function(){window.location=$(this).data("url")}),$(".js-event-print").on("click",function(){window.location=$(this).data("url")})});