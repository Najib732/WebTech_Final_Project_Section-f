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
            
            function postComment( postId) {
                event.preventDefault(); 

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
                xhr.open('POST', '../../Controller/Post/CommentCheck.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                const senddata = 'mydata=' + JSON.stringify(data);
                xhr.send(senddata);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(`Failed to post comment: ${response.message}`);
                        }
                    } else {
                        alert("An error occurred while processing your request.");
                    }
                };
            }


            function deleteComment(commentId) {
                event.preventDefault();

                const data = {
                    action: 'delete_comment',
                    comment_id: commentId
                };

               

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../../Controller/Post/CommentCheck.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                const senddata = 'mydata=' + JSON.stringify(data);
                xhr.send(senddata);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        location.reload();
    
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
            $comments = comment($post_id);  
            if ($comments) {
                foreach ($comments as $comment) {
            ?>
                    <tr id="comment-<?php echo $comment['comment_id']; ?>"> 
                        <td>
                            <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                        </td>
                        <td>
                          
                            <a href="#" onclick="deleteComment(<?php echo $comment['comment_id']; ?>)">Delete Comment</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='2'>No comments yet.</td></tr>";
            }
            ?>

          
            <tr>
                <td colspan="2">
                    <form onsubmit="postComment(<?php echo htmlspecialchars($_REQUEST['post_id']); ?>);">
                        <textarea id="commentTextarea" rows="4" cols="50" placeholder="Write your comment here..."></textarea><br>
                        <button type="submit">Post Comment</button>
                    </form>
                </td>
            </tr>
        </table>
    </body>

    </html>

<?php } ?>