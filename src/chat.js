// Event listener for submitting a message
$('#chatForm').submit(function(event) {
    event.preventDefault();
    const message = $('#chatInput').val().trim();

    if (message !== '') {
        // Send the message to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'chat.php',
            data: { message: message },
            dataType: 'json',
            success: function(response) {
                // Display the response in the chat section
                const chatSection = $('#chatGPT');
                chatSection.append('<p class="chat-message">' + message + '</p>');
                chatSection.append('<p class="chat-message">' + response.response + '</p>');
                chatSection.scrollTop(chatSection[0].scrollHeight); // Scroll to the bottom of the chat section
            }
        });

        $('#chatInput').val(''); // Clear the input field
    }
});
