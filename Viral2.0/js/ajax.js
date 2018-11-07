function ajaxSendForm(e){
    $('#submit').click(function(e){
        e.preventDefault();
        var form_data = $('#order').serialize(); //собераем все данные из формы
            $.ajax({  //mail to admins 
                type: "POST", 
                url: "mail.php",
                data: form_data,
                success: function() {
                    //код в этом блоке выполняется при успешной отправке сообщения
                    location = 'thankYouPage.html'
                },  
            });
            // $.ajax({  //telegram to admins 
            //     type: "POST", 
            //     url: "telegram.php",
            //     data: form_data,  
		    // });
        return false;
    })
}

ajaxSendForm(   );
