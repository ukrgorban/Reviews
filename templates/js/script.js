$(document).ready(function(){
	
	$('#preview').click(function(e){
		e.preventDefault();
		
		let name = $('#name').val();
		let email = $('#email').val();
		let file = $('#file').val();
		let text = $('#text').val();
		
		//console.log(name, email, file, text);
		// проверка полей

		let errors = [];
		
		if(!checkLength(name, 2)){
			errors.push('Имя не должно быть короче 2-х символов');
		};
		
		if(!checkEmail(email)){
			errors.push('Неверный e-mail');
		}
		
		if(!checkLength(text, 10)){
			errors.push('Имя не должно быть короче 10-х символов');
		};
		
		if(file){
			if(!checkFile(file, ['.jpg', '.png', '.gif'])){
				errors.push('Не допустимое расширение файла');
			}
		}
		
		if(errors.length){
			let strErrors = '';
			
			for(error of errors){
				strErrors += `<p class='error'>${ error }</p>`;
			}
			
			$('.modal-content').html(strErrors);
		}else{
			let review = `
				<div class='preview-review'>
					<h3>${ name }</h3>
					<p>${ text }</p>
					<span>${ email }</span>
				</div>
			`;
			
			$('.modal-content').html(review);
		}
		
	});
	
});

function checkEmail(field){
	
	if(field.includes('@') && field.includes('.')){
        return true;
    }

    return false;
}

function checkLength(field, length){
	
	if(field.length >= length) {
        return true;
    }

    return false;
}

function checkFile(file, exp){
	file = file.toLowerCase();
	
	for(let item of exp){
		item = item.toLowerCase();
		if(file.indexOf(item) !== -1){
			return true;
		}
	}
}
