document.addEventListener('DOMContentLoaded', function () {
    //const form = document.querySelector('form[name="<?php echo $this->formName; ?>"]');
   // const submitButton = document.querySelector('button[name="<?php echo $this->name; ?>"]');

    console.log('loaded');


    const form = document.querySelector('form[name="form_produtos"]');

    const submitButton = document.querySelector('button[name="salvar"]');

    // Add a click event listener to the submit button
    if (submitButton) {
        submitButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            const url = '<?php echo $this->action->serialize(); ?>';


            // Use fetch to validate if the method exists on the server before submitting the form
            fetch('http://localhost/validateMethod.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    method: 'onSave', // Pass the method name or action
                    url: 'teste'
                })
            })

                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.exists) {
                        // If the method exists, submit the form
                        form.action = url;
                        form.submit();
                    } else {
                        // If the method does not exist, show an alert or error
                        // alert('The method does not exist!!!!!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }

});

