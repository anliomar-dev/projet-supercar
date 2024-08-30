<?php
    // Database connection
    include_once('../php/connexionDB.php');
    include_once('../php/utils.php');
    // Set the content type as JSON
    header('Content-Type: application/json; charset=utf-8');

    // Initialize a default response
    $response = [
        'status' => 'error',
        'message' => 'Method not allowed'
    ];

    // Check if the request method is POST, PUT, or DELETE
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Get the request body
        $input = file_get_contents('php://input');
        
        // Convert the received JSON data into an associative array
        $data = json_decode($input, true);
        
        // Check if the JSON data is valid
        if (json_last_error() === JSON_ERROR_NONE) {
            // Get the action option to perform
            $action = $data['action'];

            switch ($action) {
                //case create for creating nuw user
                case 'create':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $first_name = $data['first_name'];
                        $last_name= $data['last_name'];
                        $address = $data['address'];
                        $phone = $data['phone'];
                        $email = $data['email'];
                        $password = $data['password'];
                        $is_email_already_taken = is_email_already_exist($email);
                        if ($is_email_already_taken){
                            $response = [
                                'status' => 'error',
                                'message' => 'Email already exist. please choose another email address'
                                ];
                        }else{
                            $result = create_user($first_name, $last_name, $address, $phone, $email, $password);
                            if($result){
                                $response = [
                                    'status' => 'success',
                                    'message' => 'Account successfully created you can now login',
                                ];
                            }else{
                                $response = [
                                    'status' => 'error',
                                    'message' => 'cannot create account: internal server error',
                                ];
                            }
                        }
                    } else {
                        $response['message'] = 'Http Method not allowed for creation';
                    }
                    break;
                
                case 'update':
                    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                        $user_id = $data['user_id'];
                        // Get other fields to update
                        // For example, first name, last name, address, etc.

                        // Your logic to update a user
                        // For example, call a function update_user()

                        $response = [
                            'status' => 'success',
                            'message' => 'Account successfully updated',
                        ];
                    } else {
                        $response['message'] = 'Method not allowed for updating';
                    }
                    break;
                    
                case 'delete':
                    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                        $user_id = $data['user_id'];

                        // Your logic to delete a user
                        // For example, call a function delete_user()

                        $response = [
                            'status' => 'success',
                            'message' => 'Account successfully deleted',
                        ];
                    } else {
                        $response['message'] = 'Method not allowed for deletion';
                    }
                    break;

                default:
                    $response = [
                        'status' => 'error',
                        'message' => 'Unrecognized action'
                    ];
                    break;
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Invalid JSON format'
            ];
        }
    }

    // Return the response as JSON
    echo json_encode($response);
?>

