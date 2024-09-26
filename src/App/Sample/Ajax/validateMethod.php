<?php
// Get the request body
$data = json_decode(file_get_contents('php://input'), true);
echo json_encode($data);
// Assuming you want to check if a method exists in a certain class
//$method = $data['method'];
//$className = 'YourClassName';
//
//// Check if the method exists in the class
//if (method_exists($className, $method)) {
//    echo json_encode(['exists' => true]);
//} else {
//    echo json_encode(['exists' => false]);
//}
