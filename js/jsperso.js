$(function() {
	$('.resultat > button:nth-child(2)').on('click', function(){
		alert("Vous avez refusé");
		$(this).parent().text('Candidat refusé');
	});
	$('.resultat > button:nth-child(1)').on('click', function(){
		alert("Vous avez accepté");
		$(this).parent().text('Candidat accepté');
	});
	$('.envoyer').on('click', function(){	
		var saisie = saisieok('.saisievide');
		if(saisie == true)
		{
			afficheralerte('alert-success','alert-danger','Formulaire envoyé');
			alert("Formulaire envoyé");
		}
		else
		{
			$("form").submit(function(e){
            	e.preventDefault(e);
        	})
		}
	});
	$('.envoyer-pwd').on('click', function(){	
		var saisie = saisieok('.saisievide');
		if(saisie == true)
		{
			var passwordValid = Checkpassword('#pass','#pass2');
			if(passwordValid == true)
			{
				afficheralerte('alert-success','alert-danger','Mot de passe valide');
			}
			else
			{
				$("form").submit(function(e){
	            	e.preventDefault(e);
	        	});
			}
		}
		else
		{
			$("form").submit(function(e){
            	e.preventDefault(e);
        	})
		}
	});
});

const ERRORS = {
	length: "",
	different: ""
};

function afficheralerte(classadd,classdelete, text)
{
	$('.alert').removeClass(classdelete);
	$('.alert').removeClass('hidden');
	$('.alert').addClass(classadd);
	$('.alert').text(text);
}

function saisieok(elt)
{
	var etat = true;
	$(elt).each(function()
	{
		$(this).parent().removeClass('has-error');
		$(this).parent().removeClass('has-success');
		if($(this).val() == ""){
			if(etat == true)
			{
				alert("Un des champs de saisie sont vides");
				afficheralerte('alert-danger','alert-success', 'Un des champs de saisie sont vides');
			}
			$(this).parent().addClass('has-error');
			etat = false;
		}
		$(this).parent().addClass('has-success');
	});
	return etat;
}

function Checkpassword(pass1, pass2)
{
	if($(pass1).val().length < 8 || $(pass1).val().length > 14)
	{
		alert("Le mot de passe doit être compris entre 8 et 14 caractères");
		afficheralerte('alert-danger','alert-success', 'Le mot de passe doit être compris entre 8 et 14 caractères');
		return false;
	}
	if($(pass1).val() != $(pass2).val())
	{
		alert("Les mots de passe qui sont entrés sont différents");
		afficheralerte('alert-success','alert-danger', 'Les mots de passe qui sont entrés sont différents');
		return false;
	}
	return true;
}
