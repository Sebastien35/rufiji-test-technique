-- Je suis allé au plus simple, 
-- TLDR: Je mets tous les posts dans la catégorie crypto, je mets tous les compteurs à 0, je mets à jour le compteur de posts pour la catégorie crypto

-- Tout ce qui n'est pas dans la catégorie crypto (1) est transféré dans la catégorie crypto
UPDATE posts
SET id_category = 1
WHERE id_category != 1;

-- Je mets tous les compteurs à 0 
UPDATE blog_categories
SET nb_posts = 0;

-- Je mets  à jour le compteur de posts pour la catégorie crypto
UPDATE blog_categories
SET nb_posts = (SELECT COUNT(*) FROM posts WHERE id_category = 1)
WHERE id_category = 1;


