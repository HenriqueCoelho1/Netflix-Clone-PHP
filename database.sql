use db_netflix;

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(200) NOT NULL,
    dh_insert DATETIME DEFAULT NOW(),
    is_subscribed TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(id)
);

CREATE TABLE video_progress (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    video_id INT NOT NULL,
    progress INT NOT NULL DEFAULT 0,
    finished TINYINT(1) NOT NULL DEFAULT 0,
    date_modified DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY(id)
);

-- drop table video_progress;

-- SELECT video_id FROM video_progress INNER JOIN videos ON video_progress.video_id = videos.id;
SELECT video_id FROM video_progress INNER JOIN videos ON video_progress.video_id = videos.id
WHERE videos.entityId = 84 AND video_progress.username = 'jeremias'
ORDER BY video_progress.date_modified DESC
LIMIT 1;






