function toggleLike(postId) {
    const likeIcon = document.getElementById(`like-icon-${postId}`);
    const likeCount = document.getElementById(`like-count-${postId}`);
    const isLiked = likeIcon.classList.contains('fa-solid');

    // Toggle the like state (change icon and like count)
    if (isLiked) {
        likeIcon.classList.remove('fa-solid');
        likeIcon.classList.add('fa-regular');
        likeCount.textContent = parseInt(likeCount.textContent) - 1;
    } else {
        likeIcon.classList.remove('fa-regular');
        likeIcon.classList.add('fa-solid');
        likeCount.textContent = parseInt(likeCount.textContent) + 1;
    }

    // Send the like status to the server to update the database (AJAX request)
    fetch(`actions/action_toggle_like.php?post_id=${postId}&liked=${!isLiked}`)
        .then(response => response.json())
        .then(data => {
            // Optionally update like count or any other dynamic info from server response
        })
        .catch(error => console.error('Error toggling like:', error));
}