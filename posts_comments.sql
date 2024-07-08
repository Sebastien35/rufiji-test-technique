CREATE TABLE IF NOT EXISTS posts_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id_post),
    FOREIGN KEY (user_id) REFERENCES users(id_user)
);

INSERT INTO posts_comments (post_id, user_id, comment) VALUES 
(8, 2, 'Commentaire par Rufiji'),
(6, 3, 'Commentaire par M. Buyse'),
(1, 25, 'Commentaire par M. M. Vallet'),
(1, 155, 'Commentaire M. C. Vallet' );

