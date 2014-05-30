/**
 * Open and Close a Div width a mini form inside
 * (Ex : Adding an oeuvre to a catalogue item)
 * @param {type} envId
 * @returns {undefined}
 */
function openDiv(envId) {
    $('#spanOpen' + envId).hide(function() {
        $('#hiddenDiv' + envId).show();
    });
}
function closeDiv(envId) {
    $('#hiddenDiv' + envId).hide(function() {
        $('#spanOpen' + envId).show();
    });
}

function clearFields(target){
    index = target.toLowerCase();
    $('#filter_'+index).val('');
    $('#id_'+index).val('');
    closeInfoBox(target);
}

function openInfoBox(target) {

    //closing of all the other boxes of summary content.
    listBox = $('.divSummaryContent');
    $.each(listBox, function() {
        if ($(this).attr('id') != target && $(this).css('display') == 'block') {
            divToClose = $(this).attr('id');
            divToClose = divToClose.replace('divSummaryContent', '');
            closeInfoBox(divToClose);
        }
    });

    textLinkBox = new Array;
    textLinkBox['Oeuvre'] = 'Oeuvre';

    //Test if the divSummaryContent box already exist
    //If not create it and create the link to close the box.
    if ($('#divSummaryContent' + target).length == 0) {

        $('#block' + target).before('<div id="divSummaryContent' + target + '" class="divSummaryContent"></div>');

        $('<div>', {
            id: 'divOpenSummaryContent' + target,
            class: 'divOpenSummaryContent'
        }
        ).append('<a href="#" class="open" onclick="return false;"><span><i class="fa fa-chevron-left fa-6" style="font-size:1em;"></i> Open box for: ' + textLinkBox[target] + '</span></a>').on('click', 'a', function() {
            openInfoBox(target);
        }).insertBefore('#block' + target);

    }

    divBox = $('#divSummaryContent' + target);
    //In case of the box still opened, close it.
    divBox.hide();

    idDivBox = $(divBox).attr('id');

    //If boxes already exist, just open it.
    if (divBox.css('display') == 'none') {

        var top = $('#block' + target).offset().top;
        var top = top - 200;
        divBox.css({'top': top + 'px'}).toggle(500);

        $('#divOpenSummaryContent' + target).css({'display': 'none', 'top': top + 'px'});

        //Ajout du lien pour fermer le cadre.
        if ($('#' + idDivBox + ' .close').length == 0) {
            divBox.append('<a href="#" class="close" onclick="return false;"><span style="text-align:right;">Close <i class="fa fa-chevron-right fa-4" style="font-size:1em;"></i></span></a>').on('click', 'a', function() {
                closeInfoBox(target);
            });
        }

        //cherche entité AuteurOeuvre pour la création des cadres contenant les tableaux
        /*if (cible.search('AuteurOeuvre') >= 0) {
         
         if ($j('#' + idDivCadre + ' #tblAuteur' + increment).length == 0 || $j('#' + idDivCadre + ' #tblOeuvre' + increment).length == 0) {
         divCadre.append('<div id="tblAuteur' + increment + '" class="tblAuteur"></div><div id="tblOeuvre' + increment + '" class="tblOeuvre"></div>');
         }
         
         }
         //cherche entité Saint pour la création des cadres contenant les tableaux
         if (cible.search('Saint') >= 0) {
         
         if ($j('#' + idDivCadre + ' #tblSaint' + increment).length == 0) {
         divCadre.append('<div id="tblSaint' + increment + '" class="tblSaint"></div>');
         }
         }
         //cherche entité copistes possesseurs autres (copo) pour la création des cadres contenant les tableaux
         if (cible.search('Copo') >= 0) {
         
         if ($j('#' + idDivCadre + ' #tblCopo' + increment).length == 0) {
         divCadre.append('<div id="tblCopo' + increment + '" class="tblCopo"></div>');
         }
         }*/


    }

    /*if($('#divSummaryContent'+name).css('display') == 'none'){
     
     var top = $('#block'+name).offset().top - 200;
     
     $('#divSummaryContent'+name).css({'top': top+'px'}).toggle(500);
     $('#divOpenInfoBox'+name).css({'display':'none'});
     
     }*/

}

function closeInfoBox(target) {

    var top = $('#block' + target).offset().top;
    var top = top - 200;

    $('#divOpenSummaryContent' + target).css({'display': 'block', 'top': top + 'px'});

    /*if ($j('#tblAuteur' + num).html() != ''
            || $j('#tblOeuvre' + num).html() != ''
            || $j('#tblIdentifiant' + num).html() != ''
            || $j('#tblSaint' + num).html() != ''
            || $j('#tblCopo' + num)) {

        $j('#divOpenCadre' + cible).css({'display': 'block', 'top': top + 'px'});
    }*/

    $('#divSummaryContent' + target).toggle(500, function() {
        $('#divSummaryContent' + target).hide();
    });
}

