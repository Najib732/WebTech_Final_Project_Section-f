async function fetchPosts() {
    try {
        const response = await fetch('../../../../Controller/Welcome/post.php');
        // const response = await fetch('http://localhost/webtech/Controller/Welcome/post.php');

        const allPosts = await response.json();

        const postsTable = document.getElementById('posts-table');
        postsTable.innerHTML = ""; // Clear any existing content

        allPosts.forEach(post => {
            // Create row for post content
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

            // Create row for actions (like, comment, report)
            const actionsRow = document.createElement('tr');

            // Like Button
            const likesCell = document.createElement('td');
            const likeButton = document.createElement('a');
            likeButton.href = "#";
            likeButton.className = 'button';
            likeButton.textContent = 'Like';
            likeButton.onclick = (e) => handleAction(e, post.post_id, 'like');
            likesCell.appendChild(likeButton);

            // Comment Button
            const commentCell = document.createElement('td');
            const commentButton = document.createElement('a');
            commentButton.href = `../Post/comment.php?post_id=${post.post_id}`;
            commentButton.className = 'button';
            commentButton.textContent = 'Comment';
            commentCell.appendChild(commentButton);

            // Report Button
            const reportCell = document.createElement('td');
            const reportButton = document.createElement('a');
            reportButton.href = `../Post/report.php?post_id=${post.post_id}`;
            reportButton.className = 'button';
            reportButton.textContent = 'Report';
            reportCell.appendChild(reportButton);

            // Append cells to the actions row
            actionsRow.appendChild(likesCell);
            actionsRow.appendChild(commentCell);
            actionsRow.appendChild(reportCell);
            postsTable.appendChild(actionsRow);
        });
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
}

async function handleAction(event, postId, action) {
    event.preventDefault();

    const data = {
        action,
        post_id: postId
    };

    try {
        const response = await fetch('http://localhost/webtech/Controller/Post/PostCheck.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `mydata=${encodeURIComponent(JSON.stringify(data))}`
        });

        const result = await response.json();

        if (result.success) {
            if (result.status === 'like') {
                alert('Post liked successfully');
            } else if (result.status === 'postdelete') {
                alert('Post deleted successfully');
                location.reload(); // Refresh to reflect the deleted post
            }
        } else {  
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Error processing your request.');
        console.error('Error:', error);
    }
}

// Initialize the fetch function when the page loads
window.onload = fetchPosts;
