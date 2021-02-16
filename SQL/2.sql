# Delete columns

ALTER TABLE `users`
  DROP `two_factor_secret`,
  DROP `two_factor_recovery_codes`,
  DROP `email_verified_at`,
  DROP `remember_token`,
  DROP `current_team_id`,
  DROP `profile_photo_path`;

# Delete line with id = 64

 "DELETE FROM `anekdots` WHERE `anekdots`.`id` = 64"

# Insert into a table

INSERT INTO `anekdots` (`id`, `athor`, `type_id`, `users_id`, `datepost`, `anekdot`, `created_at`, `updated_at`) VALUES (NULL, 'Radion', '4', '9', '2020-11-09', 'cvcxvxcv', '2020-11-09 09:04:08', '2020-11-09 09:04:08');

# UPDATE line with id = 95

UPDATE `anekdots` SET `anekdot` = '1112' WHERE `anekdots`.`id` = 95;

# Number of different types and number of different users

SELECT COUNT(DISTINCT type_id) as count1, COUNT(DISTINCT users_id) as count2 FROM anekdots

# Renaming columns

SELECT name as myname, login as mylogin, password as mypassword, country as mycountry FROM users

# Foreign key relationship between two tables

SELECT * FROM pages LEFT JOIN types ON types.id=pages.type_id

# extracts hours, minutes and seconds from the date

SELECT *, HOUR(created_at) as hour, MINUTE(created_at) as minute, SECOND(created_at) as second FROM anekdots