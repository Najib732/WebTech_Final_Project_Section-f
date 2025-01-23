async function fetchPosts() {
    try {
        let response = await fetch('../../Controller/UserProfile/Post/post.php');
        let allPosts = await response.json();
        let postsTable = document.getElementById('posts-table');

        allPosts.forEach(post => {
            const contentRow = document.createElement('tr');
            const contentCell = document.createElement('td');
            contentCell.colSpan = 4;

            if (post.postType === 'image') {
                const img = document.createElement('img');
                img.src = `../../${post.postContent}`;
                img.alt = 'Post Image';
                img.className = 'post-image';
                contentCell.appendChild(img);
            } else {
                const text = document.createElement('p');
                text.textContent = post.postContent;
                contentCell.appendChild(text);
            }

            contentRow.appendChild(contentCell);
            postsTable.appendChild(contentRow);

            const actionsRow = document.createElement('tr');
            
            // Like Button
            const likesCell = document.createElement('td');
            const likeButton = document.createElement('a');
            likeButton.href = "#";
            likeButton.className = 'button';
            likeButton.textContent = 'Like';
            likeButton.onclick = (e) => handleAction(e, post.post_id, 'like');
            likesCell.appendChild(likeButton);
            actionsRow.appendChild(likesCell);

    

            // Comment Button
            const commentCell = document.createElement('td');
            const commentButton = document.createElement('a');
            commentButton.href = `../Post/comment.php?post_id=${post.post_id}`;
            commentButton.className = 'button';
            commentButton.textContent = 'Comment';
            commentCell.appendChild(commentButton);
            actionsRow.appendChild(commentCell);

            // Delete Button
            const deleteCell = document.createElement('td');
            const deleteButton = document.createElement('a');
            deleteButton.href = "#";
            deleteButton.className = 'button';
            deleteButton.textContent = 'Delete';
            deleteButton.onclick = (e) => handleAction(e, post.post_id, 'postdelete');
            deleteCell.appendChild(deleteButton);
            actionsRow.appendChild(deleteCell);

            postsTable.appendChild(actionsRow);
        });
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
}

async function handleAction(event, postId, action) {
    event.preventDefault();  

    let data = {
        action,
        post_id: postId
    };

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'http://localhost/webtech/Controller/Post/PostCheck.php', true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const sendData = 'mydata=' + encodeURIComponent(JSON.stringify(data));
    xhttp.send(sendData);
    

    xhttp.onload = function () {
        if (xhttp.status === 200) {
            try {
                const response = JSON.parse(xhttp.responseText);
                if (response.success) {
                    if (response.status === 'like') {
                        alert('Post liked successfully');
                    } else if (response.status === 'postdelete') {
                        alert('Post deleted successfully');
                        location.reload(); 
                    }
                } else {
                    alert('Error: ' + response.message);  
                }
            } catch (error) {
                alert('Error parsing server response.');
                console.error('Parsing error:', error);
            }
        }
    };
}

window.onload = fetchPosts;
