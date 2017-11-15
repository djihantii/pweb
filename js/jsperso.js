$(function() {
	$('.resultat > button:nth-child(2)').on('click', function(){
		alert("Vous avez refusé");
		//$(this).parent().find('button').hide();
		$(this).parent().text('Candidat refusé');
	});
	$('.resultat > button:nth-child(1)').on('click', function(){
		alert("Vous avez accepté");
	//	$(this).parent().find('button').hide();
		$(this).parent().text('Candidat accepté');
	});
	$('.envoyer').on('click', function(){	
		estVide('.estvide');
		var passwordValid = Checkpassword('#pass','#pass2');
		alert(passwordValid ? ok : pas ok);
	});
	$(".loader").fadeOut("1000");
});

const ERRORS = {
	length: "",
	different: ""
};


function estVide(elt)
{
	elt.each(function()
	{
		if($(this).val() == ""){
			alert('Un ou plusieurs des champs sont à remplir');
			return;
		}
	});
}

function Checkpassword(pass1, pass2)
{
	if($(pass1).val().length < 8 || $(pass1).val().length > 14)
	{
		alert('Le nombre de caractères doit être compris entre 8 et 14');
		return false;
	}
	if($(pass1).val() != $(pass2).val())
	{
		alert('Les 2 mots de passe sont différents');
		return false;
	}
	return true;
}
