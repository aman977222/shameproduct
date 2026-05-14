<?php
include('includes/connect.php');
include('config.php');

if (isset($_POST['message'])) {

    $usermessage = trim($_POST['message']);

    // Database check
    $stmt = $con->prepare("SELECT answer FROM chatbot WHERE question LIKE ?");
    $search = "%".$usermessage."%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['answer'];
        exit;
    }

    // OpenAI API
    $url = "https://api.openai.com/v1/chat/completions";

    $data = [
        "model" => "gpt-4o-mini",
        "messages" => [
            ["role" => "user", "content" => $usermessage]
        ],
        "temperature" => 0.7,
        "max_tokens" => 200
    ];

    $options = [
        "http" => [
            "header" => "Content-Type: application/json\r\nAuthorization: Bearer " . $OPENAI_API_KEY,
            "method" => "POST",
            "content" => json_encode($data),
            "ignore_errors" => true
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        echo "not connect for aI";
        exit;
    }

    $json = json_decode($response, true);

    if (isset($json['choices'][0]['message']['content'])) {
        echo $json['choices'][0]['message']['content'];
    } else {
        echo "not response for AI";
    }
}
?>
