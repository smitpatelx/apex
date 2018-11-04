drop sequence if exists listing_id_seq;

create sequence listing_id_seq;
select setval('listing_id_seq', 10000);