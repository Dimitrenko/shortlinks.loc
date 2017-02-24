/**
 * Created by misha on 16.02.17.
 */
var param = $('meta[name=csrf-param]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");

$(function(){
    /**
     * включение и выключение поей времени жизни ссылки
     * @type {*|jQuery|HTMLElement}
     */
    var switchTtl = $('#p');

    var statusTtl = $('.status');

    $(switchTtl).on('click',function(){
        if($(statusTtl).hasClass('hide')){
            $(statusTtl).removeClass('hide').addClass('show');
            $(this).text('закрыть');
        }else {
            $(statusTtl).removeClass('show').addClass('hide');
            $(this).text('открыть');
        }

    });

    $('.send').on('click',function(){

        var sourseUrl = $('#links-sourse_url').val();
        var short_url = $('#links-short_url').val();
        var ttl = $('#links-time_of_death').val();
        var ttl_seconds = $('#links-ttl_seconds').val();

        $.ajax({
            method: "POST",
            url: "/link/save",
            data: {
                _csrf:token,
                sourse_url:sourseUrl,
                time_of_death:ttl,
                ttl_seconds:ttl_seconds,
                short_url:short_url,
            },
            success: function(msg){
                $('.status').removeClass('show').addClass('hide');
                $('#p').text('открыть');
                $('#result').attr('href',msg).text(msg);
            }
        });
    });

    /**
     * вкл/выкл поля пользовательской ссылки
     */
    $("#links-checkbox").on('change',function(){
        if (this.checked){
            $('#links-short_url').prop( "disabled", false );
        }else {
            $('#links-short_url').prop( "disabled", true );
        }
    });
});

/*

 */
