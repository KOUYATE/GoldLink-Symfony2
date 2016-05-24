function nouveauLien( thematique , url , titre , tag , button , urlmethod ){
    var $thematique =  $('#'+thematique);
    var $url = $('#'+url);
    var $titre = $('#'+titre);
    var $tag = $('#'+tag);
    var $button = $('#'+button);

    $button.click(function(){

        var isValide = $url.val().length > 0 && $titre.val().length > 0 && $thematique.val().length > 0;
        if(isValide){
            $.post(urlmethod , { idThematique : $thematique.val() , url : $url.val() , titre : $titre.val() , tag : $tag.val() } , function(reponse){
               if(reponse == 'ok'){
                   location.href = location.href;
               }
            });

            return false;
        }
    });
}