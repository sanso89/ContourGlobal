

//Date Picker pour la date d'enregistrement de la declaration
$(function(){
  $.datepicker.regional['fr'] = {
  closeText: 'Fermer',
  prevText: 'Précédent',
  nextText: 'Suivant',
  currentText: 'Aujourd\'hui',
  monthNames:['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
  monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Dec.'],
  dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
  dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
  dayNamesMin: ['D','L','M','M','J','V','S'],
  weekHeader: 'Sem.',
  dateFormat: 'dd/mm/yy',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ''};

  $.datepicker.setDefaults($.datepicker.regional['fr']);

  $('#date_enreg').datepicker({
    dateFormat: "dd/mm/yy"
  });

  $('#date_naissance').datepicker({
    dateFormat: "dd/mm/yy"
  });
  $('#date_induction').datepicker({
    dateFormat: "dd/mm/yy"
  });
  $('#date_expiration').datepicker({
    dateFormat: "dd/mm/yy"
  });

});
//fin date Picker


//DATATABLE pour la liste des demandes de destruction avec les rapports
$(function(){
  $('#data_table_induction1').DataTable({
    language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
  });
});
//fin DATATABLE pour la liste des demandes de destructions avec les rapports


/*utilisation du plugin select2 pour la liste des type de declaration
sur le formulaire de listing de declaration importees*/
$(function(){
  $('#liste_society').select2();
});


function check_sortie_form(){
    var nom_societe=$("#code_societe").text();
    $("#nom_societe").val(nom_societe);
}

/* fin traitement sorties*/



/*DataTable pour la situation des sommiers*/
$(function(){
    $('#data_table_induction tfoot th').each(function(){
        var title=$(this).text();
        $(this).html('<input type="text" placeholder="'+title+'">');
    });
    var table=$('#data_table_induction').DataTable();

    table.columns().every(function(){
        var that = this;
        $('input',this.footer()).on('keyup change',function(){
            if(that.search()!=this.value){
                that
                    .search(this.value)
                    .draw();
            }
        });
    });

});

/*fin datatable situation des sommiers*/

/*fonction ajout de societe*/
function ajouter_societe(){
  var new_society = prompt("Veuillez saisir le nom de la societe");
  var base_url = $('#base_url').val();
  var dataString = "nom_societe="+new_society;
  if( new_society == null){
    alert("veuillez réessayer SVP !");
  }else{
    $.ajax({
      type: "POST",
      url: base_url+'/ajax_add_new_societe',
      data: dataString,
      success: function(){
        alert('ENREGISTREMENT EFFECTUE AVEC SUCCES ');
        window.parent.location.reload();
      },
      error: function(){
        alert('ECHEC VEUILLEZ VERIFIER SI CETTE SOCIETE N\' EXISTE PAS DEJA');
      }
    });
  }
}
/*fin fonction d'ajout de societe*/
