<?php
require_once('../../Model/sql.php');

// Get the JSON data sent from the client
$json = isset($_REQUEST['mydata']) ? $_REQUEST['mydata'] : null; // Check if data is set
$data = json_decode($json, true);



// Extract the action and post_id from the request data
$action = isset($data['action']) ? $data['action'] : null;
$id = isset($data['post_id']) ? $data['post_id'] : null;
$comment = isset($data['comment']) ? $data['comment'] : null; // For comment



$response = []; // Default response initialization

if ($action == 'like') {
    // Handle the 'like' action
    $result = postLike($id);
    if ($result) {
        $response = ['success' => true, 'status' => 'like', 'message' => 'Post liked successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to like the post'];
    }
} else if ($action == 'postdelete') {
    // Handle the 'postdelete' action
    $result = postdelete($id);
    if ($result) {
        $response = ['success' => true, 'status' => 'postdelete', 'message' => 'Post deleted successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to delete the post'];
    }
} else if ($action == 'postcomment') {
    // Handle the 'postcomment' action
    if (!$comment) {
        $response = ['success' => false, 'message' => 'Comment is required'];
    } else {
        $result = postComment($id, $comment);
        if ($result) {
            $response = ['success' => true, 'status' => 'postcomment', 'message' => 'Comment posted successfully'];
        } else {
            $response = ['success' => false, 'message' => 'Failed to post the comment'];
        }
    }
} 
elseif ($action === 'delete_comment') {
    $commentId = isset($data['comment_id']) ? $data['comment_id'] : null;

    
    $result = deleteComment($commentId);

    if ($result) {
        $response = ['success' => true, 'message' => 'Comment deleted successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to delete comment'];
    }
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
