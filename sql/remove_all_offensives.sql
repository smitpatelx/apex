UPDATE listings SET status = 'o' WHERE status = 'h';
UPDATE users SET user_type='p' WHERE user_type='d';
DELETE FROM offensives WHERE status LIKE '%%';