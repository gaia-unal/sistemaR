<!--<div class="CSSTableGenerator" >

    <table>

        <tr>
            <td >Te puede interesar... </td>
        </tr>
        <php
        for ($j = 0; $j < count($rec); $j++) {
            for ($jj = 0; $jj < count($rec[$j]); $jj++) {
                ?>
                <tr>
                    <td>         <a href="<php echo $rec[$j][$jj]['lo_location']; ?>">
                            <php echo $rec[$j][$jj]['lo_title']; ?> </a>
                    </td>
                </tr>
            <php
            }
        }
        ?>
    </table>

</div>-->

<section class="panel panel-success">
    <header class="panel-heading">
        Te puede interesar
    </header>
    <audio class="speech" src="" hidden="hidden"></audio>
    <div class="list-group">
        <?php
        for ($j = 0; $j < count($rec); $j++) {
            for ($jj = 0; $jj < count($rec[$j]); $jj++) { if($j==0) { $hablehp = $rec[$j][$jj]['lo_title'];}               ?>
                <a class="list-group-item" target="_blank" href="<?php echo $rec[$j][$jj]['lo_location']; ?>"><?php echo $rec[$j][$jj]['lo_title']; ?></a>
            <?php
            }
        }?>
    </div>
</section>

<script>
    $(function(){
        $(document).ready(function(){
            text = encodeURIComponent("<?php echo $hablehp?>");
            var url = "http://text-to-speech-demo.mybluemix.net/synthesize?text=" + text + "&voice=VoiceEsEsEnrique";
            //Voz de Google Translate ------ var url = "https://translate.google.com.co/translate_tts?ie=UTF-8&q=" + text + "&tl=es";
            $('audio.speech').attr('src',url).get(0).play();
            $(".list-group-item").first().trigger("focus");


        });



    });

    $(function () {
        $('.list-group-item').focus(function(e){
            e.preventDefault();
            var text = $(this).html();
            text = encodeURIComponent(text);
            var url = "http://text-to-speech-demo.mybluemix.net/synthesize?text=" + text + "&voice=VoiceEsEsEnrique";
            //Voz de Google Translate ------ var url = "https://translate.google.com.co/translate_tts?ie=UTF-8&q=" + text + "&tl=es";
            $('audio.speech').attr('src',url).get(0).play();
        });
    })
</script>