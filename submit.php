<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['cat'];
    $subcategory = $_POST['subcat'];
    $name = $_POST['name'];
    $amount = $_POST['amt'];
    $description = $_POST['desc'];
    
    // Prepare the data to be sent
    $data = array(
        'category' => $category,
        'subcategory' => $subcategory,
        'name' => $name,
        'amount' => $amount,
        'description' => $description,
        'is_published' => 'false'
    );

    $json_data = json_encode($data);
    
    $url = 'http://127.0.0.1:8000/api/items/'; // Replace with your Django API endpoint URL

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);


    // Handle the response as needed
    echo "Response from Django API: " . $response;
}
?>

<!-- <?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $url = "http://127.0.0.1:8000/api/items/";
//     $data = array(
//         'category' => $_POST['cat'],
//         'subcategory' => $_POST['subcat'],
//         'name' => $_POST['name'],
//         'amount' => $_POST['amt'],
//         'description' => $_POST['desc']
//     );

//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//     $response = curl_exec($ch);
//     curl_close($ch);


//     // Handle the response from the Django API as needed
//     if ($response === false) {
//         echo "Error sending request.";
//     } else {
//         $responseData = json_decode($response, true);
//         if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
//             echo "Error decoding API response.";
//         } else {
//             // Process the decoded response data
//             if ($responseData && isset($responseData['message'])) {
//                 echo "API Response: " . $responseData['message'];
//             } else {
//                 echo "Invalid response from API.";
//             }
//         }
        
//     }
// }
?> -->
