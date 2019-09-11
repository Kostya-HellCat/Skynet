$(document).ready(function(){

    $('.onclick').click(function() {
        dataString = $(this).parent().parent().data('tarif').split('!');
        $("#tarif-title").empty();
        $("#tarifs").empty();
        $("#tarif-title").append("Тариф \""+dataString[0]+"\"");

        var i = 1;
        var j = 1;

        var onePrice = 0;
        var pricePerM = 0;
        var disc = 0;

        var c = ['1','21','31','41','51','61','71','81','91'];
        var ca = ['2','3','4','22','23','24','32','33','34','42','43','44','52','53','54','62','63','64','72','73','74','82','83','84','92','93','94'];

        var tarif = [];
        var tarifData = [];

        if (dataString[0]){
            tarifName = dataString[i];
        }

        while (dataString[i]){
                tarifData.push(dataString[i]);
                tarifData.push(dataString[i+1]);
                tarifData.push(dataString[i+2]);
                tarif.push(tarifData);
                i = i + 3;
                tarifData = [];
            }

        tarif.sort(function(a, b) {
            return a[2] == b[2] ? a > b : a[2] > b[2]
        });

        i = 0;

        while (tarif[i]){
            onePrice = tarif[i][0];
            pricePerM = onePrice/tarif[i][1];
            disc = tarif[0][0]*tarif[i][1] - onePrice;

            $("#tarifs").append("<div class=\"item col-sm-12 col-md-6 col-lg-4 flex-row justify-content-center align-items-center\"><div class=\"time\">"+tarif[i][1]+" меся"+(c.indexOf(tarif[i][1]) != -1 ? "ц" : (ca.indexOf(tarif[i][1]) != -1 ? "ца" : "цев"))+"</div> <a class=\"onclicks\" href=\"#\"><div class=\"item-content row col-12 text-left flex-row align-items-center\"><div class=\"col-8 flex-column align-items-center justify-content-start no-padd\"><p class=\"coast\">"+pricePerM+" &#8381/месяц</p> <p class=\"ot-coast\">разовый платеж - "+onePrice+" &#8381</p>"+(disc != 0 ? "<p class=\"ak\">скидка - "+disc+" &#8381</p>" : "")+"</div><div class=\"col-4 text-right flex-column align-items-end justify-content-center no-padd\"> <i class=\"fa faarrow fa-angle-right\" aria-hidden=\"true\"></i></div></div></a></div>");
            i++;

        }

        $("#bg-gray1").show("blind", {direction: "right"}, 300);
        $("#second-view").show("blind", {direction: "right"}, 300);

        $('.onclicks').click(
            function() {
                $("#tarifs2").empty();
                var date = new Date();

                var time = $(this).parent().children('.time').html();
                var price = $(this).children().children().children('.ot-coast').html();
                var price2 = $(this).children().children().children('.coast').html();

                var month = time.replace(/\D+/g, '');
                var day = date.getDate();
                var mon = ((date.getMonth() + 1) + Number(month))%12;
                var yea = date.getFullYear();

                if (mon == 0){
                    mon = '01';
                } else{
                    if (mon.toString().length == 1){
                        mon = "0"+mon;
                    }};

                $("#tarifs2").append("<div class=\"item col-sm-12 col-md-6 col-lg-4 flex-row justify-content-center align-items-center\"><div class=\"time\">Тариф \""+dataString[0]+"\"</div> <a class=\"onclicks\" href=\"#\"><div class=\"item-content row col-12 text-left flex-row align-items-center\"><div class=\"col-12 flex-column align-items-center justify-content-start no-padd\"><p class=\"coast\">Период оплаты - "+time+"<br>"+price2.replace(/\D+/g, '')+" &#8381/мес</p><p class=\"ot-coast\">"+price+"<br>со счета спишется - "+price.replace(/\D+/g, '')+"</p><p class=\"actime\">вступит в силу - сегодня<br>активно до - "+day+"."+mon+"."+yea+"</p></div></div></a><div class=\"butt-cont\"><a class=\"button\">Выбрать</a></div></div>");

                $("#bg-gray2").show("blind", {direction: "right"}, 300);
                $("#third-view").show("blind", {direction: "right"}, 300);
            });

    });

    $('.sec-close').click(
        function() {
            $("#second-view").hide("blind", { direction: "right" }, 300);
            $("#bg-gray1").hide("blind", { direction: "right" }, 300);
        });



    $('.thi-close').click(
        function() {
            $("#third-view").hide("blind", { direction: "right" }, 300);
            $("#bg-gray2").hide("blind", { direction: "right" }, 300);
        });
});