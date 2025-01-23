<?php
session_start();

if (empty($_SESSION['userid'])) {
    header('Location:../Authentication/login.html');
    exit;
} else {
    require_once('../../Model/sql.php');
    $id = $_SESSION['userid'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Comments</title>
        <script>
            // Handle posting a comment using AJAX
            function postComment(event, postId) {
                event.preventDefault(); // Prevent the form from submitting the traditional way

                const commentText = document.getElementById('commentTextarea').value.trim();
                if (!commentText) {
                    alert('Please write a comment before posting.');
                    return;
                }

                const data = {
                    action: 'postcomment',
                    post_id: postId,
                    comment: commentText
                };

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../../Controller/Post/PostCheck.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                const senddata = 'mydata=' + JSON.stringify(data);
                xhr.send(senddata);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Refresh the comments section or reload the page
                            location.reload();
                        } else {
                            alert(`Failed to post comment: ${response.message}`);
                        }
                    } else {
                        alert("An error occurred while processing your request.");
                    }
                };
            }


            function deleteComment(event, commentId) {
                event.preventDefault();

                const data = {
                    action: 'delete_comment',
                    comment_id: commentId
                };

                console.log('Sending delete request for comment ID:', commentId); // Add logging for debugging

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../../Controller/Post/PostCheck.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                const senddata = 'mydata=' + JSON.stringify(data);
                xhr.send(senddata);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        console.log(response.success);
                      
                            document.getElementById('comment-' + commentId).remove(); // Remove the comment row from the DOM
                            alert(response.message);
                      
                    } else {
                        alert("An error occurred while processing your request.");
                    }
                };
            }
        </script>
    </head>

    <body>
        <table border="1">
            <?php
            $post_id = $_REQUEST['post_id'];
            $comments = comment($post_id);  // Fetch the comments related to the post
            if ($comments) {
                foreach ($comments as $comment) {
            ?>
                    <tr id="comment-<?php echo $comment['comment_id']; ?>"> <!-- Added id attribute -->
                        <td>
                            <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                        </td>
                        <td>
                            <!-- Delete comment link with AJAX -->
                            <a href="#" onclick="deleteComment(event, <?php echo $comment['comment_id']; ?>)">Delete Comment</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='2'>No comments yet.</td></tr>";
            }
            ?>

            <!-- Additional row for textarea and post button -->
            <tr>
                <td colspan="2">
                    <form onsubmit="postComment(event, <?php echo htmlspecialchars($_REQUEST['post_id']); ?>);">
                        <textarea id="commentTextarea" rows="4" cols="50" placeholder="Write your comment here..."></textarea><br>
                        <button type="submit">Post Comment</button>
                    </form>
                </td>
            </tr>
        </table>
    </body>

    </html>

<?php } ?>