<<<<<<< HEAD
drop sequence if exists listing_id_seq CASCADE;
=======
drop sequence if exists listing_id_seq;
>>>>>>> 5a03d788a70a72822cda86d705291dd82127a05a

create sequence listing_id_seq;
select setval('listing_id_seq', 10000);