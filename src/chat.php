<?php
// API KEY per l'autenticazione
$api_key = "sk-xxxxxxxxxxxxxxxxxxxxxxxx";
// URL del servizio
$url = 'https://api.openai.com/v1/chat/completions';
// ID dell'organizzazione
$org_id = "org-xxxxxxxxxxxxxxxxxxxxxxxx";
// Modello generativo da utilizzare
$modello = "gpt-3.5-turbo";
$headers = array(
    "Authorization: Bearer {$api_key}",
    "OpenAI-Organization: {$org_id}",
    "Content-Type: application/json"
);


// Richiesta al chatbot
$messages = array();
$messages[] = array("role" => "user", "content" => "Parlami di PHP?");


// Parametri per la restituzione dell'output
$data = array();
$data["model"] = $modello;
$data["messages"] = $messages;
$data["max_tokens"] = 150;
$data["temperature"] = 0.7;


// Sessione cURL
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


// Esecuzione della richiesta HTTP e restituzione del risultato
$result = curl_exec($curl);
if (curl_errno($curl)) {
	// Messaggio di errore
    echo "Attenzione: " . curl_error($curl);
} else {
	// Stampa del risutato
    echo "<pre>";
	var_dump($result);
	echo "</pre>";
}
curl_close($curl);


// Decodifica della risposta JSON
$json_response = json_decode($result, true);
// Report sui token utilizzati
echo "In questa chat sono stati utilizzati " . $json_response["usage"]["prompt_tokens"] . " token per il prompt.<br />";
echo $json_response["usage"]["completion_tokens"] . " token per l'output.<br />";
echo $json_response["usage"]["total_tokens"] . "  token totali utilizzati.<br />";


// Estrazione della risposta
$risposta = $json_response["choices"][0]["message"]["content"];

// Stampa la risposta del modello di chat
echo $risposta;
